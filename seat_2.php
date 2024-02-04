
<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            body {
                
            }

            .header {
                background-color: black;
                color:white;
            }

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
                transform: rotateX(0deg);
                cursor: pointer;
            }

            .box.selected {
                background-color: green; /* Change the background color here */
            }

            .box.blocked {
                background-color: red; /* Set the background color for blocked seats */
                pointer-events: none; /* Prevent clicking on blocked seats */
            }

            .screen {
                background: black;
                height: 70px;
                width: 50%;
                margin: 15px 0;
                transform: rotateX(-90deg);
                box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
                border: black solid 3px;
            }

            .container {
                perspective: 1000px;
                margin: 40px 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            span {
                color: #00df;
            }
        </style>
    </head>
    <body>
        <div class="header" align="center">
            <h1>WATCH BETTER</h1>
        </div>
    <center>
        <h2>MOVIE : <?php echo $_SESSION['sesName']; ?></h2>
        <h4> DATE : <?php echo date("d/m/Y"); $_SESSION['mDate'] = date("d/m/Y");  ?></h4>
        <h4>TIME : <?php echo $_GET['mTime']; $_SESSION['mTime'] = $_GET['mTime'];?></h4>
        
        
        
    </center>
        <h2 align="center">SCREEN <span id="scr"><?php echo $_GET['scr_id']; $_SESSION['scrID'] = $_GET['scr_id']; ?></span> </h2>
        <div class="container">
           <?php
    // Retrieve data from the database
    $conn = mysqli_connect("localhost", "root", "", "in_movie");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

//    if (isset($_SESSION['scrID'])) {
        $scrID = $_SESSION['scrID'];
        $sql = "SELECT `scr_rows` AS noRows,`scr_cols` AS noCols FROM `screens` WHERE scr_id='$scrID' ";
//    } else {
//        $sql = "SELECT `scr_rows` AS noRows,`scr_cols` AS noCols FROM `screens` WHERE  scr_id='1' ";
//        $scrID = 1;
//    }
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Create and display the matrix
    echo "<div align='center'>";

    $noRows = $row["noRows"];
    $noCols = $row["noCols"];

    $selectedSeatsQuery = mysqli_query($conn, "SELECT st_row, st_col FROM `seats` WHERE st_status = 1 AND st_scr_id ='$scrID'");
    $selectedSeats = array();

    while ($row = mysqli_fetch_assoc($selectedSeatsQuery)) {
        $selectedSeats[] = [$row['st_row'], $row['st_col']];
    }

    echo "<div align='center'>";

    for ($i = 1; $i <= $noRows; $i++) {
        for ($j = 1; $j <= $noCols; $j++) {
            $isBlocked = false;

            foreach ($selectedSeats as $seat) {
                if ($seat[0] == $i && $seat[1] == $j) {
                    $isBlocked = true;
                    break; // No need to continue checking
                }
            }

            if ($isBlocked) {
                echo "<div class='box blocked'>";
            } else {
                echo "<div class='box' onclick='toggleBox(this)'>";
            }

            echo "$i,$j";
            echo "</div>";
        }
        echo "<br>";
    }

    echo "</div>";

    // Close the database connection
    mysqli_close($conn);
    ?>
        </div>

        <div class="screen" align="center"></div>
        <p class="text">
            You have selected <span id="count">0</span> seats for the total price of Rs. <span id="total">0</span>
        </p>

        <form action="cpayment.php" id="seats" method="POST">
            <input type="hidden" id="selectedSeats" name="selectedSeats" />
            <input type="submit" id="selectedSeats" value="Book Selected Seats"/>
        </form>
        <footer class="site-footer" align="center">
            <h3 style="background-color: white;" align="center">&copy;WATCH BETTER</h3>
        </footer>

        <script>
            const screenID = document.getElementById("scr").textContent;
            console.log(screenID);
            let selectedSeats = []; // Array to store selected seat IDs
            let count = 0;
            let total = 0;

            function toggleBox(box) {
                if (box.classList.contains('blocked')) {
                    // If the box is blocked (already selected), do nothing
                    return;
                }

                if (box.classList.contains('selected')) {
                    // If the box is already selected, deselect it
                    box.classList.remove('selected');
                    selectedSeats = selectedSeats.filter(seat => seat !== box.textContent);
                    count--;
                    total -= 150;
                } else if (selectedSeats.length < 10) {
                    // If less than 10 seats are selected, select it
                    box.classList.add('selected');
                    selectedSeats.push(box.textContent);
                    count++;
                    total += 150;
                }

                // Update the seat count and total price
                document.getElementById('count').textContent = count;
                document.getElementById('total').textContent = total;
            }

            const form = document.getElementById("seats");

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                let selectedSeatsJSON;

                if (selectedSeats.length === 0) {
                    e.preventDefault(); // Prevent form submission if no box is selected
                    alert("Please select at least one seat.");
                } else {
                    selectedSeatsJSON = JSON.stringify(selectedSeats);

                    // Create a hidden input field for the selected seats
                    var seatsInput = document.createElement("input");
                    seatsInput.setAttribute("type", "hidden");
                    seatsInput.setAttribute("name", "selectedSeats");
                    seatsInput.setAttribute("value", selectedSeatsJSON);

                    var screenId = document.createElement("input");
                    screenId.setAttribute("type", "hidden");
                    screenId.setAttribute("name", "scrID");
                    screenId.setAttribute("value", screenID);

                    var totalPrice = document.createElement("input");
                    totalPrice.setAttribute("type", "hidden");
                    totalPrice.setAttribute("name", "totalPrice");
                    totalPrice.setAttribute("value", total);

                    // Append the selected seats input field to the form
                    form.appendChild(seatsInput);
                    form.appendChild(screenId);
                    form.appendChild(totalPrice);


                    form.submit();
                }
            });
        </script>
    </body>
</html>
