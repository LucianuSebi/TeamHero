<?php

//Conectare la baza de date

require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();


$sname= $_ENV['DATABASE_HOSTNAME'];
$uname= $_ENV['DATABASE_USERNAME'];
$password= $_ENV['DATABASE_PASSWORD'];
$db_name = $_ENV['DATABASE_NAME'];

//Functia mysqli_connect ia drept parametri numele serverului, username-ul, parola si numele bazei de date
$conn = mysqli_connect($sname, $uname, $password, $db_name);

