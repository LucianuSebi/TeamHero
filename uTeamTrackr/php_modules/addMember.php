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

function sendmail_verify($uEmail, $verification_link)
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
    $mail->Subject = 'Invitation from uTeamTrackr.com';
    $mail->Body = '
        <h2>You have been invited to be part of an organization on uTeamTracker</h2>
        <h5>Register using the link provided below!</h5>
        <br></br>
        <a href="' . $verification_link . '"> Click me to register! </a>
    ';

    $mail->send();

}

if (isset ($_POST['uEmail'])) {
    $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);
    if (!empty ($uEmail)) {

        $numRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email = '$uEmail'"));
        if ($numRows) {
            $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE Email = '$uEmail'"));
            if ($row['Verified'] == 1) {
                header("location: ../dashboard_members.php");
                exit();
            } else {
                $sql = "DELETE FROM users WHERE Email = '$uEmail'";
                $sqlResult = mysqli_query($conn, $sql);

                $token = md5(rand());
                $site_url = $_ENV['SITE_URL'];
                $orgID = $_SESSION['org']['id'];

                $sql = "INSERT INTO users (Email, token, Org) VALUES ('$uEmail','$token','$orgID')";
                $sqlResult = mysqli_query($conn, $sql);

                $verification_link = "http://" . $site_url . "/teamhero/uteamtrackr/register_user.php?token=" . $token;
                header("location: ../dashboard_members.php");
                sendmail_verify($uEmail, $verification_link);
                exit();
            }
        } else {

            $token = md5(rand());
            $site_url = $_ENV['SITE_URL'];
            $orgID = $_SESSION['org']['id'];

            $sql = "INSERT INTO users (Email, token, Org) VALUES ('$uEmail','$token','$orgID')";
            $sqlResult = mysqli_query($conn, $sql);

            $verification_link = "http://" . $site_url . "/teamhero/uteamtrackr/register_user.php?token=" . $token;
            header("location: ../dashboard_members.php");
            sendmail_verify($uEmail, $verification_link);
            exit();

        }


        header("location: ../dashboard_members.php");
        exit();

    }
}