<?php

session_start();

//Includem folderul cu baza de date
include "db_conn.php";


//Verificare daca au fost trimise emailul si parola in campurile uEmail, respectiv uPass prin metoda POST
if (isset($_POST['uEmail']) && isset($_POST['uPass'])){

    //Variabilele setate iau valorile din coloanele bazei de date
    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);


    //In caz de sunt campurile sunt goale va aparea eroarea respectiva
    if(empty($uEmail) || empty($uPass)){

        header("location: ../index.php?error=Email is required");
        exit();

    }else{

        //Selectam din tabelul users din coloanele Email si parola si verificam unde valorile corespund cu cele introduse
        //Sql_result va contine randurile din tabel care satisfac conditiile interogarii

        $sql = "SELECT * FROM users WHERE Email='$uEmail' AND parola='$uPass'";
        $sql_result = mysqli_query($conn, $sql);

        //Daca functia returneaza doar un rand continuam
        if(mysqli_num_rows($sql_result) === 1){

            //Variabila row stocheaza sql_result drept un tablou 
            $row = mysqli_fetch_array($sql_result);

            //Variabila verificat indica faptul ca utilizatorul are contul verificat
            if($row['verificat'] == '1'){

                //Utlizatorul este autentificat
                //Stocarea datelor intr-un tablou de sesiune numit user
                $_SESSION['auth'] = TRUE;
                $_SESSION['user'] = [
                    'fName' => $row['prenume'],
                    'lName' => $row['nume'],
                    'uEmail' => $row['email'],
                    'uPhone' => $row['telefon'],
                    'rank' => $row['rank'],
                ]; 

                //Redirectionare la pagina principala
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