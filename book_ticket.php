<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['customer_name'];
    $movieName = $_POST['movie_name'];
    $movieDate = $_POST['movie_date'];
    $movieTime = $_POST['movie_time'];

    // Combine the movie_date and movie_time to create a movie_datetime string
    $movieDatetime = $movieDate . ' ' . $movieTime;

    // Parse the combined movie_datetime string to a DateTime object
        // Combine the date and time in the correct format
        $movieDatetime = $movieDate . ' ' . $movieTime;

        // Parse the combined movie_datetime string to a DateTime object
        $movieDatetimeObj = DateTime::createFromFormat('Y-m-d H:i', $movieDatetime);

    if ($movieDatetimeObj === false) {
        echo "Invalid date and time format. Use YYYY-MM-DD and HH:MM.";
    } else {
        $currentDate = new DateTime('now', new DateTimeZone('UTC'));

        // Check if the movie date and time are in the future
        if ($movieDatetimeObj < $currentDate) {
            echo "Movie cannot be booked for past times.";
        } else {
            // Insert the booking into the database and get the auto-generated ID
            include('movie_cancel.php');

            $query = "INSERT INTO movie_tickets (customer_name, movie_name, movie_date, movie_time, status) VALUES (?, ?, ?, ?, 'booked')";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('ssss', $customerName, $movieName, $movieDate, $movieTime);

            if ($stmt->execute()) {
                $ticketId = $stmt->insert_id; // Get the auto-generated ID
                echo "Ticket booked successfully! Your Ticket ID is: " . $ticketId;
            } else {
                echo "Error booking ticket.";
            }

            $stmt->close();
            $connection->close();
        }
    }
}
