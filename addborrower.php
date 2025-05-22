<?php
include 'DBConnector.php';

$name = $_GET['name'];
$contact_num = $_GET['contact_num'];
$email = $_GET['email'];
$address = $_GET['address'];
$type = $_GET['type'];
$amount = $_GET['amount'];
$reason = $_GET['reason'];

$stmt = $conn->prepare("INSERT INTO borrowers_info (name, address, email, contact_num) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $address, $email, $contact_num);

if ($stmt->execute()) {
    $borrower_id = $conn->insert_id;

    $stmt2 = $conn->prepare("INSERT INTO borrowers (borrower_id, type, amount, reason) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("isss", $borrower_id, $type, $amount, $reason);
    $stmt2->execute();

    header("Location: index.php");
    exit();

} else {
    echo "Error adding to borrowers_info: " . $stmt->error;
}

$conn->close();
?>


