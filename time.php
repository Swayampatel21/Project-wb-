<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Weekly Schedule</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            header {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 20px;
            }

            h1 {
                font-size: 36px;
                margin: 0;
            }

            .schedule {
                max-width: 80%;
                margin: 20px auto;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }

            table {
                width: 100%;
            }

            table, th, td {
                border: 1px solid #ccc;
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                text-align: center;
            }

            th {
                background-color: #333;
                color: #fff;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            /* Style the input buttons */
            input[type="submit"] {
                background-color: #0074d9; /* Button background color */
                color: #fff; /* Text color */
                border: none;
                border-radius: 4px; /* Rounded corners */
                padding: 10px 20px; /* Adjust the padding as needed */
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s; /* Add a smooth hover effect */
            }

            /* Style the input buttons on hover */
            input[type="submit"]:hover {
                background-color: #0056b3; /* Button background color on hover */
            }
        </style>
    </head>
    <body>
        <form action="seat_2.php">
            <header>
                <h1><?php
                    $_SESSION['sesName'] = $_GET['name'];

                    echo $_SESSION['sesName'];
                    ?></h1>
            </header>
            <?php
            // Connect to database
            $name = $_GET['name'];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "in_movie";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "SELECT mtime,mDate FROM screen where mname='$name'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            ?>


            <div class="schedule">

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        
                    </tr>
                    <?php
                    $sql1 = "SELECT * from screen where mname='$name'";
                    $res = mysqli_query($conn, $sql1);
                    while ($row1 = mysqli_fetch_assoc($res)) {
                        ?>
                        <tr>
                            <td><?php echo $row1['mDate'] ?></td>
                            <input type="hidden" name='scr_id' value="<?php echo $row1['scr_id']; ?>"/>
                            <td><input type="submit" name="mTime" value="<?php echo $row1['mtime']; ?>"/></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
        </form>
    </div>
</body>
</html>
