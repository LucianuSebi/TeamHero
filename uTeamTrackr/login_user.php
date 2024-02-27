<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular</title>
    
</head>

<body>
    
    <form action="php_modules/login_user.php" method="post" style="height:30%;">

    <h2>User Log-in Page</h2>
        <!-- Log-in Page for User -->
        <div class="input-group">

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="uEmail" placeholder="User Email">
            </div>
        
            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="uPassword" placeholder="Password">
            </div>

            
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
