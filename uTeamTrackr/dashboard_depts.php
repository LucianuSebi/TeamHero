<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
if ($_SESSION['auth'] != TRUE) {
    header("location: index.php");
    exit();
}
$id = $_SESSION['org']['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/virtual-select.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard_depts.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>
</head>

<body>
    <?php include ('includes/menu.php') ?>

    <div class="pageContent">
        <h1>Controll Panel for Departaments</h1>
        <div class="content">
            <h1>Departaments Owned By Organization</h1>

            <div class="section">
                <h2>Add a Departament</h2>
                <form id="add-departament" action="php_modules/manage_depts.php" method="post" style="height: 250px;">
                    <input type="hidden" name="action" value="addDept">
                    <div class="input-group">
                        <label for="dname">Departament Name</label>
                        <input type="text" id="dname" name="dName" placeholder="Departament Name">
                    </div>
                    <div class="input-group">
                        <label for="dmanager">Departament Manager Email</label>
                        <input type="text" id="dmanager" name="dManager" placeholder="Manager Email">
                    </div>
                    <div class="input-group">
                        <label for="ddesc">Departament Description</label>
                        <textarea type="text" id="ddesc" name="dDesc" rows="5" cols="50">Describe Departament</textarea>
                    </div>
                </form>
                <button type="submit" form="add-departament">Add Departament</button>

            </div>
            <div class="section-container">
                <div class="skills">
                    <?php $sql = "SELECT * FROM departaments WHERE Org = '$id' ORDER BY Name";
                    $sql_result = mysqli_query($conn, $sql);
                    while ($rowOrgDept = mysqli_fetch_assoc($sql_result)) { ?>
                        <div class="skill">
                            <div class="skill-section">
                                <p>
                                    Dept ID: </p>
                                <p>
                                    <?php echo $rowOrgDept['ID']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Dept Name: </p>
                                <p>
                                    <?php echo $rowOrgDept['Name']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Number of Members:
                                </p>
                                <p>
                                    <?php $skillLike = '"' . $rowOrgDept['ID'] . '"';
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE Dept LIKE '%$skillLike%' AND Org = '$id'")); ?>

                                </p>
                            </div>
                            <div class="skill-section-buttons">
                                <form id="<?php echo $rowOrgDept['ID']; ?>delete" action="php_modules/manage_depts.php"
                                    method="post" style="width: 0px;height: 0px;"><input type="hidden" name="action"
                                        value="removeDept"><input type="hidden" name="dept"
                                        value="<?php echo $rowOrgDept['ID']; ?>">
                                </form>
                                <button type="submit" form="<?php echo $rowOrgDept['ID']; ?>delete">Delete Dept</button>

                                <form id="<?php echo $rowOrgDept['ID']; ?>manage" action="dashboard_dept_settings.php"
                                    method="get" style="width: 0px;height: 0px;"><input type="hidden" name="dept"
                                        value="<?php echo $rowOrgDept['ID']; ?>">
                                </form>
                                <button type="submit" form="<?php echo $rowOrgDept['ID']; ?>manage">Manage Dept</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>