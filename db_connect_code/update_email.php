<?php
session_start();
include("db.php");

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Noul_Email = $_POST['Noul_Email'];

    if (filter_var($Noul_Email, FILTER_VALIDATE_EMAIL)) {
        $query_actualizare_email = "UPDATE profesori SET Email = '$Noul_Email' WHERE ID_Profesor = '$ID_Profesor'";
        $result_actualizare_email = mysqli_query($con, $query_actualizare_email);

        if ($result_actualizare_email) {
            echo "<script type='text/javascript'> alert('Email actualizat cu succes')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Eroare la actualizarea adresei de email')</script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Te rog să introduci un email valid')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizeaza Email</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <h1>Actualizeaza Email</h1>
        <form method="POST" action="update_email.php">
            <label>Noul Email</label>
            <input type="email" name="Noul_Email" required>

            <input type="submit" value="Actualizeaza Email">
        </form>
    </div>
</body>
</html>
