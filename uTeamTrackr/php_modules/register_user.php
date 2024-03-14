<?php
//User sign-up

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


//Checking if the variables sent through POST are setted

if (isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['uPhone']) && isset($_POST['uEmail']) && isset($_POST['uPass']) && isset($_POST['uRePass'])) {
    //Setting the variables from POST into variables

    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $uPhone = mysqli_real_escape_string($conn, $_POST['uPhone']);
    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);
    $uRePass = mysqli_real_escape_string($conn, $_POST['uRePass']);
    $token = md5(rand());

    //If a field stays empty, the user is sent back to the login page
    if (empty($fName) || empty($lName) || empty($uEmail) || empty($uEmail) || empty($uRePass)) {
        header("location: ../index.php");
        exit();
    }
    //If the passwords are different, an appropiate message will show up
    else if ($uPass != $uRePass) {

        header("location: ../index.php?error=Passwords are not identical");
        exit();
    }
    //The mail shouldn't be associed to another account
    else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email = '$uEmail'"))) {

        header("location: ../index.php?error=Email is already used");
        exit();
    }
    //Introducing the data into the data base
    else {

        $sql = "INSERT INTO users (ID, FName, LName, Email, Phone, Pass, token) VALUES (NULL,'$fName','$lName','$uEmail','$uPhone','$uPass', '$token')";
        $sql_result = mysqli_query($conn, $sql);

        //Sending the check-account email
        if ($sql_result) {
            $site_url=$_ENV['SITE_URL'];
            $verification_link="http://".$site_url."/teamhero/uteamtrackr/php_modules/verify-email.php?token=".$token;
            sendmail_verify("$fName", "$lName", "$uEmail", "$verification_link");
            header("location: ../index.php");
        }

        //In case of an error, the user is sent back to the login page
        else {

            header("location: ../index.php");
            exit();
        }
    }

}