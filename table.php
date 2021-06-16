<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="style.css">
        </link>

    </head>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            font-family: "Arial";
        }


        .wrapper .header {
            background: #29a5d8;
        }

        .wrapper .title {
            padding: 50px 0;
            text-align: center;
            font-weight: 700;
            font-size: 32px;
            color: #fff;
        }

        .wrapper .search_box {
            max-width: 1000px;
            background: #29a5d8;
            margin: 0 auto;
            padding: 25px 0 50px;
            border-radius: 3px;
        }

        .wrapper .search_box input {
            border: 0;
            border-bottom: 2px solid #e5edfa;
            width: 100%;
            outline: none;
            padding: 10px;
            background: transparent;
            color: #fff;
            font-size: 16px;
        }

        ::placeholder {
            color: #121212;
        }

        .wrapper .search_box input:focus {
            border-bottom: 2px solid #fff;
        }

        .table_wrap {
            width: 1500px;
            margin: 50px auto 0;
        }

        .table_wrap ul li .item {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 15px 0;
            height: 50px;
        }

        .table_wrap ul li .item .name,
        .table_wrap ul li .item .surname,
        .table_wrap ul li .item .password,
        .table_wrap ul li .item .actions,
        .table_wrap ul li .item .birthday,
        .table_wrap ul li .item .username {
            width: 20%;
            padding: 0 15px;
        }

        .table_wrap ul li .item .name span {
            width: 90%;
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table_header ul li .item {
            border-bottom: 2px solid #eaeaea;
            font-weight: 600;
        }

        .table_body {
            height: 300px;
            overflow: auto;
        }

        .table_body ul li .item {
            border-bottom: 1px solid #efefef;
        }

        .table_body ul li .item .open {
            background: #e5edfa;
            color: #5a8ee4;
        }

        .table_body ul li .item .fixed {
            background: #cff1f0;
            color: #0dbeb6;
        }

        .table_body ul li .item .closed {
            background: #fedfe5;
            color: #ff89a0;
        }

        .table_body ul li .item .hold {
            background: #fff0db;
            color: #f59d39;
        }

        .table_body ul li .item .reopened {
            background: #d6f2ff;
            color: #29a5d8;
        }

        .table_body ul li .item .canceled {
            background: #ffdbd6;
            color: #e87060;
        }
    </style>

    <body>
        <header class="header clearfix">
                <a class="header__logo">Logo</a>
                <a href=""></a>
                <button  type="button" class="header__back" ><a href="index.php">Back</a></button>
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
                        echo    '<div class="password">';
                        echo        '<span class="open">'. $row['Password']. '</span>';
                        echo    '</div>';
                        echo    '<div class="birthday">';
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