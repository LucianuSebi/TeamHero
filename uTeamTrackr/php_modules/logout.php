<?php //opening php
include "db_conn.php"; //connecting the data base 
session_start(); //starting the logout session
session_unset(); //deleting the dates that runned into the session
session_destroy(); //closing the logout session
header("location: ../index.php");  //sending into the login page
exit(); //exit