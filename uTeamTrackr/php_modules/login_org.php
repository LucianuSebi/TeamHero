<?php
session_start();
include "db_conn.php";

if (isset($_POST['cEmail']) && isset($_POST['cPass'])) {
    $cEmail = mysqli_real_escape_string($conn, $_POST['cEmail']);
    $cPass = mysqli_real_escape_string($conn, $_POST['cPass']);

    if (empty($cEmail)) {
        header("location: ../index.php?error = Email is required");
        exit();
    } else if (empty($cPass)) {
        header("location: ../index.php?error = Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE Email = '$cEmail' AND Pass = '$cPass'";
        $sql_result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($sql_result) == 1) {
            $urow = mysqli_fetch_array($sql_result);
            if ($urow['Verified'] == 1) {

                $orgID = $urow['Org'];

                $sql = "SELECT * FROM organizations WHERE ID = 'orgID'";
                $sql_result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($sql_result) == 1) {

                    $crow = mysqli_fetch_array($sql_result);

                    if ($crow['Verified'] == '1') {
                        $_SESSION['auth'] = TRUE;
                        $_SESSION['organization'] = [
                            'uEmail' => $urow['uEmail'],
                            'cEmail' => $crow['Email'],
                            'cName' => $crow['Name'],
                        ];
                        header("location: ../index.php");
                        exit();
                    } else {
                        header("location: ../index.php?error=Please Verify Your Organization's Email Adress.");
                        exit();
                    }
                } else {
                    header("location: ../index.php?error=User is not affiliated to any organizations");
                    exit();
                }

            } else {
                header("location: ../index.php?error=Please Verify Your User Email Adress");
                exit();
            }
        } else {
            header("location: ../index.php?error=Incorect Name or Password");
            exit();
        }

    }
} else {
    header("location: ../index.php");
    exit();
}
