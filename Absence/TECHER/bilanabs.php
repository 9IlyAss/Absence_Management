<?php
include("../dbconn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billan</title>
  <style>
    table {
      color: black;
      font-family: monospace;
      font-size: x-large;
      align-items: center;
      justify-content: center;
      transform: translate(50%, 10%);
      width: 50%;
      border-collapse: collapse;
    }
    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid black;
    }
    th {
      background-color: rgb(95, 175, 159);
      color: white;
    }
    tr:hover {
      background-color: rgb(160, 211, 201);
    }
    .table-title {
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      margin-bottom: -60px;
    }
    .class {
      top: 50%;
      left: 50%;
      padding-top: 200px;
    }
    body {
      background-color: rgb(243, 224, 200);
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="class">
    <div class="table-title"><h1>Les Information De L'Etudiant</h1></div>
    <br><br>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      $name = $_POST['Name'];
      $sql = "SELECT name, last_name, SUM(CASE WHEN presence = 'no' THEN 1 ELSE 0 END) AS nbrAbsence 
              FROM absence 
              WHERE last_name Like '%$name%' 
              GROUP BY name, last_name";

      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) 
      {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Last name</th>";
        echo "<th>NbrAbsence</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result))
        {
          echo "<tr>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["last_name"] . "</td>";
          echo "<td>" . $row["nbrAbsence"] . "</td>";
          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
      } else 
        {
          echo "No results found.";
        }
    }
  mysqli_close($conn);
?>
  </div>
</body>
</html>
