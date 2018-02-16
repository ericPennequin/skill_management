<?php
/**
 * Created by IntelliJ IDEA.
 * User: eric.pennequin
 * Date: 12/02/2018
 * Time: 10:40
 */
if (basename($_SERVER['PHP_SELF']) == "index.php")
    require_once("inc/pdo.php");
else
    require_once("../inc/pdo.php");

$data = $_REQUEST;

if (isset($_REQUEST['command']))
    $data['command'] = $_REQUEST['command'];
else
    $data['command'] = "";

/**
 *
 * Return json
 * TEST OK
 *
 */
if ($data['command'] == 'adminView') {
    try {
        $request = $dbh->query("SELECT picture,status,id_person,firstname,lastname,email,cell_number, establishment.id_establishment, establishment.name, establishment.city 
            FROM person
            JOIN establishment ON person.id_establishment=establishment.id_establishment 
            WHERE person.status=1");
        $return = $request->fetchAll();
        for ($idx = 0; $idx < count($return); $idx++) {
            $subResult['id_person'] = $return[$idx]['id_person'];
            $subResult['firstname'] = $return[$idx]['firstname'];
            $subResult['lastname'] = $return[$idx]['lastname'];
            $subResult['cell_number'] = $return[$idx]['cell_number'];
            $subResult['email'] = $return[$idx]['email'];
            $subResult['picture'] = $return[$idx]['picture'];
            $subResult['establishment_name'] = $return[$idx]['name'];
            $subResult['city'] = $return[$idx]['city'];
            //$subResult['status']=$return[$idx]['status'];
            $result[] = $subResult;
        }
        //$subResult['']=$return[$idx][''];
        $resultJson = json_encode($result);
        echo $resultJson;
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
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


/**Connexion user
 * Return table of 2 objects
 * TESTE OK
 */
if ($data['command'] == 'userConnection') {
    $userConnectionWords = [];
    $result = [];

    try {

        $request = $dbh->query("SELECT search, counter FROM search ORDER BY counter DESC LIMIT 10");

        $userConnectionWords = $request->fetchAll();

        $result['userConnectionWords'] = $userConnectionWords;


        $request = $dbh->query("SELECT * FROM person 
					WHERE admin = 0 AND status = 1 AND firstname IS NOT NULL AND lastname IS NOT NULL 
					ORDER BY id_person DESC LIMIT 3");
        $userConnectionLastIncomming = $request->fetchAll();
        $result['userConnectionLastIncomming'] = $userConnectionLastIncomming;

        $resultJson = json_encode($result);

        echo $resultJson;

    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
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
 *      picture
 *      status
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
        $stmt = $dbh->prepare("SELECT firstname,lastname,email,cell_number,picture,status, establishment.id_establishment, establishment.name, establishment.city 
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

if ($data['command'] == 'profilModif') {

    $phone = $data['phone'];
    $email = $data['email'];
    $establishment = $data['establishment'];
    $city = $data['city'];
    $firstname = $data['firstname'];
    $userId = $data['userId'];
    $lastname = $data['lastname'];
    $id_Establishment = $data['id_Establishment'];
    $establishmentName = $data['establishmentName'];


    try {
        if ($id_Establishment == "") {

            $request = $dbh->query("INSERT INTO establishment(name,city)VALUES('$establishmentName','$city') ");
        }
        $establishmentUpdate = $request->fetchAll();

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

        $request = $dbh->query("UPDATE person
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

        $userProfilUpdate = $request->fetchAll();


    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }

}


/** Ajouter un projet
 * Return void
 * TEST OK
 */

if ($data['command'] == 'projectAdd') {

    /**@Notes :
     * competencys est un tableau
     *
     */

    $projectName = $data['projectName'];
    $projectDescription = $data['projectDescription'];
    $id_Establishment = $data['id_Establishment'];
    $competencys = $data['competencys'];

    try {

        $request = $dbh->query("INSERT INTO project (id_establishment,name,description,	status) 
			VALUES('$id_Establishment','$projectName','$projectDescription',1 ) ");

        $projectCreate = $request->fetchAll();

        $request = $dbh->query("SELECT id_project FROM project ORDER BY id_project DESC LIMIT 1 ");

        $projectSelectId = $request->fetchAll();

        for ($idx = 0; $idx < count($competencys); $idx++) {
            $currentCompetency = $competencys[$idx];
            $projectLinkCompetencys = $dbh->exec("INSERT INTO link_project_skill (id_project,id_skill) 
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

    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }

}


/** Modification d'un projet
 * Return
 * TEST OK
 */

if ($data['command'] == 'projectModif') {
    $projectName = $data['projectName'];
    $projectDescription = $data['projectDescription'];
    $id_Establishment = $data['id_Establishment'];
    $competencys = $data['competencys'];
    $projectStatute = $data['projectStatute'];
    $id_project = $data['id_project'];

    try {

        $projectCreate = $dbh->query(" UPDATE project set id_establishment='$id_Establishment', 
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

    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }


}


/**Ajout d'un USER
 * 0 = user, 1 = admin. Id etablissement 1 = rien. Status : 0 : inactif, 1 = actif
 * Return void
 * TEST OK
 */
if ($data['command'] == 'addUser') {
    $email = $data['email'];
    $pwd = $data['pwd'];

    try {
        $addUser = $dbh->query("INSERT INTO person (email,pwd,id_establishment,admin,status)
			VALUES ($email,$pwd,1,0,1)");

    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
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
if ($data['command'] == 'deleteUser') {
    $id = $data['id'];
    try {
        $deleteUser = $dbh->query("UPDATE person set status=0 WHERE id_person = '$id'");

    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
    /*Pour test SQL
    UPDATE person set status=0 WHERE id_person = 4
     *
     * */

}

////////////////////////////////////////////////
/// Fonctions pour les classes
///

function getQuery($command, $params)
{
    global $dbh;
    $data['command'] = $command;
    $data[$params[0]] = $params[1];
    $result = array();

    if ($data['command'] == 'getProfil') {
        $id_person = $data['id_person'];

        try {
            // Récupération du profil et de l'établissement
            $stmt = $dbh->prepare("SELECT firstname,lastname,email,cell_number,picture,status, establishment.id_establishment, establishment.name, establishment.city 
			FROM person
			JOIN establishment ON person.id_establishment=establishment.id_establishment 
			WHERE id_person=:id_person");
            $stmt->execute(array("id_person" => $id_person));

            $result['userData'] = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    if ($data['command'] == 'getEstablishment') {
        $id_establishment = $data['id_establishment'];

        try {
            $stmt = $dbh->prepare("SELECT * FROM establishment WHERE id_establishment=?");
            $stmt->execute(array($id_establishment));

            $result = $stmt->fetch();

            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    if ($data['command'] == 'getProjectsList') {
        $id_establishment = $data['id_establishment'];

        try {
            $stmt = $dbh->prepare("SELECT id_project FROM project WHERE id_establishment=?");
            $stmt->execute(array($id_establishment));

            while ($row = $stmt->fetch()) {
                $result[] = $row['id_project'];
            }
            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    if ($data['command'] == 'getProject') {
        $id_project = $data['id_project'];

        try {
            $stmt = $dbh->prepare("SELECT * FROM project WHERE id_project=?");
            $stmt->execute(array($id_project));

            $result = $stmt->fetch();

            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    if ($data['command'] == 'getAttachmentsList') {
        $id_project = $data['id_project'];

        try {
            $stmt = $dbh->prepare("SELECT id_data FROM data WHERE id_project=?");
            $stmt->execute(array($id_project));

            while ($row = $stmt->fetch()) {
                $result[] = $row['id_data'];
            }
            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    if ($data['command'] == 'getAttachment') {
        $id_attachment = $data['id_attachment'];

        try {
            $stmt = $dbh->prepare("SELECT * FROM data WHERE id_data=?");
            $stmt->execute(array($id_attachment));

            $result = $stmt->fetch();

            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    if ($data['command'] == 'getSkillsList') {
        $id_project = $data['id_project'];

        try {
            $stmt = $dbh->prepare("SELECT id_skill FROM link_project_skill WHERE id_project=?");
            $stmt->execute(array($id_project));

            while ($row = $stmt->fetch()) {
                $result[] = $row['id_skill'];
            }
            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    if ($data['command'] == 'getSkill') {
        $id_skill = $data['id_skill'];

        try {
            $stmt = $dbh->prepare("SELECT skill.id_skill, name, link_project_skill.id_project
            FROM skill
			JOIN link_project_skill ON skill.id_skill=link_project_skill.id_skill
			WHERE skill.id_skill=?");
            $stmt->execute(array($id_skill));

            $result = $stmt->fetch();

            return $result;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}