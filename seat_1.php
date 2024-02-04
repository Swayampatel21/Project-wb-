<!DOCTYPE html>
<html>
    <head>
        <title>Box Matrix</title>
        <style>
            /* Your CSS styles here */
            .box {
                width: 50px;
                height: 50px;
                border: 1px solid black;
                text-align: center;
                line-height: 50px;
                display: inline-block;
                margin: 12px;
                padding: 0px;
                border: green solid 1px;
                transform: rotateX(-0deg);
            }
            .screen {
                background: black;
                height: 70px;
                width: 50%;
                margin-left: 20px;
                margin: 15px 0;
                transform: rotateX(-90deg);
                box-shadow: 0 3px 10px rgba(255,255,255,0.7);
                border:black solid 3px;
            }
            .container {
                perspective: 1000px;
                margin: 40px 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <form method="POST">

            <p>Screen Id</p><input type="text" name="scrID" required>
            <p>Theater name:</p><select  name="theaterName" required>
                <option value=''>--- SELECT ---</option>
                <option value='Raj Theater'>Raj Theater</option>
                <option value='Inox'>Inox</option>
            </select>
            <p>Screen Capacity</p><input type="number" name="scrCap" required>

            <p>Row:</p><input type="number" name="row" required>
            <p>Column:</p><input type="number" name="col" required>
            <input type="submit" value="Submit">
        </form>
        <div class="container">
            <?php
            session_start();
            $conn = mysqli_connect("localhost", "root", "", "in_movie");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
// Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                extract($_POST);

                // Check for successful database connection
                // Initialize thtID
                $thtID = 0;

                // Determine thtID based on theaterName
                if ($theaterName == "Raj Theater") {
                    $thtID = 1;
                } elseif ($theaterName == "Inox") {
                    $thtID = 2;
                } // Add more conditions if needed
                // Use prepared statements to insert data safely
                $sql = "INSERT INTO screens (scr_id, tht_id, scr_capacity, scr_rows, scr_cols) VALUES ( ?, ?, ?, ?, ? )";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {

                    mysqli_stmt_bind_param($stmt, "iiiii", $scrID, $thtID, $scrCap, $row, $col);

                    // Execute the statement
                    $result = mysqli_stmt_execute($stmt);
               
                    $_SESSION['scrID'] = $scrID;
                    if ($result) {
                        echo "Data entered successfully.";
                    } else {
                        echo "Data not entered. Error: " . mysqli_error($conn);
                    }

                    // Close the prepared statement
                    mysqli_stmt_close($stmt);
                } else { 
                    echo "Prepared statement creation failed. Error: " . mysqli_error($conn);
                }
              

                $sql = "SELECT scr_rows AS Row, scr_cols AS Col FROM screens WHERE scr_id='$scrID'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                echo "<div align='center'>";

                $Row = $row["Row"];
                $Col = $row["Col"];

                for ($i = 1; $i <= $Row; $i++) {
                    echo $i . "&nbsp;&nbsp;&nbsp;";
                    for ($j = 1; $j <= $Col; $j++) {
                       echo "<div class='box'>" . "$j" . "</div>";
                    }
                    echo "<br>";
                }
                echo "</div>";
                // Close the database connection
                mysqli_close($conn);
            }
            ?>

            <div class="screen" align="center"></div>
        </div>
        <!-- ... Rest of your HTML ... -->

        <script>
            // Your JavaScript code here
        </script>
    </body>
</html>
