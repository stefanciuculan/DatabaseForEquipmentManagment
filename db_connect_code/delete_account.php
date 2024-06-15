<?php
session_start();
include("db.php");

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
    die;
}

$ID_Profesor = $_SESSION['ID_Profesor'];

$queryStergereProfesorLocatii = "DELETE FROM profesori_locatii WHERE ID_Profesor = '$ID_Profesor'";
mysqli_query($con, $queryStergereProfesorLocatii);

$queryStergereProfesorDotari = "DELETE FROM profesori_dotari WHERE ID_Profesor = '$ID_Profesor'";
mysqli_query($con, $queryStergereProfesorDotari);

$queryStergereProfesor = "DELETE FROM profesori WHERE ID_Profesor = '$ID_Profesor'";
$resultStergereProfesor = mysqli_query($con, $queryStergereProfesor);

if ($resultStergereProfesor) {
    session_unset();
    session_destroy();

    header("location: login.php");
} else {
    echo "<script type='text/javascript'> alert('Eroare la ștergerea contului')</script>";
}
?>
