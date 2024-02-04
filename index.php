<?php
session_start();
// Initialize session variables
$_SESSION['totalPrice']; // Set your desired total price
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Page</title>
        <!-- Include jQuery and Razorpay checkout.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                background-color: #f4f4f4;
            }

            h1 {
                color: #333;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            input[type="text"] {
                width: 90%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            input[type="button"] {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            input[type="button"]:hover {
                background-color: #0056b3;
            }
        </style>
</head>
<body>
    <h1>Payment Page</h1>
    <form>
        <input type="text" name="name" id="name" placeholder="Enter your name" /><br /><br />
        <input type="text" name="amt" id="amt" placeholder="Enter amount" value="<?php echo $_SESSION['totalPrice']; ?>" readonly/><br /><br />
        <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()" /><br/><br/>
    </form>
    
    <script>
        function pay_now() {
            var name = $('#name').val();
            var amt = $('#amt').val();
    
            var options = {
                "key": "rzp_test_XphGGgLdVgy7Uo", // Replace with your actual Razorpay key
                "amount": amt * 100,
                "currency": "INR",
                "name": "Watch Better",
                "description": "Test Transaction",
                "image": "file:///Users/swayampatel/Desktop/watch%20better.png",
                "handler": function (response) {
                    $.ajax({
                        type: 'post',
                        url: 'payment_process.php',
                        data: {
                            payment_id: response.razorpay_payment_id,
                            amt: amt,
                            name: name
                        },
                        success: function (result) {
                            window.location.href = "thank_you.php";
                        }
                    });
                }
            };
    
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>
</body>
</html>
