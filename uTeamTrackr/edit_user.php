<?php session_start();
error_reporting(E_ERROR | E_PARSE);
include "db_conn.php";
$id = mysqli_real_escape_string($conn, $_GET['user']);
$sql = "SELECT * FROM users WHERE ID = '$id'";
$sql_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($sql_result);
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
    <?php include('includes/menu.php') ?>

    <div class="pageContent">
        <h1>My Profile</h1>
        <div class="section" style="height: 180px;">
            <form id="change-photo" style="height: 300px; flex-direction: row;"
                action="php_modules/change_account_settings.php" enctype="multipart/form-data" method="post">
                <div class="image-selector">
                    <?php if (file_exists("images/users/" . $row['Img'] . ".png")) { ?>
                        <img src="images/users/<?php echo $row['Img']; ?>.png" alt="">
                    <?php } else { ?>
                        <img src="images/users/default.png" alt="">
                    <?php } ?>
                    <input type="file" name="photo" required>
                    <input type="hidden" name="action" value="Photo">
                    <input type="hidden" name="userID" value="<?php echo $id; ?>">
                </div>
                <div class="general-info">
                    <p>
                        <?php echo $row['FName'] . " " . $row['LName'] ?>
                    </p>

                </div>
            </form>
            <button type="submit" form="change-photo">Save Changes</button>

        </div>
        <div class="section">
            <h1>Personal information</h1>
            <form id="personal-information" style="height: 300px;" action="php_modules/change_account_settings.php"
                method="post">
                <input type="hidden" name="userID" value="<?php echo $id; ?>">
                <input type="hidden" name="action" value="PersonalInformation">
                <div class="input-group">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" placeholder="<?php echo $row['FName']; ?>">
                </div>
                <div class="input-group">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" placeholder="<?php echo $row['LName']; ?>">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="<?php echo $row['Email']; ?>">
                </div>
                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="phone" id="phone" name="phone" placeholder="<?php echo $row['Phone']; ?>">
                </div>
                <div class="input-group">
                    <label for="bio">Biograpy</label>
                    <textarea type="text" id="bio" name="bio" rows="5" cols="50"><?php echo $row['Bio']; ?></textarea>
                </div>
            </form>
            <button type="submit" form="personal-information">Save Changes</button>

        </div>
        <div class="section">
            <h1>Adress</h1>
            <form id="adress-information" style="height: 200px;" action="php_modules/change_account_settings.php"
                method="post">
                <input type="hidden" name="userID" value="<?php echo $id; ?>">
                <input type="hidden" name="action" value="Adress">
                <div class="input-group">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" placeholder="<?php echo $row['Country']; ?>">
                </div>
                <div class="input-group">
                    <label for="county">County</label>
                    <input type="text" id="county" name="county" placeholder="<?php echo $row['County']; ?>">
                </div>
                <div class="input-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" placeholder="<?php echo $row['City']; ?>">
                </div>
                <div class="input-group">
                    <label for="postalCode">Postal Code</label>
                    <input type="text" id="postalCode" name="postalCode"
                        placeholder="<?php echo $row['PostalCode']; ?>">
                </div>
            </form>
            <button type="submit" form="adress-information">Save Changes</button>

        </div>
        <div class="section">
            <h1>Skills</h1>
            <div class="section-container">
                <div class="skills">
                    <h1>Active skills</h1>
                    <?php $skills = unserialize($row['Skills']);
                    foreach ($skills as $skill) {
                        $sql = "SELECT * FROM skills WHERE ID = '$skill'";
                        $sql_result = mysqli_query($conn, $sql);
                        $rowSkill = mysqli_fetch_array($sql_result); ?>
                        <div class="skill">
                            <div class="skill-section">
                                <p>
                                    Skill Name:
                                    <?php echo $rowSkill['Name']; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <p>
                                    Verified:
                                    <?php if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM verified_skills WHERE Skill='$skill' AND Recipient = '$id'")) == 1)
                                        echo "yes";
                                    else
                                        echo "no"; ?>
                                </p>
                            </div>
                            <div class="skill-section">
                                <form id="<?php echo $skill; ?>" action="php_modules/change_account_settings.php"
                                    method="post" style="width: 0px;height: 0px;">
                                    <input type="hidden" name="action" value="removeSkill">
                                    <input type="hidden" name="skill" value="<?php echo $skill; ?>">
                                    <input type="hidden" name="userID" value="<?php echo $id; ?>">
                                </form>
                                <form id="<?php echo $skill . "verify"; ?>" action="php_modules/change_account_settings.php"
                                    method="post" style="width: 0px;height: 0px;">
                                    <input type="hidden" name="action" value="verifySkill">
                                    <input type="hidden" name="skill" value="<?php echo $skill; ?>">
                                    <input type="hidden" name="userID" value="<?php echo $id; ?>">
                                </form>
                                <button type="submit" form="<?php echo $skill . "verify"; ?>">Verify Skill</button>
                                <button type="submit" form="<?php echo $skill; ?>">Delete Skill</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="add-skills">
                    <h1>Add Skills</h1>
                    <form id="skill-information" style="height: auto;min-height: 300px;"
                        action="php_modules/change_account_settings.php" method="post">
                        <input type="hidden" name="action" value="addSkill">
                        <select id="multi_option" multiple name="skills" placeholder="Add Skills"
                            data-silent-initial-value-set="false">
                            <?php
                            $orgId = $row['Org'];
                            $sql = "SELECT * FROM skills WHERE Org = '$orgId'";
                            $sql_result = mysqli_query($conn, $sql);
                            while ($rowOrgSkills = mysqli_fetch_assoc($sql_result)) { ?>
                                <option value="<?php echo $rowOrgSkills['ID']; ?>">
                                    <?php echo $rowOrgSkills['Name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </form>

                </div>
            </div>
            <button type="submit" form="skill-information">Save Changes</button>
        </div>
    </div>

</body>

<script type="text/javascript" src="js/virtual-select.min.js"></script>
<script type="text/javascript">
    VirtualSelect.init({
        ele: '#multi_option'
    });
</script>