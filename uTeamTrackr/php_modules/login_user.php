<?php

session_start();
include "db_conn.php";

if (isset($_POST['uEmail']) && isset($_POST['uPass'])){

    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);

    if(empty($uEmail) || empty($uPass)){

        header("location: ../index.php?error=Email is required");
        exit();

    }else{

        $sql = "SELECT * FROM users WHERE Email='$uEmail' AND parola='$uPass'";
        $sql_result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($sql_result) === 1){

            $row = mysqli_fetch_array($sql_result);

            if($row['verificat'] == '1'){

                $_SESSION['auth'] = TRUE;
                $_SESSION['user'] = [
                    'fName' => $row['prenume'],
                    'lName' => $row['nume'],
                    'uEmail' => $row['email'],
                    'uPhone' => $row['telefon'],
                    'rank' => $row['rank'],
                ]; 

                header("location: ../index.php");
                exit();

            }else{
                header("location: ../index.php?error=Please Verify your Email Adress.");
                exit();
            }

        }else{
            header("location: ../index.php?error=Incorect User Name or Password");
            exit();
        }
    }

}else{
    header("location: ../index.php");
    exit();
}