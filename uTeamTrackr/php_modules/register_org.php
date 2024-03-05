<?php
//Inregistrare organizatie

session_start();
include "db_conn.php";

//Verificare daca au fost trimise infromatii prin POST
if (isset($_POST['cName']) && isset($_POST['cPhone']) && isset($_POST['cEmail']) && isset($_POST['cAdress'])){

    //Setarea variabilelor din post in variabile
    $cName = mysqli_real_escape_string($conn, $_POST['cName']);
    $cPhone = mysqli_real_escape_string($conn, $_POST['cPhone']);
    $cEmail = mysqli_real_escape_string($conn, $_POST['cEmail']);
    $cAdress = mysqli_real_escape_string($conn, $_POST['cAdress']);
    $token = md5(rand());

    //Daca um camp ramane gol, se intoarce la pagina de login
    if(empty($cName) || empty($cPhone) || empty($cEmail) || empty($cAdress)){

        header("location: ../index.php");
        exit();

    //Verificare daca numele organizatiei nu exista deja
    }else if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM organizations WHERE Email='$cEmail' OR Name ='$cName' OR Phone='$cPhone'"))){

        header("location: ../index.php?error=Organization already exists!");
        exit();

    //Inserarea datelor in baza de date
    }else{

        $sql = "INSERT INTO organizations (id, Name, Phone, Email, Adress, token) VALUES (NULL, '$cName', '$cPhone', '$cEmail', '$cAdress','$token')";
        $sql_result = mysqli_query($conn, $sql);

        //Emailul de verificare
        if($sql_result){

            #sendmail_verify("$fName", "$lName", "$uEmail", "$token");
        
        //In caz de eroare, se vor cere din nou datele
        }else{
            header("location: ../index.php");
            exit();
        }

        //Crearea contului de admin al organizatiei
        if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['uPhone']) && isset($_POST['uEmail']) && isset($_POST['uPass']) && isset($_POST['uRePass'])){
    
            $fName = mysqli_real_escape_string($conn, $_POST['fName']);
            $lName = mysqli_real_escape_string($conn, $_POST['lName']);
            $uPhone = mysqli_real_escape_string($conn, $_POST['uPhone']);
            $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
            $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);
            $uRePass = mysqli_real_escape_string($conn, $_POST['uRePass']);
            $token = md5(rand());
        
            if(empty($fName) || empty($lName) || empty($uEmail) || empty($uPass) || empty($uRePass)){
        
                header("location: ../index.php");
                exit();
        
            }else if($uPass !== $uRePass){
                
                header("location: ../index.php?error=Passwords are not identical");
                exit();
        
            }else if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email='$uEmail'"))){
        
                header("location: ../index.php?error=Email is already used");
                exit();
        
            }else{
                
                $org_id= mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM organizations WHERE Email='$cEmail'"));
                $id = $org_id['ID'];

                $sql = "INSERT INTO users (ID, FName, LName, Email, Phone, Pass ,Rank, Org, token) VALUES (NULL, '$fName', '$lName', '$uEmail', '$uPhone', '$uPass','admin','$id', '$token')";
                $sql_result = mysqli_query($conn, $sql);
        
                if($sql_result){
        
                    #sendmail_verify("$fName", "$lName", "$uEmail", "$token");
                    
                }else{
                    
                    header("location: ../index.php");
                    exit();
                }
        
            }
        }
        //Administrarea id ului adminul si organizatiei

        $admin_id= mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM users WHERE Email='$uEmail'"));
        $id = $admin_id['ID'];
        mysqli_query($conn,"UPDATE organizations SET Admin= '$admin_id' WHERE id ='$id'");

    }
}