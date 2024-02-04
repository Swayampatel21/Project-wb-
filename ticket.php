<!DOCTYPE html>
<html>
<head>
    <title>Movie Booking Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        h1 {
            margin: 0;
        }

        container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .result {
            margin-top: 20px;
        }

        .movie-name {
            font-weight: bold;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Movie Booking System</h1>
    </header>

    <container>
        <h2>Movie Information</h2>

        <?php
    $conn = mysqli_connect("localhost", "root", "", "in_movie");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Success";

    if (isset($_GET['mname'])) {
        $name = mysqli_real_escape_string($conn, $_GET['mname']);
        $sql = "SELECT * FROM booking WHERE mname = '$name'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Data fetched";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['mname'];
                    // You can decorate the data here
                }
            } else {
                echo "No results found.";
            }
        } else {
            echo "Data not fetched: " . mysqli_error($conn);
        }
    } else {
        echo "No movie name provided.";
    }

    mysqli_close($conn);
?>


        <div class="result">
            <p class="movie-name">Movie Name: <?php $row['mname']; ?></p>
            <!-- Add more details here -->
        </div>
    </container>

    <footer>
        &copy; 2023 Your Company Name
    </footer>
</body>
</html>
