<?php
session_start();
include("../dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $presence = $_POST["presence"];
        $password = $_POST["code"];
        $agreement = $_POST["agreement"];
        $nbr = $_POST["nbr"];

            $sql = "SELECT seance_number, seance_key FROM seance WHERE seance_number = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $nbr);
            mysqli_stmt_execute($stmt);
            $result1 = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result1) > 0) 
        {
            $data = mysqli_fetch_assoc($result1);
            if($data["seance_key"] == $password) 
            {
                $absenceValue = ($presence == "Yes") ? "Yes" : "No";

                $insert = "INSERT INTO absence (name, last_name, session, presence) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insert);
                mysqli_stmt_bind_param($stmt, "ssis", $_SESSION['name'], $_SESSION['lastname'], $nbr, $absenceValue);
                mysqli_stmt_execute($stmt);
                    echo "<script>alert('Presence recorded successfully.'); window.location.href = '../signin.php';</script>";
                exit();
            
            } else 
                {
                    $insert = "INSERT INTO absence (name, last_name, session, presence) VALUES (?, ?, ?, ?)";
                    $absenceValue = "No";
                    $stmt = mysqli_prepare($conn, $insert);
                    mysqli_stmt_bind_param($stmt, "ssis", $_SESSION['name'], $_SESSION['lastname'], $nbr, $absenceValue);
                    mysqli_stmt_execute($stmt);
                        echo "<script>alert('Presence recorded successfully.'); window.location.href = '../signin.php';</script>";
                exit();
                }
        } else 
            {
                echo "<script>alert('Seance number does not exist.');</script>";
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
    <title>Presence Form</title>
</head>
<body>
    <div class="container">
        <h1 >Presence Form </h1>
        <form id="presenceForm" method="post" class="presence-form">
            <div class="form">
                <input type="radio" name="presence" value="Yes" id="presentRadio" required>
                <label for="presentRadio">Present</label>
                
                <input type="radio" name="presence" value="No" id="absentRadio" required>
                <label for="absentRadio">Absent</label>
            </div>
            <div class="form-group" id="sessionNumberGroup">
                <label>Write Session Number:</label>
                <input type="text" name="nbr" id="nbr" required>
            </div>
            <div class="form-group" id="codeGroup">
                <label>Write the Code:</label>
                <input type="text" name="code" id="code" required>
            </div>
            <div class="form-group">
                <input type="checkbox" name="agreement" value="agreed" required>
                <label>I understand the consequences of lying</label>
            </div>
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: rgb(90, 255, 200);
        background-image: linear-gradient(90deg, rgb(95, 175, 159) 50%, transparent 50%),
        linear-gradient(90deg, rgb(95, 175, 159) 50%, transparent 50%);
        background-size: 1510px 1(&àpx;
    }
    
    .container {
        background-color: rgb(243, 235, 226);
        max-width: 500px;
        margin: 50px auto;
        
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.9);
        margin-top: 150px
    }
    
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: rgb(33, 129, 97);
    }
    
    .presence-form {
        display: flex;
        flex-direction: column;
    }
    
    .form{
    margin-bottom: 20px;
    margin-left: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

    .form-group {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    input[type="radio"] + label {
    margin-left: 2px; 
    }

    label {
    padding-right: 90px;
    }

    label {
        font-weight: bold;
    }
    
    input[type="text"],
    input[type="checkbox"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    
    button[type="submit"]:hover {
        background-color: rgb(33, 129, 97);
    }
    
    .submit{
    background-color: rgb(95, 175, 159);
    border: none;
    border-radius: 12px;
    transition: background-color 1.5s, color 1s, padding 1s;
    height: 30px;
    width: 170px;
    font-size: 14px;
    cursor: pointer;
    
    }
    </style>
    <script src="student.js"></script>

</body>
</html>
