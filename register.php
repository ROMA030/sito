<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="style.css">
        </link>
        
    </head>

    <body>
        <header class="header clearfix">
            <h1>Registrazione</h1>
        </header>

        <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input name="name" placeholder="Name" type="text">
                    <input name="surname" placeholder="Surname" type="text">
                    <input name="birthday" placeholder="Birthday" type="date">
                    <input name="user" placeholder="User" type="username">
                    <input name="pass" placeholder="Password" type="password">
                    <input type="submit" name="submit" value="Submit">
            </form>

            <?php
                $name = $surname = $birthday = $username = $password = "";
                // Used for connect to the database called "sito"
                $conn = mysqli_connect("localhost","root","","sito");

                // If there is an error connecting to database, exit 
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                // When submit is pressed, it assigne to username and password variables what you have written in form inputs
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = $_POST["name"];
                    $surname = $_POST["surname"];
                    $birthday = $_POST["birthday"];
                    $username = $_POST["user"];
                    $password = $_POST["pass"];

                    // If forum inputs aren't empty
                    if (!empty($name) && !empty($surname) && !empty($birthday) && !empty($username) && !empty($password)) {
                        
                        $checkUser = "SELECT * FROM users WHERE Utente = '$username'";
                        // Perform the query, WHERE: database named 'sito' (line 30), WHAT TO DO: line 47
                        $checkResult = mysqli_query($conn, $checkUser);

                        // If number of rows in result variable is major than 0
                        if (mysqli_num_rows($checkResult) > 0) {
                            echo "<h2>Username already exists</h2>";
                        }else {
                            $users = "INSERT INTO users(Utente, Password, Nome, Cognome, DataNascita) VALUES ('$username', '$password', '$name', '$surname', '$birthday')";
                            $result = mysqli_query($conn, $users);
                            echo "<h2>Successfully registered</h2>";
                        }
                        mysqli_close($conn);
                    }else {
                        echo "<h2>Don't leave blank input</h2>";
                    }
                }
            ?>
        </div>
    </body>
</html>