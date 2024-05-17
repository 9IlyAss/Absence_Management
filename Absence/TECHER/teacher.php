<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    
    
</head>
<body>
    <div class="container">
        <h1>Welcome back Mr.<?php echo $_SESSION["lastname"]; ?></h1>
        <div class="button-container">
            <button class="button">List options</button>
            <div class="options">
                <a href="seance.php">Create une Session</a>
                <a href="seanceinfo.php">Session information</a>
                <a href="bilanabs.html">Student information</a>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .button-container {
            position: relative;
            margin-top: 20px;
        }

        .button-container .button {
            background-color: #4CAF50;
            color: white;
            padding: 20px 40px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 24px;
        }

        .button-container .button:hover {
            background-color: #45a049;
        }

        .options {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            display: none;
            z-index: 1;
        }

        .options a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 10px 0;
            font-size: 20px;
        }

        .button-container:hover .options {
            display: block;
        }
    </style>
</body>
</html>
