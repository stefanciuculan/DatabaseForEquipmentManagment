<?php
include('db.php');
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor'];

$querySelectProfesori = "SELECT * FROM profesori WHERE ID_Profesor = $ID_Profesor";
$resultProfesori = mysqli_query($con, $querySelectProfesori);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profilul Meu</title>
        <link rel="stylesheet" href="style.css">

        <script>
            function confirmaStergereCont() {
                var confirmare = confirm("Sunteți sigur că doriți să ștergeți contul?");
                if (confirmare) {
                    window.location.href = "delete_account.php";
                }
            }
        </script>

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
        <h1>Profilul Meu</h1>
        <div class="profil">
            <table border="1">
                <tr>
                    <th>ID Profesor</th>
                    <th>Nume Profesor</th>
                    <th>Email</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($resultProfesori)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_Profesor'] . "</td>";
                    echo "<td>" . $row['Nume_Profesor'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="signup">
            <form method="GET" action="update_email.php" style="text-align: center;">
                    <input type="submit" value="Actualizeaza Email" class="button">
            </form>

            <p>
                <button onclick="confirmaStergereCont()" class="button">Sterge Cont</button>
            </p>
        </div>
    </body>
</html>
