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
                <a href=""></a>
        </header>

        <div>
            <?php
                $name = $surname = $birthday = $username = $password = "";
                // Used for connect to the database called "sito"
                $conn = mysqli_connect("localhost","root","","sito");
                
                // If there is an error connecting to database, exit 
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                $list = "SELECT * FROM users";
                $result = mysqli_query($conn, $list);

                echo "<table style='width:100%' id='t01'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Surname</th>";
                echo "<th>Username</th> ";
                echo "<th>Password</th>";
                echo "<th>Birthday</th>";
                echo "<th>Actions</th>";
                echo "</tr>";
                 
                if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $row['Nome']. "</td>";
                        echo "<td>". $row['Cognome']. "</td>";
                        echo "<td>". $row['Utente']. "</td>";
                        echo "<td>". $row['Password']. "</td>";
                        echo "<td>". $row['DataNascita']. "</td>";
                        echo "<td><a id='table__hype' href=\"delete.php?user=".$row['Utente']."\">Delete</a></td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
                mysqli_close($conn);
            ?>
        </div>
        
        <input type="text">
    </body>
</html>