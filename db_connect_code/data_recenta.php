<?php
include('db.php');

session_start();


if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor'];

// selecteaza dotarile de la cea mai recenta pana la cea mai indepartata ca data de achizitie 
$query = "SELECT dotari.*, 
                 (SELECT Data_Achizitie 
                  FROM istoric_achizitii 
                  WHERE dotari.ID_Dotare = istoric_achizitii.ID_Dotare) AS Data_Achizitie
          FROM dotari
          INNER JOIN profesori_dotari ON dotari.ID_Dotare = profesori_dotari.ID_Dotare
          WHERE profesori_dotari.ID_Profesor = '$ID_Profesor' ORDER BY Data_Achizitie DESC";
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
                <th>Data Achizitie</th>
            </tr>
            <?php
            // Afisarea rezultatelor
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ID_Dotare'] . "</td>";
                echo "<td>" . $row['ID_Categorie'] . "</td>";
                echo "<td>" . $row['Nume_Dotare'] . "</td>";
                echo "<td>" . $row['Cantitate'] . "</td>";
                echo "<td>" . $row['Stare'] . "</td>";
                echo "<td>" . $row['ID_Locatie'] . "</td>";
                echo "<td>" . $row['Data_Achizitie'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
