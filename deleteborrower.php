<?php
include 'dbconnector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrower_id"])) {
    $idToDelete = intval($_POST["borrower_id"]);

    // Step 1: Delete from child table first
    $conn->query("DELETE FROM borrowers WHERE borrower_id = $idToDelete");

    // Step 2: Delete from parent table
    $conn->query("DELETE FROM borrowers_info WHERE borrower_id = $idToDelete");

    // Step 3: Reorder IDs
    $result = $conn->query("SELECT * FROM borrowers_info ORDER BY borrower_id ASC");

    if ($result->num_rows > 0) {
        $new_id = 1;

        // Temporarily disable foreign key checks
        $conn->query("SET FOREIGN_KEY_CHECKS=0");

        while ($row = $result->fetch_assoc()) {
            $current_id = $row['borrower_id'];

            if ($current_id != $new_id) {
                // Update child table first
                $conn->query("UPDATE borrowers SET borrower_id = $new_id WHERE borrower_id = $current_id");

                // Then update parent table
                $conn->query("UPDATE borrowers_info SET borrower_id = $new_id WHERE borrower_id = $current_id");
            }

            $new_id++;
        }

        // Re-enable foreign key checks
        $conn->query("SET FOREIGN_KEY_CHECKS=1");

        // Reset AUTO_INCREMENT
        $conn->query("ALTER TABLE borrowers_info AUTO_INCREMENT = $new_id");
    }

    header("Location: borrower.php");
    exit();
} else {
    echo "Invalid request.";
}

$conn->close();