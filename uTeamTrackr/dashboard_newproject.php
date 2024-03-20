<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
if ($_SESSION['auth'] != TRUE) {
    header("location: index.php");
    exit();
}
$id = $_SESSION['user']['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/virtual-select.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard_youraccount.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>
</head>

<body>
    <?php include ('includes/menu.php') ?>


</body>