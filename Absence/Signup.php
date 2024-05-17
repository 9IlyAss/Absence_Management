<?php
session_start();
include("dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email2"];
        $password = $_POST["password2"];

        if (!empty($name) && !empty($lastname) && !empty($email) && !empty($password)) 
        {
            $stmt = mysqli_prepare($conn, "SELECT email FROM users WHERE email = ?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) > 0) 
            {
                echo "<script>alert('The email Already Exist !!');</script>";
            } else 
                {
                    $query = "INSERT INTO users (name, last_name, email, pass) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "ssss", $name, $lastname, $email, $password);
                    mysqli_stmt_execute($stmt);
                        echo "<script>alert('You have been Registered .'); window.location.href = 'signin.php';</script>";
                }
        } else 
            {
                echo "<script>alert('Some information are not correct. Please check again');</script>";
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
    <title>Sign Up</title>
</head>
<body>
    <div class="contenu2">
        <div class="Signup">
            <form method="post">
                <div class="field inside">
                    <h1>Sign Up</h1><br>
                    <label for="">Name</label><br><br>
                    <input type="text" name="name"><br><br>
                    <label for="">Last Name</label><br><br>
                    <input type="text" name="lastname"><br><br>
                    <label for="">Email</label><br><br>
                    <input type="email" name="email2"><br><br>
                    <label for="">Password</label><br><br>
                    <input type="password" name="password2"><br><br><br><br>
                    <input class="submit1" type="submit" name="sub2" value="Submit"><br><br>
                    <label>Already have an account? <a href="signin.php" class="log">Sign in</a></label>
                </div>
            </form>
        </div>
    </div>
    <style>
        body
        {
            background-color: rgb(243, 224, 200);
        }
    </style>
</body>
</html>
