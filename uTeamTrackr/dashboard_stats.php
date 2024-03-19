<?php
session_start();
include "db_conn.php";
if ($_SESSION['auth'] != TRUE) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
$orgID = $_SESSION['org']['id'];
$sql = "SELECT * FROM skills WHERE Org = '$orgID' ORDER BY Name";
$sql_result = mysqli_query($conn, $sql);

?>
<?php
$dataPoints1 = array();

$count = 0;
while ($rowOrgSkills = mysqli_fetch_assoc($sql_result)) {
    $skillLike = '"' . $rowOrgSkills['ID'] . '"';
    $dataPoints1[$count]["label"] = $rowOrgSkills['Name'];
    $dataPoints1[$count]["y"] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Skills LIKE '%$skillLike%' AND Org = '$orgID'"));
    $count += 1;
}

$dataPoints2 = array(
    array("label" => "Endorsements", "y" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM endorsements"))),
    array("label" => "Verified Skills", "y" => mysqli_num_rows(mysqli_query($conn, "SELECT * FROM verified_skills"))),
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>
    <script>
        window.onload = function () {

            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Skills Used By Your Organization"
                },
                axisY: {
                    title: "Number of Users"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();
            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Endorsements and Verifications"
                },
                axisY: {
                    title: "Number of Actions"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();

        }
    </script>
</head>


<body>
    <?php include ('includes/menu.php') ?>
    <div class="pageContent">
        <div id="chartContainer1" class="chartContainer"></div>
        <div id="chartContainer2" class="chartContainer"></div>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>