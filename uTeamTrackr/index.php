<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start-up Page</title>
    
</head>


<body>
    <div class="topBar">
        <div class="topSection">
             <h1>UTeamTrackr</h1>

             <h2>
                <?php if(isset($_SESSION['user'])){
                    echo "Sunteti logat ca si user cu email-ul ".$_SESSION['user']['uEmail'];
                }else if(isset($_SESSION['organization'])){
                    echo "Sunteti logat ca si organizatie cu email-ul".$_SESSION['organization']['cEmail'];
                }else{
                    echo"nu sunteti logat";
                }?>
             </h2>
            
        </div>

        <div class="topSection">
            
        </div>
    </div>
    <div class="middleSection">

    </div>
    <div class="middleSection">

    </div>
