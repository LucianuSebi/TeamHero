<?php

include "db_conn.php";
session_start();

if (isset($_POST['action'])) {
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $id = $_SESSION['org']['id'];

    if ($action == "removeSkill") {

        $removedSkill = mysqli_real_escape_string($conn, $_POST['skill']);
        $sql = "DELETE FROM skills WHERE ID='$removedSkill'";
        $sql_result = mysqli_query($conn, $sql);

        $sqlSkill = '"'.$removedSkill.'"';
        $removedSkill= array($removedSkill);

        $sql= "SELECT * FROM users WHERE Skills LIKE '%$skillLike%' AND Org = '$id'";
        $sql_result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($sql_result)){

            $oldSkills = unserialize($row['Skills']);
            $newSkills = array_diff($oldSkills, $removedSkill);
            $newSkills = serialize($newSkills);

            $userID = $row['ID'];
            $sql = "UPDATE users SET Skills= '$newSkills' WHERE id ='$userID'";
            $sql_result = mysqli_query($conn, $sql);

            header("location: ../dashboard_skills.php");
            exit();
        }
    }else if($action == "addSkill") {
        $skill = mysqli_real_escape_string($conn, $_POST['skill']);
        
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM skills WHERE Name = '$skill' AND Org ='$id'"))==0){
            $sql = "INSERT INTO skills (Name, Org) VALUES ('$skill', '$id')";
            $sql_result = mysqli_query($conn, $sql);

            header("location: ../dashboard_skills.php");
            exit();
        }else{
            header("location: ../dashboard_skills.php");
            exit();
        }
    }
}