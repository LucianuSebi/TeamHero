<?php
session_start();
include "db_conn.php";

if (isset($_POST['cEmail']) && isset($_POST['cPass']))
{
    $cEmail = mysqli_real_escape_string($conn, $_POST['cEmail']);
    $cPass = mysqli_real_escape_string($conn, $_POST['cPass']);

    if(empty($cEmail))
    {
        header("location: ../index.php?error = Email is required");
        exit();
    } else if(empty($cPass))
    {
        header("location: ../index.php?error = Password is required");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE Email = '$cEmail' AND Pass = '$cPass'";
        $sql_result = mysqli_query($conn,$sql);
        if (mysqli_fetch_row($sql_result) == 1)
        {
            $row = mysqli_fetch_array($sql_result);
            if($row['verificat'] == '1')
            {
                $_SESSION['auth'] = TRUE;
                $_SESSION['organizations'] = [
                    'Name' => $row['nume'],
                    'Email' => $row['email'],
                    'Adress' => $row['adresa'],
                    'Admin' => $row['admin'],
                ];
            }else
           
                {
                header("location: ../index.php?error=Please Verify your Email Adress.");
                exit();
                }

            } else
            {
                header("location: ../index.php?error=Incorect Name or Password");
                exit();
            }

        }
    }else{
        header("location: ../index.php");
        exit();
    }
