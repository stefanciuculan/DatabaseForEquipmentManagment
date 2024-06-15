<?php
    session_start();
    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $Nume_Profesor = $_POST['Nume_Profesor'];
        $ID_Profesor = $_POST['ID_Profesor']; 

        if(!empty($ID_Profesor) && !empty($Nume_Profesor) && is_numeric($ID_Profesor))
        {
            $query = "SELECT * FROM Profesori WHERE Nume_Profesor = '$Nume_Profesor' LIMIT 1";
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['ID_Profesor'] == $ID_Profesor)
                    {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['ID_Profesor'] = $ID_Profesor;
                        header("location: index.php");
                        die;
                    }
                }
            }
            echo "<script type='text/javascript'> alert('wrong username or id')</script>";
        }
        else
        {
            echo "<script type='text/javascript'> alert('wrong username or id')</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <form method="POST">
                <label>Nume</label>
                <input type="text" name="Nume_Profesor" required>
                <label>ID</label>
                <input type="text" name="ID_Profesor" required>
                <input type="submit" name="" value="Submit">
            </form>
            <p>Don't have an account? <a href="signup.php">Sign Up here</a> </p>
        </div>
    </body>
</html>