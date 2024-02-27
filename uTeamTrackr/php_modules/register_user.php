<?php
//Inregistrare Utilizator

session_start();
include "db_conn.php";


//Verificare daca variabilele trimise prin POST sunt setate
if(isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['uPhone']) && isset($_POST['uEmail']) && isset($_POST['uPass']) && isset($_POST['uRePass']))
{
    //Setarea variabilelor din post in variabile

    $fName = mysqli_real_escape_string($conn,$_POST['fName']);
    $lName = mysqli_real_escape_string($conn,$_POST['lName']);
    $uPhone = mysqli_real_escape_string($conn,$_POST['uPhone']);
    $uEmail = mysqli_real_escape_string($conn,$_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn,$_POST['uPass']);
    $uRePass = mysqli_real_escape_string($conn,$_POST['uRePass']);
    $token = md5(rand());

    //Daca um camp ramane gol, se intoarce la pagina de login
    if (empty($fName) || empty($lName) || empty($uEmail) || empty($uEmail) || empty($uRePass)) 
    {
        header("location: ../index.php");
        exit();
    }
    //Daca parolele difera se va afisa mesajul corespunzator
    else if($uPass != $uRePass)
    {
        
        header("location: ../index.php?error=Passwords are not identical");
        exit();
    }
    //Emailul trebuie sa nu fie asociat altui cont
    else if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE Email = '$uEmail'")))
    {
        
        header("location: ../index.php?error=Email is already used");
        exit();
    }
    //Introducerea datelor in baza de date
    else
    {
        
        $sql = "INSERT INTO users (ID, FName, LName, Email, Phone, Pass, Token) VALUES (NULL,'$fName','$lName','$uEmail','$uPhone','$uEmail','$uPass', $token)";
        $sql_result = mysqli_query($conn,$sql);

        //Trimiterea emailului de validare a contului
        if ($sql_result)
        {
            #sendmail_verify("$fName", "$lName", "$uEmail", "$token");
        }
        
        //Reintoarcerea la pagina de login in caz de eroare
        else
        {
            
            header("location: ../index.php");
            exit();
        }
    }

}