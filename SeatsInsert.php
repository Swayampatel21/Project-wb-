<?php

if (isset($_POST['selectedSeats']))
    $selectedSeatsJSON = $_POST['selectedSeats'];
$selectedSeats = json_decode($selectedSeatsJSON, true);

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "in_movie");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//var_dump($selectedSeats);
////           echo "Received selected seats: " .
//echo var_dump($seat);
foreach ($selectedSeats as $seats) {
    
    echo var_dump($seats);
    
    $seat = explode(',', $seats);

    $st_row = $seat[0];
    $st_col = $seat[1];
    $insertQuery = "INSERT INTO `seats` (st_row, st_col, st_status, st_scr_id ) VALUES ('$st_row', '$st_col', 1, '1')";
    $insertResult = mysqli_query($conn, $insertQuery);
}
if ($insertResult) {
    echo "Successfully inserted Seats<br>";
}

// Close the database connection
mysqli_close($conn);
?>