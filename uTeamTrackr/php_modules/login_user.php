<?php

session_start();

//Includem folderul cu baza de date
include "db_conn.php";


//Verificare daca au fost trimise emailul si parola in campurile uEmail, respectiv uPass prin metoda POST
if (isset ($_POST['uEmail']) && isset ($_POST['uPass'])) {

    //Variabilele setate iau valorile din coloanele bazei de date
    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);


    //In caz de sunt campurile sunt goale va aparea eroarea respectiva
    if (empty ($uEmail) || empty ($uPass)) {

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();

    } else {

        //Selectam din tabelul users din coloanele Email si parola si verificam unde valorile corespund cu cele introduse
        //Sql_result va contine randurile din tabel care satisfac conditiile interogarii

        $sql = "SELECT * FROM users WHERE Email='$uEmail'";
        $sql_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($sql_result);

        //Daca functia returneaza doar un rand continuam
        if (password_verify($uPass, $row['Pass'])) {

            //Variabila verificat indica faptul ca utilizatorul are contul verificat
            if ($row['Verified'] == 1) {

                //Utlizatorul este autentificat
                //Stocarea datelor intr-un tablou de sesiune numit user
                $orgID = $row['Org'];
                $sql = "SELECT * FROM organizations WHERE ID = '$orgID'";
                $sql_result = mysqli_query($conn, $sql);
                $crow = mysqli_fetch_array($sql_result);

                $_SESSION['auth'] = TRUE;
                $_SESSION['org'] = [
                    'id' => $crow['ID'],
                    'Name' => $crow['Name'],
                ];
                $_SESSION["user"] = [
                    'id' => $row['ID'],
                    'fName' => $row['FName'],
                    'lName' => $row['LName'],
                    'uEmail' => $row['Email'],
                    'uPhone' => $row['Phone'],
                    'rank' => $row['Rank'],
                ];

                //Redirectionare la pagina principala
                header("location: ../dashboard.php");
                exit();

            } else {

                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}