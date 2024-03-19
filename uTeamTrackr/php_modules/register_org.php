<?php
//Organisation register

session_start();
include "db_conn.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();

function sendmail_verify_admin($fName, $lName, $uEmail, $verification_link)
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
        <h2>You have Registered as an Administrator for an Organization with uTeamTrackr.com</h2>
        <h5>Verify your email adress to Login with by clicking the link provided below</h5>
        <br></br>
        <a href="' . $verification_link . '"> Click me to verify! </a>
    ';

    $mail->send();

}

function sendmail_verify_org($fName, $lName, $uEmail, $verification_link)
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
        <h2>You have Registered an Organization with uTeamTrackr.com</h2>
        <h5>Verify your email adress to Activate your Organization with by clicking the link provided below</h5>
        <br></br>
        <a href="' . $verification_link . '"> Click me to verify! </a>
    ';

    $mail->send();

}

//Checking if the info was sent through POST method
if (isset ($_POST['cName']) && isset ($_POST['cPhone']) && isset ($_POST['cEmail']) && isset ($_POST['cAddress']) && isset ($_POST['fName']) && isset ($_POST['lName']) && isset ($_POST['uPhone']) && isset ($_POST['uEmail']) && isset ($_POST['uPass']) && isset ($_POST['uRePass'])) {

    //Setting the variables from POST into variables
    $cName = mysqli_real_escape_string($conn, $_POST['cName']);
    $cPhone = mysqli_real_escape_string($conn, $_POST['cPhone']);
    $cEmail = mysqli_real_escape_string($conn, $_POST['cEmail']);
    $cAddress = mysqli_real_escape_string($conn, $_POST['cAddress']);
    $token = md5(rand());

    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $uPhone = mysqli_real_escape_string($conn, $_POST['uPhone']);
    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    $uPass = mysqli_real_escape_string($conn, $_POST['uPass']);
    $uRePass = mysqli_real_escape_string($conn, $_POST['uRePass']);

    //If a field remains empty, it is send to the login page
    if (empty ($cName) || empty ($cPhone) || empty ($cEmail) || empty ($cAddress)) {

        header("location: ../index.php");
        exit();

        //Checking if the organisation name already exists
    } else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM organizations WHERE Email='$cEmail' OR Name ='$cName' OR Phone='$cPhone'"))) {

        header("location: ../index.php?error=Organization already exists!");
        exit();

        //Inserting data into the data base
    } else {

        $sql = "INSERT INTO organizations (id, Name, Phone, Email, Adress, token) VALUES (NULL, '$cName', '$cPhone', '$cEmail', '$cAddress','$token')";
        $sql_result = mysqli_query($conn, $sql);

        //Check up email
        if ($sql_result) {

            $site_url = $_ENV['SITE_URL'];
            $verification_link_org = "http://" . $site_url . "/TeamHero/uTeamTrackr/php_modules/verify-email.php?token=" . $token;


            //In case of error, the info will be requested again
        } else {
            header("location: ../index.php");
            exit();
        }

        //Creating the admin organisation account


        $token = md5(rand());

        if (empty ($fName) || empty ($lName) || empty ($uEmail) || empty ($uPass) || empty ($uRePass)) {

            header("location: ../index.php");
            exit();

        } else if ($uPass !== $uRePass) {

            header("location: ../index.php?error=Passwords are not identical");
            exit();

        } else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email='$uEmail'"))) {
            header("location: ../index.php?error=Email is already used");
            exit();

        } else {

            $org_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM organizations WHERE Email='$cEmail'"));
            $id = $org_id['ID'];

            $uPass = password_hash($uPass, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (ID, FName, LName, Email, Phone, Pass ,Rank, Org, token) VALUES (NULL, '$fName', '$lName', '$uEmail', '$uPhone', '$uPass','admin','$id', '$token')";
            $sql_result = mysqli_query($conn, $sql);

            if ($sql_result) {

                $site_url = $_ENV['SITE_URL'];
                $verification_link = "http://" . $site_url . "/TeamHero/uTeamTrackr/php_modules/verify-email.php?token=" . $token;


            } else {
                header("location: ../index.php");
                exit();
            }

        }

        //The administration of the admin's id and the organisation's one


        $admin_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM users WHERE Email='$uEmail'"));
        $ida = $admin_id['ID'];
        mysqli_query($conn, "UPDATE organizations SET Admin= '$ida' WHERE id ='$id'");

        header("location: ../index.php");
        sendmail_verify_org("$fName", "$lName", "$cEmail", "$verification_link_org");
        sendmail_verify_admin("$fName", "$lName", "$uEmail", "$verification_link");

    }
}

header("location: ../index.php");
exit();