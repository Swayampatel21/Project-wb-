
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketId = $_POST['ticket_id'];

    include('movie_cancel.php'); 

    // Check if the ticket exists in the database
    $checkQuery = "SELECT movie_date, movie_time, status FROM movie_tickets WHERE id = ?";
    $checkStmt = $connection->prepare($checkQuery);
    $checkStmt->bind_param('i', $ticketId);

    if ($checkStmt->execute()) {
        $checkStmt->bind_result($movieDate, $movieTime, $status);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($status === 'booked') {
            $movieDatetime = $movieDate . ' ' . $movieTime;
            $movieDatetimeObj = DateTime::createFromFormat('Y-m-d H:i:s', $movieDatetime);

            if ($movieDatetimeObj === false) {
                echo "Invalid movie date and time format.";
            } else {
                $cancellationTime = clone $movieDatetimeObj;
                $cancellationTime->modify('3 hours');
                $currentTime = new DateTime('now', new DateTimeZone('UTC'));
                if ($currentTime < $cancellationTime) {
                      $refundAmount = 125;
                    $updateQuery = "UPDATE movie_tickets SET status = 'cancelled', cancellation_time = ?, refund_amount = ? WHERE id = ?";
                    $updateStmt = $connection->prepare($updateQuery);

                    if ($updateStmt) {
                        $cancellationTimeStr = $cancellationTime->format('Y-m-d H:i:s');
                        $updateStmt->bind_param('sdi', $cancellationTimeStr, $refundAmount, $ticketId);

                        if ($updateStmt->execute()) {
                            echo "Ticket canceled successfully! You will receive a refund of $refundAmount.";
                        } else {
                            echo "Error canceling ticket.";
                        }
                    } else {
                        echo "Error preparing the update statement.";
                    }
                } else {
                    echo "Ticket cannot be canceled within 3 hours of the movie time.";
                }
            }
        } else {
            echo "Ticket is not booked or has already been canceled.";
        }
    } else {
        echo "Error checking ticket status.";
    }

    if (isset($updateStmt)) {
        $updateStmt->close();
    }
    $connection->close();
}
?>