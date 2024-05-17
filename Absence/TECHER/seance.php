<?php
session_start();
include("../dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $cod = $_POST["code"];
        $seancenbr = $_POST["seance_number"];
        if (!empty($cod) && !empty($seancenbr)) 
        {
            $sql = "SELECT seance_number FROM seance WHERE seance_number = '$seancenbr'";
            $result1 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result1) == 0) 
            {
                $query = "INSERT INTO seance (seance_number, seance_key) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "is", $seancenbr, $cod);
                mysqli_stmt_execute($stmt);
                    echo "<script>alert('The Session has been Created'); window.location.href = 'teacher.php';</script>";
            } else 
                {
                    echo "<script>alert('The Session Already Exists !!');</script>";
                }
        } else 
            {
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
    <link rel="stylesheet" href="styles.css">
    <title>Teacher's Attendance Form</title>
</head>
<body>
    <div class="container">
<h1>Teacher's Attendance Form </h1>
        <form method="post" class="attendance-form">
            <div class="form-group">
                <label for="seance_number">Seance Number:</label>
                <input type="text" name="seance_number" id="seance_number" required>
            </div>
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" name="code" id="code" required>
            </div>
            <button type="submit">Create a Session</button>
        </form>
    </div>


    <style>
        body 
        {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;      
            background-color: rgb(90, 255, 200);
            background-image: linear-gradient(90deg, rgba(255,255,255,0.2) 50%, transparent 50%),
            linear-gradient(90deg, rgba(255,255,255,0.2) 50%, transparent 50%);
            background-size: 1510px 1510px;
        }

        .container 
        {
            background-color: rgb(243, 235, 226);
        max-width: 500px;
        margin: 50px auto;
        
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.9);
        margin-top: 150px
        }

        h1
        {
            text-align: center;
            margin-bottom: 20px;
            color: rgb(33, 129, 97);
    
        }

        .attendance-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label 
        {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] 
        {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] 
        {
            background-color: rgb(66, 167, 153);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover 
        {
            background-color: rgb(139, 226, 215);
        }
        
    </style>
</body>
</html>