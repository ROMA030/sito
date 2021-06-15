<?php
    $conn = mysqli_connect("localhost","root","","sito");
    
    // If there is an error connecting to database, exit 
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $user = $_GET['user'];

    mysqli_query($conn,"DELETE FROM users WHERE Utente='".$user."'");
    mysqli_close($conn);
    header("Location: table.php");
?>