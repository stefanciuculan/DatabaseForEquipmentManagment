<?php
    include ('db.php');
    session_start();
    
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header("location: login.php");
        die;
    }
?>
    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <h1>Welcome!</h1>
        <div class="signup">
            <form method="GET" action="dotari.php" style="text-align: center;">
                <input type="submit" value="Dotarile Mele" class="button">
            </form>

            <form method="GET" action="colegi.php" style="text-align: center;">
                <input type="submit" value="Colegi" class="button">
            </form>

            <form method="GET" action="profil.php" style="text-align: center;">
                <input type="submit" value="Profilul Meu">
            </form>

            <form method="POST" action="logout.php" style="text-align: center;">
                <input type="submit" value="Logout">
            </form>
        </div>
    </body>
</html>