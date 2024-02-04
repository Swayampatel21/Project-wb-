<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the payment and update any relevant session variables.
    $payment_id = $_POST['payment_id'];
    $amt = $_POST['amt'];
    $name = $_POST['name'];

    // Here, you can store payment details or perform any other necessary actions.

    // Redirect to the thank you page after processing the payment.
    header("Location: thank_you.php");
    exit;
}
?>
