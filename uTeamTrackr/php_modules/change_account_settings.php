<?php

include "db_conn.php";
session_start();

if (isset($_POST['action'])) {
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $id = $_SESSION['user']['id'];

    if ($action == "PersonalInformation") {
        if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['bio'])) {
            $fname = mysqli_real_escape_string($conn, $_POST['fname']);
            $lname = mysqli_real_escape_string($conn, $_POST['lname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $bio = mysqli_real_escape_string($conn, $_POST['bio']);

            if (trim($fname) != "") {
                $sql = "UPDATE users SET FName= '$fname' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($lname) != "") {
                $sql = "UPDATE users SET LName= '$lname' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($email) != "") {
                $sql = "UPDATE users SET Email= '$email' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($phone) != "") {
                $sql = "UPDATE users SET Phone= '$phone' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($bio) != "") {
                $sql = "UPDATE users SET Bio= '$bio' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            header("location: ../dashboard_youraccount.php");
            exit();
        }
    } else if ($action == "Adress") {
        if (isset($_POST['country']) && isset($_POST['county']) && isset($_POST['city']) && isset($_POST['postalCode'])) {
            $country = mysqli_real_escape_string($conn, $_POST['country']);
            $county = mysqli_real_escape_string($conn, $_POST['county']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $postalCode = mysqli_real_escape_string($conn, $_POST['postalCode']);

            if (trim($country) != "") {
                $sql = "UPDATE users SET Country= '$country' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($county) != "") {
                $sql = "UPDATE users SET County= '$county' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($city) != "") {
                $sql = "UPDATE users SET City= '$city' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            if (trim($postalCode) != "") {
                $sql = "UPDATE users SET PostalCode= '$postalCode' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);
            }
            header("location: ../dashboard_youraccount.php");
            exit();


        }
    } else if ($action == "Photo") {

        $file = $_FILES['photo'];
        $fileName = $_FILES['photo']['name'];
        $fileTmpName = $_FILES['photo']['tmp_name'];
        $fileError = $_FILES['photo']['error'];
        $fileType = $_FILES['photo']['type'];

        $fileExtTemp = explode('.', $fileName);
        $fileExt = strtolower(end($fileExtTemp));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileExt, $allowed) || $fileError !== 0) {
            $uniqueID = uniqid('', true);
            $fileNameNew = $uniqueID . ".png";
            $fileDestination = '../images/users/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $sql = "UPDATE users SET Img= '$uniqueID' WHERE ID ='$id'";
            $sql_result = mysqli_query($conn, $sql);
            
            header("location: ../dashboard_youraccount.php");
            exit();
        } else {
            //ERROR UPLOADING
            header("location: ../dashboard_youraccount.php");
            exit();
        }



    } else if ($action == "addSkill") {
        if (isset($_POST['skills'])) {

            $newSkills = mysqli_real_escape_string($conn, $_POST['skills']);;
            $newSkills = explode(',', $newSkills);

            $sql = "SELECT * FROM users WHERE ID = '$id'";
            $sql_result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($sql_result);

            $oldSkills = unserialize($row['Skills']);

            if (!empty($oldSkills)) {
                $skills = array_merge(array_diff($oldSkills, $newSkills), $newSkills);
                $skills = serialize($skills);

                $sql = "UPDATE users SET Skills= '$skills' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);

                header("location: ../dashboard_youraccount.php");
                exit();
            } else {
                $skills = serialize($newSkills);

                $sql = "UPDATE users SET Skills= '$skills' WHERE id ='$id'";
                $sql_result = mysqli_query($conn, $sql);

                header("location: ../dashboard_youraccount.php");
                exit();
            }
        }
    } else if($action == "removeSkill"){
        if (isset($_POST['skill'])) {

            $skill=mysqli_real_escape_string($conn, $_POST['skill']);

            $sql = "SELECT * FROM users WHERE ID = '$id'";
            $sql_result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($sql_result);

            $skill= array($skill);
            $oldSkills = unserialize($row['Skills']);
            $newSkills = array_diff($oldSkills,$skill);
            $skills = serialize($newSkills);

            $sql = "UPDATE users SET Skills= '$skills' WHERE id ='$id'";
            $sql_result = mysqli_query($conn, $sql);

            header("location: ../dashboard_youraccount.php");
            exit();
        }
    }
}
header("location: ../dashboard_youraccount.php");
exit();