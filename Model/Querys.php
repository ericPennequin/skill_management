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

/*
 * Pour les requêtes :
 * le mot clé command:
 * 	search, pour les recherches,
 * 	establishmentModif : modif etablissements
 * 	projectModif : pour les modifs projet,
 * addUser : pour ajout de user,
 * deleteUser : pour la suppression de user
 *
 *
 * */

//recherche
if ($data['command']=='search'){



}


//modif profil (etablissement)
if ($data['command']=='establishmentModif'){



}


//modif projet (liè à l'établissement)
if ($data['command']=='projectModif'){



}
//0 = user, 1 = admin. Id etablissement 1 = rien. Status : 0 : inactif, 1 = actif
//ajout user
if ($data['command']=='addUser'){
	$email=$data['email'];
	$pwd=$data['pwd'];

	try {
		$addUser= $dbh->exec("INSERT INTO person (email,pwd,id_establishment,admin,status)
			VALUES ($email,$pwd,1,0,1)");

	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}

}


//supp user
if ($data['command']=='deleteUser'){
	$id=$data['id'];
	try {
		$deleteUser= $dbh->exec("UPDATE person set status=0 WHERE id = '$id'");

	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}


}