<?php

session_start();
include "db_conn.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../../");
$dotenv->load();

function sendmail_addDept($uEmail)
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
    $mail->Subject = 'Notification from uTeamTrackr.com';
    $mail->Body = '
        <h2>You have been assigned to a departament on uTeamTracker</h2>
        <h5>Please confirm this with your departament manager!</h5>
    ';

    $mail->send();

}
function sendmail_removeDept($uEmail)
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
    $mail->Subject = 'Notification from uTeamTrackr.com';
    $mail->Body = '
        <h2>You have been removed from a departament on uTeamTracker</h2>
        <h5>Please confirm this with your departament manager!</h5>
    ';

    $mail->send();

}

if (isset ($_POST['action'])) {
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $id = mysqli_real_escape_string($conn, $_POST['deptID']);
    $orgID = $_SESSION['org']['id'];


    if ($action == "deptInformation") {
        if (isset ($_POST['dName']) && isset ($_POST['dDesc'])) {
            $dName = mysqli_real_escape_string($conn, $_POST['dName']);
            $dDesc = mysqli_real_escape_string($conn, $_POST['dDesc']);

            if (trim($dName) != "") {
                $sql = "UPDATE departaments SET Name= '$dName' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($dDesc) != "") {
                $sql = "UPDATE departaments SET Description= '$dDesc' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else if ($action == "addRank") {
        if (isset ($_POST['rank'])) {

            $rank = mysqli_real_escape_string($conn, $_POST['rank']);
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM departament_ranks WHERE Name ='$rank' AND Dept ='$id'"))) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $sql = "INSERT INTO departament_ranks (Name, Dept) VALUES ('$rank','$id')";
                $sql_result = mysqli_query($conn, $sql);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

        }
    } else if ($action == "removeRank") {
        if (isset ($_POST['rank'])) {

            $rank = mysqli_real_escape_string($conn, $_POST['rank']);

            $sql = "DELETE FROM departament_ranks WHERE ID='$rank'";
            $sql_result = mysqli_query($conn, $sql);

            $sql = "DELETE FROM departament_ranks_users WHERE Rank ='$rank'";
            $sql_result = mysqli_query($conn, $sql);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else if ($action == "addMember") {
        $rank = mysqli_real_escape_string($conn, $_POST['rank']);
        $uEmail = mysqli_real_escape_string($conn, $_POST['uEmail']);

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email = '$uEmail' AND Org='$orgID'"))) {
            $sql = "SELECT * FROM users WHERE Email = '$uEmail'";
            $sql_result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($sql_result);
            $uID = $row['ID'];

            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM departament_ranks_users WHERE Recipient='$uID'"))) {
                $sql = "UPDATE departament_ranks_users SET Rank='$rank' WHERE Recipient = '$uID'";
                $sql_result = mysqli_query($conn, $sql);
            } else if (trim($rank) != "") {
                $sql = "INSERT INTO departament_ranks_users (Recipient, Rank, Dept) VALUES ('$uID','$rank','$id')";
                $sql_result = mysqli_query($conn, $sql);
            }

            $deptLike = '"' . $id . '"';
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Dept LIKE '%$deptLike%' AND ID='$uID'")) == 0) {
                $newDepts = $id;
                $newDepts = array($newDepts);
                $oldDepts = unserialize($row['Dept']);

                if (!empty ($oldDepts)) {
                    $depts = array_merge(array_diff($oldDepts, $newDepts), $newDepts);
                    $depts = serialize($depts);

                    $sql = "UPDATE users SET Dept= '$depts' WHERE Email = '$uEmail'";
                    $sql_result = mysqli_query($conn, $sql);

                } else {
                    $depts = serialize($newDepts);

                    $sql = "UPDATE users SET Dept= '$depts' WHERE Email = '$uEmail'";
                    $sql_result = mysqli_query($conn, $sql);

                }

                header('Location: ' . $_SERVER['HTTP_REFERER']);
                sendmail_addDept($uEmail);
                exit();
            }
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();

    } else if ($action == "removeMember") {
        $user = mysqli_real_escape_string($conn, $_POST['user']);

        $sql = "DELETE FROM departament_ranks_users WHERE Recipient = '$user'";
        $sql_result = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM users WHERE ID = '$user'";
        $sql_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($sql_result);
        $uEmail = $row['Email'];

        $dept = array($id);
        $oldDepts = unserialize($row['Dept']);
        $newDepts = array_diff($oldDepts, $dept);
        $depts = serialize($newDepts);

        $sql = "UPDATE users SET Dept= '$depts' WHERE id ='$user'";
        $sql_result = mysqli_query($conn, $sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        sendmail_removeDept($uEmail);
        exit();
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();