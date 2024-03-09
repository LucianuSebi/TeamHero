<?php
//Inregistrare Utilizator

session_start();
include "db_conn.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();
var_dump($_ENV);

function sendmail_verify($fName, $lName, $uEmail, $verification_link)
{

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $_ENV['EMAIL_PORT'];

    $mail->setFrom($_ENV['EMAIL_USERNAME'], $_ENV['EMAIL_SENDER']);
    $mail->addAddress($uEmail);

    $mail->isHTML(true);
    $mail->Subject = 'Email Verification from uTeamTrackr.com';
    $mail->Body = '
        <h2>You have Registered as an Employee with uTeamTrackr.com</h2>
        <h5>Verify your email adress to Login with by clicking the link provided below</h5>
        <br></br>
        <a href="'.$verification_link.'"> Click me to verify! </a>
    ';

    $mail->send();

}


//Verificare daca variabilele trimise prin POST sunt setate
if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['uPhone']) && isset($_POST['uEmail']) && isset($_POST['uPass']) && isset($_POST['uRePass'])) {
    //Setarea variabilelor din post in variabile

    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $uPhone = mysqli_real_escape_string($conn, $_POST['uPhone']);
    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);
    $uRePass = mysqli_real_escape_string($conn, $_POST['uRePass']);
    $token = md5(rand());

    //Daca um camp ramane gol, se intoarce la pagina de login
    if (empty($fName) || empty($lName) || empty($uEmail) || empty($uEmail) || empty($uRePass)) {
        header("location: ../index.php");
        exit();
    }
    //Daca parolele difera se va afisa mesajul corespunzator
    else if ($uPass != $uRePass) {

        header("location: ../index.php?error=Passwords are not identical");
        exit();
    }
    //Emailul trebuie sa nu fie asociat altui cont
    else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email = '$uEmail'"))) {

        header("location: ../index.php?error=Email is already used");
        exit();
    }
    //Introducerea datelor in baza de date
    else {

        $sql = "INSERT INTO users (ID, FName, LName, Email, Phone, Pass, token) VALUES (NULL,'$fName','$lName','$uEmail','$uPhone','$uPass', '$token')";
        $sql_result = mysqli_query($conn, $sql);

        //Trimiterea emailului de validare a contului
        if ($sql_result) {
            $site_url=$_ENV['SITE_URL'];
            $verification_link="http://".$site_url."/teamhero/uteamtrackr/php_modules/verify-email.php?token=".$token;
            sendmail_verify("$fName", "$lName", "$uEmail", "$verification_link");
            header("location: ../index.php");
        }

        //Reintoarcerea la pagina de login in caz de eroare
        else {

            header("location: ../index.php");
            exit();
        }
    }

}