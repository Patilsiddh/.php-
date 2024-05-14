<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "payments"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$cardNumber = $_POST['card-number'];
$expiryDate = $_POST['expiry-date'];
$cvv = $_POST['cvv'];
$amount = $_POST['amount'];

// SQL query to insert payment details into database
$sql = "INSERT INTO payments (card_number, expiry_date, cvv, amount)
        VALUES ('$cardNumber', '$expiryDate', '$cvv', '$amount')";

if ($conn->query($sql) === TRUE) {
    echo "Payment successfully processed.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>
<body>
    <h1>Payment Form</h1>
    <form id="payment-form" action="process_payment.php" method="POST">
        <label for="card-number">Card Number:</label>
        <input type="text" id="card-number" name="card_number" required><br><br>
        
        <label for="expiry-date">Expiry Date:</label>
        <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/YY" required><br><br>
        
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required><br><br>
        
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required><br><br>
        
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
