<?php
    session_start();
    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $Nume_Profesor = $_POST['Nume_Profesor'];
        $Email = $_POST['Email'];
        $ID_Locatie = $_POST['ID_Locatie'];

        if(!empty($Email) && !empty($Nume_Profesor) && !empty($ID_Locatie)) {
            
            $queryInsertProfesor = "INSERT INTO Profesori (Nume_Profesor, Email) VALUES ('$Nume_Profesor', '$Email')";
            mysqli_query($con, $queryInsertProfesor);

            $ID_Profesor = mysqli_insert_id($con);

            $queryInsertProfesorLocatie = "INSERT INTO profesori_locatii (ID_Profesor, ID_Locatie) VALUES ('$ID_Profesor', '$ID_Locatie')";
            mysqli_query($con, $queryInsertProfesorLocatie);

            echo "<script type='text/javascript'> alert('Successfully Register')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Please enter valid information')</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="signup">
            <h1>Sign Up</h1>
            <form method="POST">
                <label>Nume</label>
                <input type="text" name="Nume_Profesor" required>
                <label>Email</label>
                <input type="text" name="Email" required>
                <label>ID Locație</label>
                <input type="text" name="ID_Locatie" required>
                <input type="submit" value="Submit">
            </form>
            <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>
    </body>
</html>
