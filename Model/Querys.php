<?php
/**
 * Created by IntelliJ IDEA.
 * User: eric.pennequin
 * Date: 12/02/2018
 * Time: 10:40
 */

require "../inc/pdo.php";



$data=$_REQUEST;

$data['command']=$_REQUEST['command'];



/**Connexion user
 * Return table of 2 objects
 * TESTE OK
*/
if ($data['command']=='userConnection'){
	$userConnectionWords=[];
		$result=[];

		try {

			$request= $dbh->query("SELECT search, counter FROM search ORDER BY counter DESC LIMIT 10");

			$userConnectionWords=$request->fetchAll();

			$result['userConnectionWords']=$userConnectionWords;


			$request= $dbh->query("SELECT * FROM person 
					WHERE admin = 0 AND status = 1 AND firstname is not null AND lastname is not null 
					ORDER BY id_person DESC LIMIT 3");
			$userConnectionLastIncomming=$request->fetchAll();
			$result['userConnectionLastIncomming']=$userConnectionLastIncomming;

			$resultJson=json_encode($result);

			echo $resultJson;

		}catch(Exception $e){
			die('Erreur: '.$e->getMessage());
		}

}






/** Consultation d'un profil
 * Return Result :
 * --------------------------------------------
 *  userDate [ARRAY]
 *      firstname
 *      lastname
 *      email
 *      cell_number
 *      id_establishment
 *      name (establishment)
 *      city (establishment)
 *      projects [ARRAY, id = id_project]
 *          id_project
 *          name
 *          description
 *          status
 *          data [ARRAY]
 *              id_data
 *              data
 *          skills [ARRAY]
 *              id_skill
 *              name
 * --------------------------------------------
 * Tests unitaires : OK
 */

if ($data['command'] == 'profilViewer') {

	/**
	 * PArtie profil :
	 *
	 * Partie Projets :
	 * Intitulé des projets, descriptif (table projet),
	 * fichiers joints (table data)
	 * Compétences associées (table skill et link_project_skill)
	 *
	 */
	$id_person = $data['id_person'];

	try {
		// Récupération du profil et de l'établissement
		$stmt = $dbh->prepare("SELECT firstname,lastname,email,cell_number, establishment.id_establishment, establishment.name, establishment.city 
			FROM person
			JOIN establishment ON person.id_establishment=establishment.id_establishment 
			WHERE id_person=:id_person");
		$stmt->execute(array("id_person" => $id_person));

		$result['userData'] = $stmt->fetch();

		// Récupération des projets
		$stmt = $dbh->prepare("SELECT * FROM project WHERE id_establishment=:id_establishment");
		$stmt->execute(array("id_establishment" => $result['userData']['id_establishment']));

		while ($row = $stmt->fetch()) {
			$db_project_id = $row['id_project'];
			$db_project_infos = array(
				"id_project" => $db_project_id,
				"name" => $row["name"],
				"description" => $row["description"],
				"status" => $row["status"]
			);
			$result['userData']['projects'][$db_project_id] = $db_project_infos;
			unset($db_project_id);
			unset($db_project_infos);
		}
		unset($row);

		// Récupération des pièces jointes et des compétences
		foreach ($result['userData']['projects'] as $id => $project) {

			// Pièces jointes
			$stmt = $dbh->prepare("SELECT id_data, data FROM data WHERE id_project=:id_project");
			$stmt->execute(array("id_project" => $id));

			$result['userData']['projects'][$id]['data'] = $stmt->fetchAll();

			// Compétences
			$stmt = $dbh->prepare("SELECT skill.id_skill, name
			FROM skill
			JOIN link_project_skill ON skill.id_skill=link_project_skill.id_skill 
			WHERE id_project=:id_project");
			$stmt->execute(array("id_project" => $id));

			$result['userData']['projects'][$id]['skills'] = $stmt->fetchAll();

			unset($id);
			unset($project);
		}

		return $result;
	} catch (Exception $e) {
		die('Erreur: ' . $e->getMessage());
	}

	/*Pour test SQL
	SELECT firstname,lastname,email,cell_number, establishment.name, establishment.city FROM person
		JOIN establishment ON person.id_establishment=establishment.id_establishment WHERE id_person=2
	 *
	 *SELECT name, description FROM project WHERE id_project=2
	 *
	 * SELECT data FROM data WHERE id_project=2
	 *
	 * SELECT name FROM skill WHERE id_skill=2
	 * */

}



/** Modification du profil user
 * Return void
 * TEST OK
 */

if ($data['command']=='profilModif'){

	$phone=$data['phone'];
	$email=$data['email'];
	$establishment=$data['establishment'];
	$city=$data['city'];
	$firstname=$data['firstname'];
	$userId=$data['userId'];
	$lastname=$data['lastname'];
	$id_Establishment=$data['id_Establishment'];
	$establishmentName=$data['establishmentName'];


	try {
		if ($id_Establishment == ""){

			$request=$dbh->query("INSERT INTO establishment(name,city)VALUES('$establishmentName','$city') ");
		}
		$establishmentUpdate=$request->fetchAll();

		//TODO Voir si c'est nécessaire (en cas de 2 requêtes pour récupérer l'id etablissement)
		//$id_Establishment=$dbh->exec("SELECT establishment.id_establishment FROM establishment WHERE establishment.name = 'CEFIM' AND establishment.city='Tours' ");


		/*V pour test
		$userProfilUpdate=$dbh->exec("UPDATE person
		set 
		firstname='Charles', 
		lastname='DeMogenc', 
		email='charlesedemogency@demogency.com', 
		cell_number='0698754322',
		person.id_establishment=2	
		 WHERE id_person = 3 ");


		UPDATE person
		set
		firstname='Charles',
		lastname='DeMogenc',
		email='charlesedemogency@demogency.com',
		cell_number='0698754322',
		person.id_establishment=(SELECT id_establishment
			FROM establishment
			WHERE name = 'AFPA'
			AND city='Tours')
		 WHERE id_person = 3



		 * */

		$request=$dbh->query("UPDATE person
		set
		firstname='$firsname',
		lastname='$lastname',
		email='$email',
		cell_number='$phone',
		person.id_establishment=(SELECT establishment.id_establishment 
			FROM establishment 
			WHERE establishment.name = '$establishmentName' 
			AND establishment.city='$city')
		 WHERE id_person = '$userId' ");

		$userProfilUpdate=$request->fetchAll();


	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}

}






/** Ajouter un projet
 * Return void
 * TEST OK
 */

if ($data['command']=='projectAdd'){

	/**@Notes :
	 * competencys est un tableau
	 *
	 */

	$projectName=$data['projectName'];
	$projectDescription=$data['projectDescription'];
	$id_Establishment=$data['id_Establishment'];
	$competencys=$data['competencys'];

	try {

		$request=$dbh->query("INSERT INTO project (id_establishment,name,description,	status) 
			VALUES('$id_Establishment','$projectName','$projectDescription',1 ) ");

		$projectCreate=$request->fetchAll();

		$request=$dbh->query("SELECT id_project FROM project ORDER BY id_project DESC LIMIT 1 ");

		$projectSelectId=$request->fetchAll();

		for ($idx=0; $idx<count($competencys);$idx ++){
			$currentCompetency=$competencys[$idx];
			$projectLinkCompetencys=$dbh->exec("INSERT INTO link_project_skill (id_project,id_skill) 
			VALUES('$projectSelectId', (SELECT skill.id_skill FROM skill WHERE skill.name ='$competencys[$idx]') ");

		}

	/*
	 * Pour test SQL
	 *
	 *
	 * INSERT INTO project (id_establishment,name,description,	status)
			VALUES(2,'toto','pour essais SQL',1)

	INSERT INTO link_project_skill (id_project,link_project_skill.id_skill)
		VALUES(2,(SELECT skill.id_skill FROM skill WHERE skill.name = 'CSS'))
	 * */

	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}

}





/** Modification d'un projet
 * Return
 * TEST OK
 */

if ($data['command']=='projectModif'){
	$projectName=$data['projectName'];
	$projectDescription=$data['projectDescription'];
	$id_Establishment=$data['id_Establishment'];
	$competencys=$data['competencys'];
	$projectStatute=$data['projectStatute'];
	$id_project=$data['id_project'];

	try {

		$projectCreate=$dbh->query(" UPDATE project set id_establishment='$id_Establishment', 
 				name='$projectName', description='$projectDescription',status='$projectStatute' WHERE id_project='$id_project' ");

		/*POUR TESTS
		UPDATE project set id_establishment=2,
 				name='toto', description='Pour un Third essai SQL',status=1 WHERE id_project=3
		 *
		 *
		for ($idx=0; $idx<count($competencys);$idx ++){
			$currentCompetency=$competencys[$idx];

			$projectLinkCompetencys=$dbh->exec("INSERT INTO link_project_skill (id_project,id_skill)
			VALUES('$projectSelectId', (SELECT skill.id_skill FROM skill WHERE skill.name ='$competencys[$idx]') ");

		}
		*/

	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}


}




/**Ajout d'un USER
 * 0 = user, 1 = admin. Id etablissement 1 = rien. Status : 0 : inactif, 1 = actif
 * Return void
 * TEST OK
 */
if ($data['command']=='addUser'){
	$email=$data['email'];
	$pwd=$data['pwd'];

	try {
		$addUser= $dbh->query("INSERT INTO person (email,pwd,id_establishment,admin,status)
			VALUES ($email,$pwd,1,0,1)");

	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
/*Pour tests SQL
 * INSERT INTO person (email,pwd,id_establishment,admin,status)
			VALUES ('john.doe@gmail.com','blabla',1,0,1)
 * */


}





/** Suppression d'un USER
 * Return void
 * TEST OK
 */
if ($data['command']=='deleteUser'){
	$id=$data['id'];
	try {
		$deleteUser= $dbh->query("UPDATE person set status=0 WHERE id_person = '$id'");

	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
/*Pour test SQL
UPDATE person set status=0 WHERE id_person = 4
 *
 * */

}