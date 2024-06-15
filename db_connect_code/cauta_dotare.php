<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['Nume_Dotare'])) {
    $Nume_Dotare = $_POST['Nume_Dotare'];

    $queryDotare = "SELECT * FROM dotari WHERE Nume_Dotare = '$Nume_Dotare'";
    $resultDotare = mysqli_query($con, $queryDotare);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezultate Cautare Dotare</title>
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
    <h1>Rezultate Cautare Dotare</h1>
    <div class="dotari">
        <table border="1">
            <tr>
                <th>ID Dotare</th>
                <th>Categorie</th>
                <th>Nume Dotare</th>
                <th>Cantitate</th>
                <th>Stare</th>
                <th>Locatie</th>
            </tr>
            <?php
                while ($row = mysqli_fetch_assoc($resultDotare)) {
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

<?php
}
?>
