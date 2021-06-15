<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="style.css">
        </link>

        <style>
            table {
            width:100%;
            }
            table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
            th, td {
            padding: 15px;
            text-align: left;
            }
            #t01 tr:nth-child(even) {
            background-color: #eee;
            }
            #t01 tr:nth-child(odd) {
            background-color: #fff;
            }
            #t01 th {
            background-color: black;
            color: white;
            }
        </style>
        
    </head>

    <body>
        <header class="header clearfix">
                <a class="header__logo">Logo</a>
        </header>

        <div>
            <?php
                $name = $surname = $birthday = $username = $password = "";
                // Used for connect to the database called "sito"
                $conn = mysqli_connect("localhost","root","","sito");
                
                $list = "SELECT * FROM users";
                $result = mysqli_query($conn, $list);

                echo "<table style='width:100%' id='t01'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Surname</th>";
                echo "<th>Username</th> ";
                echo "<th>Password</th>";
                echo "<th>Birthday</th>";
                echo "</tr>";
                 
                if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $row['Nome']. "</th>";
                        echo "<td>". $row['Cognome']. "</th>";
                        echo "<td>". $row['Utente']. "</th>";
                        echo "<td>". $row['Password']. "</th>";
                        echo "<td>". $row['DataNascita']. "</th>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>