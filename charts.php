                


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
                <button  type="button" class="header__back"><a href="index.php">Back</a></button>
        </header>

        <div class="" id="uploadFilesForm">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

                <label for="sessionStart">Inserire ora inizio: </label><input type="time" name="sessionStart" id="sessionStart" style="padding-bottom: 15px" required><br>
                <label for="sessionEnd">Inserire data fine: </label><input type="time" name="sessionEnd" id="sessionEnd" style="padding-bottom: 15px" required><br>

                <label for="accCSV">ACC</label> <input type="file" name="accCSV" id="accCSV" style="padding-bottom: 15px" accept=".csv" required> <br>
                <label for="ecgCSV">ECG</label> <input type="file" name="ecgCSV" id="ecgCSV" style="padding-bottom: 15px" accept=".csv" required> <br>
                <label for="gyroCSV">GYRO</label> <input type="file" name="gyroCSV" id="gyroCSV" style="padding-bottom: 15px" accept=".csv" required> <br>
                <label for="otherCSV">OTHER</label> <input type="file" name="otherCSV" id="otherCSV" style="padding-bottom: 15px" accept=".csv" required> <br>

                <label for="note">Note:</br></label> <input type="text" name="note" id="note" style="padding-bottom: 15px" accept=".csv"> <br>

                <input type="numbesr" id="giocatore" name="giocatore" value="" hidden>


                <div class="">
                    <button type="submit" value="Carica file" id="finalCSV" class="btn btn-primary">Aggiungi</button>
                </div>
            </form>
        </div>

    <?php

        // Used for connect to the database called "sito"
        $conn = mysqli_connect("localhost","root","","sito");

        // If there is an error connecting to database, exit 
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        $username = "giovanni";
        
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $inizio = $_POST["sessionStart"];
            $fine = $_POST["sessionEnd"];
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['accCSV']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            $i = 0;
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $timestamp   = $line[0];
                $accX  = $line[1];
                $accY  = $line[2];
                $accZ = $line[3];

                // Check whether member already exists in the database with the same email
                if ($i == 0) {
                    $prevQuery = "SELECT Sessione FROM acc WHERE Utente = '".$username."'";
                    $sessionNumber = mysqli_query($conn, $prevQuery);
                    if (mysqli_num_rows($sessionNumber) == 0){
                        //$sessionNumber = 1;
                        $user_id = 1;
                    }elseif (mysqli_num_rows($sessionNumber) > 0){
                        $row = mysqli_fetch_assoc($sessionNumber);
                        $user_id =  $row['Sessione'];
                    }
                    echo '<h2>'. $user_id .'</h2>';
                }
                
                // Insert member data in the database
                $op = "INSERT INTO acc (Utente, Sessione, timestamp, accX, accY, accZ, inizio, fine) VALUES ('".$username."', '".$user_id."', '".$timestamp."', '".$accX."', '".$accY."', '".$accZ."', '".$inizio."', '".$accZ."')";
                $insert = mysqli_query($conn, $op);

                $i = $i + 1;
            }
            
            // Close opened CSV file
            fclose($csvFile);
        }

    ?>

    </body>
</html>