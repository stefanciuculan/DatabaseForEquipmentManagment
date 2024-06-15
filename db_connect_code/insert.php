<?php
session_start();
include("db.php");

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $queryLocatieProfesor = "SELECT ID_Locatie FROM profesori_locatii WHERE ID_Profesor = '$ID_Profesor'";
    $resultLocatieProfesor = mysqli_query($con, $queryLocatieProfesor);

    if ($resultLocatieProfesor && mysqli_num_rows($resultLocatieProfesor) > 0) {
        $rowLocatieProfesor = mysqli_fetch_assoc($resultLocatieProfesor);
        $ID_Locatie = $rowLocatieProfesor['ID_Locatie'];

        $ID_Dotare = $_POST['ID_Dotare'];
        $ID_Categorie = $_POST['ID_Categorie'];
        $Nume_Dotare = $_POST['Nume_Dotare'];
        $Cantitate = $_POST['Cantitate'];
        $Stare = $_POST['Stare'];

        $queryDotari = "INSERT INTO dotari (ID_Dotare, ID_Categorie, Nume_Dotare, Cantitate, Stare, ID_Locatie) 
                        VALUES ('$ID_Dotare', '$ID_Categorie', '$Nume_Dotare', '$Cantitate', '$Stare', '$ID_Locatie')";
        $resultDotari = mysqli_query($con, $queryDotari);

        if ($resultDotari) {
            $queryProfesoriDotari = "INSERT INTO profesori_dotari (ID_Profesor, ID_Dotare) 
                                     VALUES ('$ID_Profesor', '$ID_Dotare')";
            $resultProfesoriDotari = mysqli_query($con, $queryProfesoriDotari);
        
            if ($resultProfesoriDotari) {
                echo "<script type='text/javascript'> alert('Dotare adăugată cu succes')</script>";
            } else {
                echo "<script type='text/javascript'> alert('Eroare la adăugarea dotării în profesori_dotari')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga Dotare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <h1>Adauga Dotare</h1>
        <form method="POST" action="insert.php">
            <label>ID Dotare</label>
            <input type="text" name="ID_Dotare" required>

            <label>Categorie</label>
            <input type="text" name="ID_Categorie" required>

            <label>Nume Dotare</label>
            <input type="text" name="Nume_Dotare" required>

            <label>Cantitate</label>
            <input type="text" name="Cantitate" required>

            <label>Stare</label>
            <input type="text" name="Stare" required>

            <input type="submit" value="Adaugă Dotare">
        </form>
    </div>
</body>
</html>