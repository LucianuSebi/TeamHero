<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
if ($_SESSION['auth'] != TRUE) {
    header("location: index.php");
    exit();
}
$id = mysqli_real_escape_string($conn, $_GET['dept']);
$sql = "SELECT * FROM departaments WHERE ID = '$id'";
$sql_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($sql_result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/virtual-select.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard_dept_settings.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>


</head>


<body>
    <?php include ('includes/menu.php') ?>

    <div class="pageContent">
        <h1>
            <?php echo $row['Name'] ?> Departament
        </h1>
        <div class="section">
            <h1>Departament Information</h1>
            <form id="departament-information" style="height: 200px;" action="php_modules/change_dept_settings.php"
                method="post">
                <input type="hidden" name="deptID" value="<?php echo $id; ?>">
                <input type="hidden" name="action" value="deptInformation">
                <div class="input-group">
                    <label for="dName">Departament Name</label>
                    <input type="text" id="dName" name="dName" placeholder="<?php echo $row['Name']; ?>">
                </div>
                <div class="input-group">
                    <label for="ddesc">Departament Description</label>
                    <textarea type="text" id="ddesc" name="dDesc" rows="5"
                        cols="50"><?php echo $row['Description']; ?></textarea>
                </div>
            </form>
            <button type="submit" form="departament-information">Save Changes</button>

        </div>

        <div class="section">

            <h1>Member Management</h1>
            <div class="skills">
                <form id="add-member" style="height: auto;" action="php_modules/change_dept_settings.php" method="post">
                    <h1 style="margin-bottom: 30px">Add Member / Change Member Rank</h1>
                    <input type="hidden" name="deptID" value="<?php echo $id; ?>">
                    <input type="hidden" name="action" value="addMember">
                    <div class="input-group">
                        <label for="uEmail">Member's Email</label>
                        <input type="text" id="uEmail" name="uEmail" placeholder="Member's Email">
                    </div>
                    <div class="input-group">
                        <label for="single_option">Select Desired Departament Rank</label>
                        <select id="single_option" name="rank" placeholder="Select Rank"
                            data-silent-initial-value-set="false">
                            <?php
                            $sql = "SELECT * FROM departament_ranks WHERE Dept = '$id'";
                            $sql_result = mysqli_query($conn, $sql);
                            while ($rowDeptRanks = mysqli_fetch_assoc($sql_result)) { ?>
                                <option value="<?php echo $rowDeptRanks['ID']; ?>">
                                    <?php echo $rowDeptRanks['Name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
                <button type="submit" form="add-member">Add Member</button>
            </div>

            <div class="add-skills">
                <h1>Current Members</h1>
                <?php
                $deptLike = '"' . $id . '"';
                $sql = "SELECT * FROM users WHERE Dept LIKE '%$deptLike%'";
                $sql_result = mysqli_query($conn, $sql);

                while ($member = mysqli_fetch_assoc($sql_result)) { ?>
                    <div class="skill">
                        <div class="skill-section">
                            <p>
                                Name:
                                <?php echo $member['FName'] . " " . $member['LName']; ?>
                            </p>
                        </div>
                        <div class="skill-section">
                            <p>
                                Email:
                                <?php echo $member['Email']; ?>
                            </p>
                        </div>
                        <div class="skill-section">
                            <p>
                                Departament Rank:
                                <?php $uID = $member['ID'];
                                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM departament_ranks_users WHERE Recipient ='$uID'"))) {
                                    $userRank = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM departament_ranks_users WHERE Recipient ='$uID'"));
                                    $rank = $userRank['Rank'];
                                    $rank = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM departament_ranks WHERE ID ='$rank'"));
                                    echo $rank['Name'];
                                } else {
                                    echo "User";
                                } ?>
                            </p>
                        </div>
                        <div class="skill-section">
                            <form id="<?php echo $uID; ?>remove" action="php_modules/change_dept_settings.php" method="post"
                                style="width: 0px;height: 0px;">
                                <input type="hidden" name="action" value="removeMember">
                                <input type="hidden" name="user" value="<?php echo $uID; ?>">
                                <input type="hidden" name="deptID" value="<?php echo $id; ?>">
                            </form>
                            <form id="<?php echo $uID . "see"; ?>" action="see_user.php?user=<?php echo $uID; ?>"
                                method="get" style="width: 0px;height: 0px;">
                                <input type="hidden" name="user" value="<?php echo $uID; ?>">
                            </form>
                            <button type="submit" form="<?php echo $uID . "see"; ?>">See Profile</button>
                            <button type="submit" form="<?php echo $uID; ?>remove">Remove Member</button>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>

        <div class="section">
            <h1>Ranks Used By Departament</h1>
            <div class="skills">

                <form id="add-rank" action="php_modules/change_dept_settings.php" method="post" style="">
                    <h1>Add Ranks</h1>
                    <input type="hidden" name="action" value="addRank">
                    <input type="hidden" name="deptID" value="<?php echo $id; ?>">
                    <div class="input-group">
                        <input type="text" id="addrank" name="rank" placeholder="Rank Name" required>
                    </div>
                </form>
                <button type="submit" form="add-rank">Add Rank</button>
            </div>
            <div class="section-container">
                <div class="skills">
                    <?php $sql = "SELECT * FROM departament_ranks WHERE Dept = '$id' ORDER BY Name";
                    $sql_result = mysqli_query($conn, $sql);
                    while ($rowDeptRank = mysqli_fetch_assoc($sql_result)) { ?>
                        <div class="skill">
                            <div class="skill-section">
                                <p>
                                    Rank ID:
                                    <?php echo $rowDeptRank['ID']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Rank Name:
                                    <?php echo $rowDeptRank['Name']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Used by
                                    <?php $rankLike = '"' . $rowDeptRank['ID'] . '"';
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM departament_ranks_users WHERE Rank LIKE '%$rankLike%'")); ?>
                                    people
                                </p>
                            </div>
                            <div class="skill-section">
                                <form id="<?php echo $rowDeptRank['ID']; ?>remove"
                                    action="php_modules/change_dept_settings.php" method="post"
                                    style="width: 0px;height: 0px;"><input type="hidden" name="action"
                                        value="removeRank"><input type="hidden" name="deptID"
                                        value="<?php echo $id; ?>"><input type="hidden" name="rank"
                                        value="<?php echo $rowDeptRank['ID']; ?>">
                                </form>
                                <button type="submit" form="<?php echo $rowDeptRank['ID']; ?>remove">Delete Rank</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>

</body>

<script type="text/javascript" src="js/virtual-select.min.js"></script>
<script type="text/javascript">
    VirtualSelect.init({
        ele: '#single_option',
        maxValues: 1
    });
</script>