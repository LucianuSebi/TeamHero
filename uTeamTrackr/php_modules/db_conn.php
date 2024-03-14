<?php

//Connecting to data base

require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();


$sname= $_ENV['DATABASE_HOSTNAME'];
$uname= $_ENV['DATABASE_USERNAME'];
$password= $_ENV['DATABASE_PASSWORD'];
$db_name = $_ENV['DATABASE_NAME'];

//The functionmysqli_connect takes as parameters the name of the server, the username, the password and the name of the data base
$conn = mysqli_connect($sname, $uname, $password, $db_name);

