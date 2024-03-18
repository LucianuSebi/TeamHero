<?php

session_start();
include "db_conn.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();
var_dump($_ENV);

function sendmail_contact($Name, $Phone, $Email, $City, $Desc)
{

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $_ENV['EMAIL_PORT'];

    $mail->setFrom('amariei_sebastianl@yahoo.com', 'Amariei Sebastian-Lucian');
    $mail->addAddress($_ENV['EMAIL_USERNAME']);

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Ticket From ' . $Email . '';
    $mail->Body = '
        <h2>You received a message from ' . $Name . ', city ' . $City . ', email ' . $Email . '</h2>
        <h5>This is what they said:
        ' . $Desc . '</h5>
    ';

    $mail->send();

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = $_ENV['EMAIL_PORT'];

    $mail->setFrom($_ENV['EMAIL_USERNAME'], $_ENV['EMAIL_SENDER']);
    $mail->addAddress($Email);

    $mail->isHTML(true);
    $mail->Subject = 'You Have Contacted The uTeamTrackr Support Team';
    $mail->Body = '
        <h2>You have sent us an inquiry</h2>
        <h5>We will respond in the shortest possible time</h5>
        <br></br>
        <h5>We thank you in advance for your patience</h5>
    ';

    $mail->send();

}

$Name = mysqli_real_escape_string($conn, $_POST['name']);
$Email = mysqli_real_escape_string($conn, $_POST['email']);
$Phone = mysqli_real_escape_string($conn, $_POST['phone']);
$City = mysqli_real_escape_string($conn, $_POST['city']);
$Desc = mysqli_real_escape_string($conn, $_POST['description']);

header("location: ../index.php");
sendmail_contact($Name, $Phone, $Email, $City, $Desc);

exit();