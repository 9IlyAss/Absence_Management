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
        background-color: rgb(243, 224, 200);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        text-align: center;
        background-color: rgb(95, 175, 159);
        border-radius: 10px;
        padding: 30px;
        max-width: 400px;
        box-shadow: 0 4px 10px rgba(14, 14, 14, 0.9);
    }

    h1 {
        font-size: 30px;
        margin-bottom: 30px;
        color: #333;
    }

    .button-container {
        position: relative;
        margin-top: 20px;
    }

    .button-container .button {
        background-color: rgb(38, 70, 63);
        color: white;
        padding: 20px 40px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 24px;
        transition: background-color 0.3s;
    }

    .button-container .button:hover {
        background-color: rgba(14, 14, 14, 0.9);
    }

    .options {
        position: absolute;
        top: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%);
        background-color: rgb(219, 212, 175);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        display: none;
        z-index: 1;
        transition: opacity 0.3s, transform 0.3s;
        width: 300px; 
    }

    .options a {
        display: block;
        text-decoration: none;
        color: #333;
        padding: 15px 0; 
        font-size: 20px;
        transition: color 0.3s;
    }

    .options a:hover {
        color: rgb(57, 133, 107);
    }

    .button-container:hover .options {
        display: block;
        opacity: 1;
        transform: translate(-50%, 0);
    }

    </style>
</body>
</html>