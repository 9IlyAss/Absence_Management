<?php
session_start();
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email1"];
    $password = $_POST["password1"];

    if (!empty($email) && !empty($password)) 
    {
        $stmt = mysqli_prepare($conn, "SELECT name, last_name, pass FROM users WHERE email = ? AND pass = ?");
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name, $last_name, $db_password);
        mysqli_stmt_fetch($stmt);

        if ($password == $db_password) 
        {
            $_SESSION["email"] = $email;
            $_SESSION["lastname"] = $last_name;
            $_SESSION["name"] = $name;

            if ($email == "errajielmahdi@gmail.com") 
                {
                header("Location: TECHER/teacher.php");
                exit;
                } else 
                {
                    header("Location: STUDENT/student.php");
                    exit;
                }
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    
    <div class="contenu">
        <div class="login">
            <form method="post" class="formlogin">
                <div class="field inside">
                    <h1>Sign in</h1><br>
                    <label class="Email">Email</label><br>
                    <input type="email" name="email1" value="" class="input"><br><br>
                    <label class="PASSWORD">Password</label><br>
                    <input type="password" name="password1" value="" class="input"><br><br>
                    <input class="submit" type="submit" name="sub1" value="Log In"><br><br><br><br>
                    <label>Don't have an account? <a href="signup.php" class="signin">Sign up now</a></label>
                </div>
            </form>
        </div>
    </div>
    <style>
        body{
        background-color:rgb(95, 175, 159);
        }
    </style>
</body>
</html>
