<!DOCTYPE html>
<html>
<head>
    <title>Book Movie Ticket</title>
</head>
<body>
    <h2>Book a Ticket</h2>
    <form action="book_ticket.php" method="post"> 
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" required><br><br>

        <label for="movie_name">Movie Name:</label>
        <input type="text" name="movie_name" required><br><br>

        <label for="movie_date">Select Date (YYYY-MM-DD):</label>
        <input type="text" name="movie_date" required><br><br>

        <label for="movie_time">Select Time:</label>
        <input type="time" name="movie_time" required><br><br>

        <input type="submit" value="Book Ticket">
    </form>
    <h2>Cancel a Ticket</h2>
    <form action="cancel_ticket.php" method="post">
        <label for="ticket_id">Ticket ID:</label>
        <input type="text" id="ticket_id" name="ticket_id" required><br>
        <input type="submit" value="Cancel Ticket">
    </form>

</body>
</html>
