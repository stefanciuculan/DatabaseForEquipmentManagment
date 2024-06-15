<?php
    include ('db.php');
    session_start();
    
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header("location: login.php");
        die;
    }
    
    $ID_Profesor = $_SESSION['ID_Profesor'];

    $queryLocatieCurenta = "SELECT ID_Locatie FROM profesori_locatii WHERE ID_Profesor = '$ID_Profesor'";
    $resultLocatieCurenta = mysqli_query($con, $queryLocatieCurenta);
    $rowLocatieCurenta = mysqli_fetch_assoc($resultLocatieCurenta);
    $idLocatieCurenta = $rowLocatieCurenta['ID_Locatie'];

    // selecteaza profesorii care au in comun aceeasi locatie cu profesorul autentificat
    $queryColegi = "SELECT profesori.ID_Profesor, profesori.Nume_Profesor, profesori.Email
                    FROM profesori
                    INNER JOIN profesori_locatii ON profesori.ID_Profesor = profesori_locatii.ID_Profesor
                    WHERE profesori_locatii.ID_Locatie = '$idLocatieCurenta'
                    AND profesori.ID_Profesor != '$ID_Profesor'";
    $resultColegi = mysqli_query($con, $queryColegi);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Colegii Mei</title>
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
        <h1>Colegii Mei</h1>
        <div class="colegi">
            <table border="1">
                <tr>
                    <th>ID Profesor</th>
                    <th>Nume Profesor</th>
                    <th>Email</th>
                </tr>
                <?php
                    while ($row = mysqli_fetch_assoc($resultColegi)) {
                        echo "<tr>";
                        echo "<td>" . $row['ID_Profesor'] . "</td>";
                        echo "<td>" . $row['Nume_Profesor'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>
