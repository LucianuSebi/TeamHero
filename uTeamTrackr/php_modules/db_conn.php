<?php

//Conectare la baza de date

$sname= "localhost";
$uname= "root";
$password= "";
$db_name = "uteamtrackr";

//Functia mysqli_connect ia drept parametri numele serverului, username-ul, parola si numele bazei de date

$conn = mysqli_connect($sname, $uname, $password, $db_name);