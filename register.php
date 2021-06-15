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
            <a class="header__logo">Logo</a>
        </header>

        <section class="register__cover">
            <div class="cover__filter"></div>
                <div class="cover__caption">
                    <div class="cover__caption__copy">
                        


                        <div>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <input placeholder="Name" name="name" type="text"> <br><br>
                                    <input placeholder="Surname"name="surname" type="text"> <br><br>
                                    <input placeholder="Username" name="user" type="username"> <br><br>
                                    <input placeholder="Password" name="pass" type="password"> <br><br>
                                    <input placeholder="Birthday" name="birthday" type="date"> <br><br>
                                    <input type="submit" name="submit" value="Register" class="button"> 
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
                                            echo "<h2 class='notification'>Successfully registered</h2>";
                                        }
                                        mysqli_close($conn);
                                    }else {
                                        echo "<h2 class='notification'>Don't leave blank input</h2>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
        </section>
    </body>
</html>