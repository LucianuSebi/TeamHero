<?php
session_start();
include "db_conn.php";

if(isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['uPhone']) && isset($_POST['uEmail']) && isset($_POST['uPass']) && isset($_POST['uRePass']))
{
    $fName = mysqli_real_escape_string($conn,$_POST['fName']);
    $lName = mysqli_real_escape_string($conn,$_POST['lName']);
    $uPhone = mysqli_real_escape_string($conn,$_POST['uPhone']);
    $uEmail = mysqli_real_escape_string($conn,$_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn,$_POST['uPass']);
    $uRePass = mysqli_real_escape_string($conn,$_POST['uRePass']);
    $token = md5(rand());
    if (empty($fName) || empty($lName) || empty($uEmail) || empty($uEmail) || empty($uRePass)) 
    {
        header("location: ../index.php");
        exit();
    }
    else if($uPass != $uRePass)
    {
        header("location: ../index.php?error=Passwords are not identical");
        exit();
    }
    else if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE Email = '$uEmail'")))
    {
        header("location: ../index.php?error=Email is already used");
        exit();
    }
    else
    {
        $sql = "INSERT INTO users (ID, FName, LName, Email, Phone, Pass, Token) VALUES (NULL,'$fName','$lName','$uEmail','$uPhone','$uEmail','$uPass', $token)";
        $sql_result = mysqli_query($conn,$sql);
        if ($sql_result)
        {
            #sendmail_verify("$fName", "$lName", "$uEmail", "$token");
        }
        else
        {
            header("location: ../index.php");
            exit();
        }
    }

}