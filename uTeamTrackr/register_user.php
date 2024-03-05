<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/f3d0c2ca4c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular</title>
    <style>
        h2{
            text-align: center;
        }
       
    </style>
    
</head>
<body>
    
    <form action="php_modules/register_user.php" method="post">
    <h2>Administrator Information</h2>
        <!-- Administrator Information -->
        <div class="input-group">

            <div class="input-field">
                <i class="fa-sharp fa-solid fa-user"></i>
                <input type= "text" name="fName" placeholder="First Name">
            </div>
        
            <div class="input-field">
                <i class="fa-sharp fa-solid fa-user"></i>
                <input type= "text" name="lName" placeholder="Last Name">
            </div>

            <div class="input-field">
                <i class="fa-solid fa-phone fa-lg"></i>
                <input type= "tel" name="uPhone" placeholder="Phone">
            </div>

            <div class="input-field">
                <i class="fa-sharp fa-solid fa-envelope"></i>
                <input type= "email" name="uEmail" placeholder="Email">
            </div>

            <div class="input-field">
                <i class="fa-sharp fa-solid fa-key"></i>
                <input type= "password" name="uPass" placeholder="Password">
            </div>

            <div class="input-field">
                <i class="fa-sharp fa-solid fa-key"></i>
                <input type= "password" name="uRePass" placeholder="Repeat Password">

            </div>

        </div>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
