<?php
include 'DBConnector.php';

// Check for required fields
if (
    isset($_GET['name'], $_GET['contact_num'], $_GET['email'], $_GET['address'], $_GET['type'], $_GET['amount'], $_GET['reason'])
) {
    $name = $_GET['name'];
    $contact_num = $_GET['contact_num'];
    $email = $_GET['email'];
    $address = $_GET['address'];
    $type = $_GET['type'];
    $amount = $_GET['amount'];
    $reason = $_GET['reason'];

    // Optional: Reset AUTO_INCREMENT if table is empty
    $check = $conn->query("SELECT COUNT(*) AS total FROM borrowers_info");
    $row = $check->fetch_assoc();
    if ($row['total'] == 0) {
        $conn->query("ALTER TABLE borrowers_info AUTO_INCREMENT = 1");
    }

    // Insert into borrowers_info
    $stmt = $conn->prepare("INSERT INTO borrowers_info (name, address, email, contact_num) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $address, $email, $contact_num);

    if ($stmt->execute()) {
        $borrower_id = $conn->insert_id;

        // Insert into borrowers table
        $stmt2 = $conn->prepare("INSERT INTO borrowers (borrower_id, type, amount, reason) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isss", $borrower_id, $type, $amount, $reason);
        $stmt2->execute();

        // Redirect on success
        header("Location: index.php");
        exit();
    } else {
        echo "Error adding to borrowers_info: " . $stmt->error;
    }

    $stmt->close();
    $stmt2->close();
} else {
    echo "Missing required fields.";
}

$conn->close();
?>