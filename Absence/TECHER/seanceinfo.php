<?php
include("../dbconn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence Form</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #333;
    }

    .presence-form {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .form-group {
        flex-basis: 100%;
        margin-bottom: 1rem;
    }

    label {
        display: block;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: #333;
    }

    input[type="text"] {
        width: 100%;
        padding: 0.5rem;
        font-size: 1.2rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button[type="submit"] {
        padding: 0.5rem 1rem;
        font-size: 1.2rem;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 0.5rem;
        border: 1px solid #ccc;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    h2 {
        font-size: 2rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
    }
    </style>

<body>
    <div class="container">
        <h1>Presence Form</h1>
        <form method="post" class="presence-form">
            <div class="form-group">
                <label>Session Number You Want to check:</label>
                <input type="text" name="nbr" id="nbr" required>
                <button type="submit">Check</button>
            </div>
        </form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $nbr = $_POST["nbr"];
        $update_sql = "UPDATE seance SET nbr_absence = (SELECT COUNT(presence) FROM absence WHERE presence = 'no' AND session = ?) WHERE seance_number = ?";
        $stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($stmt, "ss", $nbr, $nbr);
        mysqli_stmt_execute($stmt);

#hna Absence number
        $select_sql = "SELECT nbr_absence FROM seance WHERE seance_number = ?";
        $stmt = mysqli_prepare($conn, $select_sql);
        mysqli_stmt_bind_param($stmt, "s", $nbr);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $nbr_absences = $row['nbr_absence'];
            echo "<h4>Number of Absences: $nbr_absences</h4>";


#hna Presence number
        $select_sql = "SELECT COUNT(presence) FROM absence WHERE presence = 'Yes' AND session = ?";
        $stmt = mysqli_prepare($conn, $select_sql);
        mysqli_stmt_bind_param($stmt, "s", $nbr);
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $nbr_absences = $row['COUNT(presence)'];
            echo "<h4>Number of Presence: $nbr_absences</h4>";


#hado shab no
            $sql_no = "SELECT name, last_name FROM absence WHERE presence = 'no' AND session = '$nbr'";
            $result_no = mysqli_query($conn, $sql_no);
            echo "<h2>Absence List</h2>";
            if (mysqli_num_rows($result_no) > 0) 
            {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Last Name</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result_no)) 
                {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else 
                {
                    echo "No results found for absentees.";
                }

#hado shab yes
            $sql_yes = "SELECT name, last_name FROM absence WHERE presence = 'yes' AND session = '$nbr' ";
            $result_yes = mysqli_query($conn, $sql_yes);
            echo "<h2>Presence List</h2>";
            if (mysqli_num_rows($result_yes) > 0) 
            {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Last Name</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result_yes)) 
                {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["last_name"] ."</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else 
                {
                    echo "No results found for those present.";
                }
        
        mysqli_close($conn);
    }
?>
    </div>
</body>
</html>