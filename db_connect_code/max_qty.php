<?php
include('db.php');

session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor']; // id-ul profesorului curent

// alegem dotarea care apartine profesorului si are cea mai mare cantitate
$query = "SELECT *
          FROM dotari
          WHERE ID_Dotare IN (SELECT ID_Dotare FROM profesori_dotari WHERE ID_Profesor = '$ID_Profesor')
          AND Cantitate = (SELECT MAX(Cantitate) FROM dotari)";

$result = mysqli_query($con, $query);

if (!$result) {
    die('Eroare la interogare: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezultate Interogare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Rezultate Interogare</h1>
    <div class="dotari">
        <table border="1">
            <tr>
                <th>ID Dotare</th>
                <th>ID Categorie</th>
                <th>Nume Dotare</th>
                <th>Cantitate</th>
                <th>Stare</th>
                <th>ID Locatie</th>
            </tr>
            <?php
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ID_Dotare'] . "</td>";
                echo "<td>" . $row['ID_Categorie'] . "</td>";
                echo "<td>" . $row['Nume_Dotare'] . "</td>";
                echo "<td>" . $row['Cantitate'] . "</td>";
                echo "<td>" . $row['Stare'] . "</td>";
                echo "<td>" . $row['ID_Locatie'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
