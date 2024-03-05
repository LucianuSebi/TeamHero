<?php //deschidre php
include "db_conn.php"; //conectam baza de date 
session_start(); //Pornim sisiunea de logout
session_unset(); //Ștergem datele care au rulat în sesiune
session_destroy(); //Inchidem sesiune de logout
header("location: ../index.php");  //Trimitere pagină de login
exit(); //ieșire