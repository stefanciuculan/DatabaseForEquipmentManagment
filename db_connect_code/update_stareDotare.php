<?php
session_start();
include("db.php");

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ID_Dotare = $_POST['ID_Dotare'];
    $Stare_Noua = $_POST['Stare_Noua'];

    $query_verificare_dotare = "SELECT * FROM profesori_dotari WHERE ID_Profesor = '$ID_Profesor' 
                                AND ID_Dotare = '$ID_Dotare'";
    $result_verificare_dotare = mysqli_query($con, $query_verificare_dotare);

    if (mysqli_num_rows($result_verificare_dotare) > 0) {
        $query_actualizare_stare = "UPDATE dotari SET Stare = '$Stare_Noua' WHERE ID_Dotare = '$ID_Dotare'";
        $result_actualizare_stare = mysqli_query($con, $query_actualizare_stare);

        if ($result_actualizare_stare) {
            echo "<script type='text/javascript'> alert('Stare actualizată cu succes')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Eroare la actualizarea stării dotării')</script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Această dotare nu vă aparține')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizeaza Stare Dotare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <h1>Actualizeaza Stare Dotare</h1>
        <form method="POST" action="update_stareDotare.php">
            <label>ID Dotare</label>
            <input type="text" name="ID_Dotare" required>

            <label>Stare Nouă</label>
            <input type="text" name="Stare_Noua" required>

            <input type="submit" value="Actualizează Stare">
        </form>
    </div>
</body>
</html>
