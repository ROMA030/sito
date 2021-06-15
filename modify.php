<?php
    $name = $surname = $birthday = $username = $password = "";
    $conn = mysqli_connect("localhost","root","","sito");
    
    // If there is an error connecting to database, exit 
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $username = $_GET['user'];

    $checkUser = "SELECT * FROM users WHERE Utente = '$username'";
    $checkResult = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($checkResult) > 0) {
        while($row = $checkResult->fetch_assoc()) {
            if ($row['Utente'] == $username) {
                if (mysqli_num_rows($checkResult) > 0) {
                    $name = $row["Nome"];
                    $surname = $row["Cognome"];
                    $birthday = $row["DataNascita"];
                    $username = $row["Utente"];
                    $password = $row["Password"];

                    echo '<h3>Update Data</h3>';
                    echo "<form method='post'>";
                    echo '  <input value='. $name .' placeholder="Name" name="name" type="text">';
                    echo '  <input value='. $surname .' placeholder="Surname"name="surname" type="text">';
                    echo '  <input value='. $username .' placeholder="Username" name="user" type="username">';
                    echo '  <input value='. $password .' placeholder="Password" name="pass" type="password">';
                    echo '  <input value='. $birthday .' placeholder="Birthday" name="birthday" type="date">';
                    echo "  <input type='submit' name='submit' value='Apply' class='button'>";
                    echo '</form>';
                }
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prevUser = $username;
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $birthday = $_POST["birthday"];
        $username = $_POST["user"];
        $password = $_POST["pass"];

        if (!empty($name) && !empty($surname) && !empty($birthday) && !empty($username) && !empty($password)) {
            if ($prevUser != $username) {
                $checkUser = "SELECT * FROM users WHERE Utente = '$username'";
                $checkResult = mysqli_query($conn, $checkUser);

                if (mysqli_num_rows($checkResult) > 0) {
                    echo "<h2 class='notification'>Username already exists</h2>";
                }else {
                    $users = "UPDATE `users` SET `Nome` = '$name', `Cognome` = '$surname', `DataNascita` = '$birthday', `Utente` = '$username', `Password` = '$password' WHERE `Utente` = '$prevUser'";
                    //$users = "UPDATE users SET Utente = '$username' WHERE Utente = '$prevUser'";
                    $result = mysqli_query($conn, $users);
                    echo "<h2 class='notification'>". $username ."</h2>";
                    header("location: table.php");
                    mysqli_close($conn);
                    exit();
                }
            }else{
                $users = "UPDATE `users` SET `Nome` = '$name', `Cognome` = '$surname', `DataNascita` = '$birthday', `Utente` = '$username', `Password` = '$password' WHERE `Utente` = '$prevUser'";
                $result = mysqli_query($conn, $users);
                echo "<h2 class='notification'>". $username ."</h2>";
                header("location: table.php");
                mysqli_close($conn);
                exit();
            }
            
            //mysqli_close($conn);
        }else {
            echo "<h2 class='notification'>Don't leave blank input</h2>";
        }
    }

    //mysqli_close($conn);
    //header("Location: table.php");
?>



    