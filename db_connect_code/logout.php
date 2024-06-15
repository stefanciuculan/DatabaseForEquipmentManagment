<?php
session_start();
include("db.php");

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    session_unset();
    session_destroy();

    header("location: login.php");
    exit();
} else {
    echo "Error during logout";
}
?>
