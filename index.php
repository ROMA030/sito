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

        <section class="cover">
            <div class="cover__filter"></div>
                <div class="cover__caption">
                    <div class="cover__caption__copy">
                        <h2>
                            Prova Login
                        </h2>

                        <div>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <input placeholder="Username" name="user" type="username">
                                    <input placeholder="Password" name="pass" type="password"> <br><br>
                                    <input type="submit" name="submit" value="Login" class="button">
                                    <button href="register.php" type="button" class="button">Register</button>
                            </form>

                            <?php
                                $username = $password = "";
                                // Used for connect to the database called "sito"
                                $conn = mysqli_connect("localhost","root","","sito");

                                // When submit is pressed, it assigne to username and password variables what you have written in form inputs
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $username = $_POST["user"];
                                    $password = $_POST["pass"];

                                    // If forum inputs aren't empty
                                    if (!empty($username) && !empty($password)) {
                                        // Find user and password from databse 'users' (variable) 
                                        $users = "SELECT * FROM users WHERE Utente = '$username' and Password = '$password'";
                                        // Perform the query, WHERE: database named 'sito' (line 30), WHAT TO DO: line 47
                                        $result = mysqli_query($conn, $users);

                                        // If number of rows in result variable is major than 0
                                        if (mysqli_num_rows($result) > 0) {
                                            echo "<h2>Successfully access</h2>";
                                        }else {
                                            echo "<h2>Username or password incorrect</h2>";
                                        }
                                        mysqli_close($conn);
                                    }else {
                                        echo "<h2>Don't leave blank input</h2>";
                                    }
                                }

                                // If there is an error connecting to database, exit 
                                if (mysqli_connect_errno()) {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                    exit();
                                }
                            ?>
                        </div>
                    </div>
                </div>
        </section>
        
        
        
        
        
        


    </body>

</html>     