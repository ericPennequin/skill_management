<?php
/* Connexion à la base de données */

$host = '54.36.182.179';
$dbname = 'groupe_leibniz';
$username = 'cdi';
$passwd = 'cdi2017';

try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $username, $passwd);
//	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname , $username, $passwd);
    /*$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
    //<?php $pdo = new PDO('mysql:host=localhost;dbname=transactions', 'root', 'test'); ? >

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}