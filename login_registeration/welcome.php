<?php
// Initialize session
session_start();

// Include PHPMailer autoload file
require 'C:\xampp\htdocs\furherd\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\furherd\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\furherd\PHPMailer\src\Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $pet_name = $_POST['pet_name'];
    $pickup_location = $_POST['pickup_location'];

    try {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true); // Passing true enables exceptions

        // SMTP configuration for Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mdumalefane@gmail.com'; // Your Gmail email address
        $mail->Password = 'xwzv ljfe rnfq naja'; // Your Gmail application-specific password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Sender and recipient
        $mail->setFrom('mdumalefane@gmail.com', 'mduduzi'); // Replace with your email and name
        $mail->addAddress($client_email, $client_name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Pet Pickup Information';
        $mail->Body = "Dear $client_name,<br><br>";
        $mail->Body .= "We will be collecting your pet, $pet_name, at $pickup_location.<br>";
        $mail->Body .= "Thank you for choosing FurHerd Pet Sitting!<br><br>";
        $mail->Body .= "Best regards,<br>FurHerd Pet Sitting";

        // Enable verbose debug output
        // $mail->SMTPDebug = 2;

        // Send email
        if ($mail->send()) {
            echo '<div class="alert alert-success" role="alert">Email sent successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to send email. Please try again later.</div>';
            echo '<pre>SMTP Error: ' . $mail->ErrorInfo . '</pre>'; // Display SMTP error message for debugging
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <style>
        .wrapper {
            width: 500px;
            padding: 20px;
        }

        .wrapper h2 {
            text-align: center;
        }

        .wrapper form .form-group span {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <section class="container wrapper">
            <div class="page-header">
                <h2 class="display-5">Welcome to FURHERD PET SITTING <?php echo $_SESSION['username']; ?></h2>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group">
                    <label for="client_name">Client Name:</label>
                    <input type="text" id="client_name" name="client_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="client_email">Client Email:</label>
                    <input type="email" id="client_email" name="client_email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="pet_name">Pet Name:</label>
                    <input type="text" id="pet_name" name="pet_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="pickup_location">Pickup Location:</label>
                    <input type="text" id="pickup_location" name="pickup_location" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Send Pickup Information</button>
            </form>

            <a href="password_reset.php" class="btn btn-blo
