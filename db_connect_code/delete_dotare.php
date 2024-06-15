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

    $query_verificare_dotare = "SELECT * FROM profesori_dotari WHERE ID_Profesor = '$ID_Profesor' 
                                AND ID_Dotare = '$ID_Dotare'";
    $result_verificare_dotare = mysqli_query($con, $query_verificare_dotare);

    if (mysqli_num_rows($result_verificare_dotare) > 0) {
        $query_stergere_dotare = "DELETE FROM dotari WHERE ID_Dotare = '$ID_Dotare'";
        $result_stergere_dotare = mysqli_query($con, $query_stergere_dotare);

        if ($result_stergere_dotare) {
            echo "<script type='text/javascript'> alert('Dotare ștearsă cu succes')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Eroare la ștergerea dotării')</script>";
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
    <title>Sterge Dotare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <h1>Sterge Dotare</h1>
        <form method="POST" action="delete_dotare.php">
            <label>ID Dotare</label>
            <input type="text" name="ID_Dotare" required>

            <input type="submit" value="Șterge Dotare">
        </form>
    </div>
</body>
</html>
