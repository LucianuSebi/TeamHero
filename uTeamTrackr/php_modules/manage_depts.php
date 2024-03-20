<?php

include "db_conn.php";
session_start();

if (isset ($_POST['action'])) {
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $id = $_SESSION['org']['id'];

    if ($action == "removeDept") {

        $dept = mysqli_real_escape_string($conn, $_POST['dept']);
        $sql = "DELETE FROM departaments WHERE ID='$dept' AND Org='$id'";
        $sql_result = mysqli_query($conn, $sql);

        $sqlDept = '"' . $dept . '"';
        $removedDept = array($dept);

        $sql = "SELECT * FROM users WHERE Dept LIKE '%$sqlDept%' AND Org = '$id'";
        $sql_result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($sql_result)) {

            $oldDept = unserialize($row['Dept']);
            $newDept = array_diff($oldDept, $removedDept);
            $newDept = serialize($newDept);

            $userID = $row['ID'];
            $sql = "UPDATE users SET Dept= '$newDept' WHERE id ='$userID'";
            $sql_result = mysqli_query($conn, $sql);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if ($action == "addDept") {
        $dName = mysqli_real_escape_string($conn, $_POST['dName']);
        $dManager = mysqli_real_escape_string($conn, $_POST['dManager']);
        $dDesc = mysqli_real_escape_string($conn, $_POST['dDesc']);

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM departaments WHERE Name = '$dName' AND Org ='$id'")) == 0) {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Email='$dManager' AND Org='$id'"))) {

                $sql = "INSERT INTO departaments (Name, Org,Admin,Description) VALUES ('$dName', '$id','$dManager','$dDesc')";
                $sql_result = mysqli_query($conn, $sql);

                $sql = "SELECT * FROM users WHERE Email='$dManager'";
                $row_user = mysqli_fetch_array(mysqli_query($conn, $sql));

                $oldRank = unserialize($row_user['Rank']);
                $newRank = array("deptM");

                $ranks = array_merge(array_diff($oldRank, $newRank), $newRank);
                $ranks = serialize($ranks);

                $sql = "UPDATE users SET Rank='$ranks' WHERE Email='$dManager' AND Org='$id'";
                $sql_result = mysqli_query($conn, $sql);

                $sql = "SELECT * FROM departaments WHERE Name = '$dName'";
                $sql_result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($sql_result);
                $dept = $row['ID'];

                $newDepts = explode(',', $dept);

                $sql = "SELECT * FROM users WHERE Email = '$dManager'";
                $sql_result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($sql_result);

                $oldDepts = unserialize($row['Dept']);

                if (!empty ($oldDepts)) {
                    $depts = array_merge(array_diff($oldDepts, $newDepts), $newDepts);
                    $depts = serialize($depts);

                    $sql = "UPDATE users SET Dept= '$depts' WHERE Email = '$dManager'";
                    $sql_result = mysqli_query($conn, $sql);

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } else {
                    $depts = serialize($newDepts);

                    $sql = "UPDATE users SET Dept= '$depts' WHERE Email = '$dManager'";
                    $sql_result = mysqli_query($conn, $sql);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }

            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}