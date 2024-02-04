<?php
use mail\PHPMailer\PHPMailer;
use mail\PHPMailer\SMTP;
use mail\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

session_start();
error_reporting(0);
define('TITLE', 'Submit Request');
define('PAGE', 'SubmitRequest');
include('includes/header.php');
include('../db.php');
if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
    $p = $_SESSION['sesLogin']['U_name'];
    $add = $_SESSION['sesLogin']['U_address'];
    $mob = $_SESSION['sesLogin']['U_contact'];
} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}
if (isset($_POST['submitrequest'])) { // Change 'submitrequest' to match the name attribute of your submit button
    // Checking for Empty Fields
    if (empty($_POST['requestername']) || empty($_POST['requesteradd1']) || empty($_POST['requestermobile']) || empty($_POST['requestdate']) || empty($_POST['requesttime'])) {
        // msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        // Assigning User Values to Variables
        $rname = $_POST['requestername'];
        $radd1 = $_POST['requesteradd1'];
        $selectedService = $_POST['selectedService'];
        $assigntech = $_POST['assigntech'];
        $remail = $rEmail; // Use the session value for email
        $rmobile = $_POST['requestermobile'];
        $rdate = $_POST['requestdate'];
        $rtime = $_POST['requesttime'];

        $sql = "INSERT INTO booking_tb(C_id, S_id, P_id, s_time, S_date, C_name, C_contact, C_address)
        VALUES (
            (SELECT User_id FROM user_tb WHERE U_email = '$remail'), -- Correctly retrieve C_id based on user's email
            (SELECT s_id FROM service_tb WHERE S_name='$selectedService'),
            (SELECT p_id FROM professional_tb WHERE P_name = '$assigntech'),
            '$rtime',
            '$rdate',
            '$rname',
            '$rmobile',
            '$radd1'
        )";

        if ($conn->query($sql) === TRUE) {
            $genid = mysqli_insert_id($conn);
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Request Submitted Successfully Your ' . $genid . ' </div>';

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF; // You can change this to DEBUG_SERVER or DEBUG_CLIENT to see debug information
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Your SMTP server hostname
                $mail->SMTPAuth = true;
                $mail->Username = 'patelswayam688@gmail.com'; // Your email address
                $mail->Password = ''; // Your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use SSL or TLS, or set to false for no encryption
                $mail->Port = 587; // Port for SSL/TLS: 465; Port for SMTP without encryption: 587

                $mail->setFrom('patelswayam688@gmail.com', 'Watch Better');
                $mail->addAddress($remail); // Recipient's email address
                $mail->isHTML(true);

                // Email subject
                $mail->Subject = 'Request Confirmation';

                // Email body
                $mail->Body = "Dear $rname,<br><br>Your request has been submitted successfully.<br>Service: $selectedService<br>Date: $rdate<br>Time: $rtime<br>Professional: $assigntech<br><br>Thank you for choosing our services.";

                if (!$mail->send()) {
                    $msg .= '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Email could not be sent.</div>';
                } else {
                    $msg .= '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Email has been sent successfully.</div>';
                }

                echo "<script> location.href='Bill.php'; </script>";
            } catch (Exception $e) {
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Email error: ' . $mail->ErrorInfo . '</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit Your Request </div>';
        }
    }
}
?>

<div class="col-sm-9 col-md-10 mt-5">
    <form class="mx-5" id="bookingForm" method="post" action="">
        <div class="form-group" id="myform">
            <div class="form-group">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book"])) {
                    // Check if any services were selected
                    if (isset($_POST["services"]) && is_array($_POST["services"]) && count($_POST["services"]) > 0) {
                        echo "Selected Services:";
                        foreach ($_POST["services"] as $selectedService) {
                            echo "<input type='text' class='form-control' name='selectedService' value='$selectedService' readonly>";
                        }
                    } else {
                        echo "<p>No services were selected.</p>";
                    }
                }
                ?>
            </div>
             <label for="self">Self:</label>
    <input type="radio" name="requestType" id="self" value="self" checked>

    <label for="other">Other:</label>
    <input type="radio" name="requestType" id="other" value="other">
            <div id="selfForm">
                <label  for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" name="requestername" value="<?php echo $p ?>"  required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" value="<?php echo $add ?>" name="requesteradd1">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputMobile">Mobile</label>
                        <input type="text" class="form-control" id="inputMobile" name="requestermobile" value="<?php echo $mob ?>"   maxlength="10" >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDate">Date</label>
                        <input type="date" class="form-control" id="todayDate" name="requestdate" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputDate">Time</label>
                        <input type="time" class="form-control" id="inputtime" name="requesttime" min="09:00" max="19:00" >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="selectprofessional">Select Professional:</label>
                        <select class="form-control" id="assigntech" name="assigntech">
                            <?php
                            $sql = "SELECT P_name FROM professional_tb WHERE P_id NOT IN (
                            SELECT P_id FROM booking_tb WHERE S_date = '$rdate' AND s_time = '$rtime'
                            )";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                print_r($row);
                                $pName = $row['P_name'];
                                echo "<option value='$pName'>$pName</option>";
                            }
                            ?> 
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold" name="submitrequest">Book Service</button>
        </div>
    </form>

    <!-- below msg display if required fill missing or form submitted success or failed -->
    <?php
    if (isset($msg)) {
        echo $msg;
    }
    ?>
</div>
</div>

<script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById("todayDate").valueAsDate = new Date();
</script>
<script>
    // Function to clear form values
    function clearFormValues() {
        document.getElementById("inputName").value = "";
        document.getElementById("inputAddress").value = "";
        document.getElementById("inputMobile").value = "";
        document.getElementById("todayDate").value = "";
        document.getElementById("inputtime").value = "";
        document.getElementById("assigntech").selectedIndex = 0; // Reset the select dropdown
    }

    // Function to restore form values from session data
    function restoreFormValues() {
        document.getElementById("inputName").value = "<?php echo $p; ?>";
        document.getElementById("inputAddress").value = "<?php echo $add; ?>";
        document.getElementById("inputMobile").value = "<?php echo $mob; ?>";
        document.getElementById("todayDate").valueAsDate = new Date();
    }

    // Event listener for radio buttons
    document.getElementById("self").addEventListener("change", function () {
        if (this.checked) {
            restoreFormValues();
        }
    });

    document.getElementById("other").addEventListener("change", function () {
        if (this.checked) {
            clearFormValues();
        }
    });

    // Initialize form state based on the selected radio button
    if (document.getElementById("other").checked) {
        clearFormValues();
    } else {
        restoreFormValues();
    }
</script>

<?php
include('includes/footer.php');
$conn->close();
?>
