<?php
    include ('db.php');
    session_start();
    
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header("location: login.php");
        die;
    }
    
    $ID_Profesor = $_SESSION['ID_Profesor'];

    // extrage dotarile care au o asociere cu profesorul in cauza
    $querySelectDotari = "SELECT * FROM dotari WHERE ID_Dotare IN 
                          (SELECT ID_Dotare FROM profesori_dotari WHERE ID_Profesor = '$ID_Profesor')";
    $resultDotari = mysqli_query($con, $querySelectDotari);
    
    // returneaza suma cantitatilor de dotari asociate profesorului in cauza
    $queryTotalCantitate = "SELECT SUM(Cantitate) AS TotalCantitate
                            FROM dotari
                            INNER JOIN profesori_dotari ON dotari.ID_Dotare = profesori_dotari.ID_Dotare
                            WHERE profesori_dotari.ID_Profesor = '$ID_Profesor'";

    $resultTotalCantitate = mysqli_query($con, $queryTotalCantitate);
    $rowTotalCantitate = mysqli_fetch_assoc($resultTotalCantitate);
    $totalCantitate = $rowTotalCantitate['TotalCantitate'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dotarile Mele</title>
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
        <h1>Dotarile Mele</h1>

        <div class="search-form">
            <form method="POST" action="cauta_dotare.php">
                <label>Cautare</label>
                <input type="text" name="Nume_Dotare" required>
                <input type="submit" value="Cauta">
            </form>
        </div>

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
                    while ($row = mysqli_fetch_assoc($resultDotari)) {
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
                <tr>
                <td colspan="3">Total Cantitate:</td>
                <td><?php echo $totalCantitate; ?></td>
                <td colspan="2"></td>
                </tr>
            </table>
        </div>

        <div class="signup">
            <form method="GET" action="insert.php" style="text-align: center;">
                <input type="submit" value="Insereaza Dotare" class="button">
            </form>

            <form method="GET" action="update_stareDotare.php" style="text-align: center;">
                <input type="submit" value="Actualizeaza Stare Dotare" class="button">
            </form>
            
            <form method="GET" action="max_qty.php" style="text-align: center;">
                <input type="submit" value="Dotare Cantitate Maxima" class="button">
            </form>

            <form method="GET" action="min_qty.php" style="text-align: center;">
                <input type="submit" value="Dotare Cantitate Minima" class="button">
            </form>

            <form method="GET" action="data_recenta.php" style="text-align: center;">
                <input type="submit" value="Cea Mai Recenta" class="button">
            </form>

            <form method="GET" action="delete_dotare.php" style="text-align: center;">
                <input type="submit" value="Sterge Dotare" class="button">
            </form>
        </div>
    </body>
</html>