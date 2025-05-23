<?php
include 'dbconnector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrower_id"])) {
    $borrower_id = intval($_POST["borrower_id"]);
    $name = trim($_POST["name"]);
    $address = trim($_POST["address"]);
    $email = trim($_POST["email"]);
    $contact_num = trim($_POST["contact_num"]);

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE borrowers_info SET name = ?, address = ?, email = ?, contact_num = ? WHERE borrower_id = ?");
    $stmt->bind_param("ssssi", $name, $address, $email, $contact_num, $borrower_id);

    if ($stmt->execute()) {
        header("Location: borrower.php");
        exit();
    } else {
        echo "Error updating borrower: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
