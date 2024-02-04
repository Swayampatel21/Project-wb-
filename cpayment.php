<?php
session_start();

if (isset($_POST['totalPrice'])) {
    $totalPrice = $_POST['totalPrice'];

    // Set the total price in a session variable
    $_SESSION['totalPrice'] = $totalPrice;
}

if (isset($_POST['selectedSeats'])) {
    $selectedSeatsJSON = $_POST['selectedSeats'];
    $selectedSeats = json_decode($selectedSeatsJSON, true);
    $_SESSION['selectedSeats'] = $selectedSeats;
}

if (isset($_POST['scrID'])) {
    $_SESSION['scrID'] = $_POST['scrID'];
}

// Check if the session variables are set and initialize them if necessary
if (!isset($_SESSION['sesName'])) {
    $_SESSION['sesName'] = '';
}

if (!isset($_SESSION['mDate'])) {
    $_SESSION['mDate'] = '';
}

if (!isset($_SESSION['mTime'])) {
    $_SESSION['mTime'] = '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Page</title>
    <style>
        body {
            background-color: white;
        }

        .header {
            background-color: black;
            color:white;
        }

        /* Your CSS styles here */
        .payment-form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #3e8e41;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        #add-food {
            display: none;
        }

        .show-food {
            display: block;
        }
    </style>
</head>
<body>
<div class="header" align="center"><h1>WATCH BETTER</h1></div>
<div class="payment-form">
    <h2>Checkout Form</h2>
    <form method="post" action="">
        <label for="cvv">Movie Name:</label>
        <input type="text" id="cvv" name="mname" placeholder="Movie Name" value="<?php echo $_SESSION['sesName']; ?>" >

        <label for="expiry">Email:</label>
        <input type="text" id="expiry" name="email" placeholder="Enter your email" value="">

        <label for="expiry">Date:</label>
        <input type="text" id="expiry" name="date" value="<?php echo $_SESSION['mDate']; ?>">

        <label for="expiry">Time:</label>
        <input type="text" id="expiry" name="time" value="<?php echo $_SESSION['mTime']; ?>">

        <label for="cvv">Seat selected:</label>
        <input type="text" id="cvv" name="ss" placeholder="No. of seats" value="<?php echo count($_SESSION['selectedSeats']); ?>">
        <span id="cvv-error"></span>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?php echo isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : ''; ?>" class="" placeholder="enter price" />

        <input type="submit" value="Submit">
    </form>
</div>


</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "in_movie");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$mname = $_POST['mname'];
$email = $_POST['email'];
$date = $_POST['date'];
$time = $_POST['time'];
$ss = $_POST['ss'];
$price = $_POST['price'];

$sql = "INSERT INTO `booking` (`mname`, `email`, `date`, `time`, `ss`, `price`) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssis", $mname, $email, $date, $time, $ss, $price);

if (mysqli_stmt_execute($stmt)) {
//    echo "Data entered";
    echo "<center><a href='index.php'><input type='submit' value='Checkout'></a></center>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>


<footer class="site-footer" align="center">
    <h3 style="background-color: white;" align="center">&copy;WATCH BETTER</h3>
</footer>