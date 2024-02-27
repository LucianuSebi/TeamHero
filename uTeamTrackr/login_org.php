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
    
    <form action="php_modules/login_org.php" method="post" style="height:30%;">
    <h2>Company Log-in Page</h2>
        <!-- Log-in Page for Company -->
        <div class="input-group">

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="cEmail" placeholder="Company Email">
            </div>
        
            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "text" name="cPassword" placeholder="Password">
            </div>

            
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
