<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="style.css"></link>
    </link>

    </head>


    <body>
        <header class="header clearfix">
                <a class="header__logo">Logo</a>
                <a href="index.php" class="header__back1">Log out</a>
        </header>

        <div>

            <input type="text" id="search_input" placeholder="Search by username">

            <div class="table_wrap">
                <div class="table_header">
                    <ul>
                        <li>
                            <div class="item">
                                <div class="name">
                                    <span>NAME</span>
                                </div>
                                <div class="surname">
                                    <span>SURNAME</span>
                                </div>
                                <div class="username">
                                    <span>USER</span>
                                </div>
                                <div class="password">
                                    <span>PASSWORD</span>
                                </div>
                                <div class="birthday">
                                    <span>BIRTHDAY</span>
                                </div>
                                <div class="actions">
                                    <span>ACTIONS</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

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

                echo '<div class="table_body">';
                echo '<ul>';
                if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li>';
                        echo     '<div class="item">';
                        echo         '<div class="name">';
                        echo             '<span>'. $row['Nome']. '</span>';
                        echo    '</div>';
                        echo    '<div class="surname">';
                        echo        '<span>'. $row['Cognome']. '</span>';
                        echo    '</div>';
                        echo    '<div class="username">';
                        echo        '<span>'. $row['Utente']. '</span>';
                        echo    '</div>';
                        echo    '<div class="password" style="color:black>';
                        echo        '<span class="open">'. $row['Password']. '</span>';
                        echo    '</div>';
                        echo    '<div class="birthday" style="color:black>';
                        echo        '<span class="open">'. $row['DataNascita']. '</span>';
                        echo    '</div>';
                        echo    '<div class="actions">';
                        echo        "<a id='table__hype' href=\"delete.php?user=".$row['Utente']."\">Delete</a> <a id='table__hype'>". ' | ' ."</a> <a id='table__hype' href=\"modify.php?user=".$row['Utente']."\">Modify</a>";
                        echo    '</div>';
                        echo     '</div>';
                        echo '</li>';
                    }
                }
                echo '</ul>';
                echo '</div>';
                echo '</div>';

                mysqli_close($conn);
            ?>

        </div>

        <script>
            var search_input = document.querySelector("#search_input");
            search_input.addEventListener("keyup", function(e){
                var span_items = document.querySelectorAll(".table_body .username span");
                var table_body = document.querySelector(".table_body ul");
                var search_item = e.target.value.toLowerCase();
                span_items.forEach(function(item){
                    if(item.textContent.toLowerCase().indexOf(search_item) != -1){
                        item.closest("li").style.display = "block";
                    }
                    else{
                        item.closest("li").style.display = "none";
                    }
                })
            });
        </script>
    </body>
</html>