<?php
/* Connexion à la base de donnée */

$host = '54.36.182.179';
$dbname = 'groupe_leibniz';
$username = 'cdi';
$passwd = 'cdi2017';

try {
    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $username, $passwd);
    /**$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);**/
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}