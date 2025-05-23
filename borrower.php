<?php
include 'dbconnector.php';

function fetchBorrowers($conn) {
    $sql_borrowers = "SELECT * FROM borrowers_info";
    $results_borrowers = $conn->query($sql_borrowers);

    if ($results_borrowers->num_rows > 0) {
        while ($row = $results_borrowers->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["borrower_id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["contact_num"] . "</td>";
            echo "<td style='display: flex; gap: 5px;'>
                    <form action='deleteborrower.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this borrower?\");' style='margin:0;'>
                        <input type='hidden' name='borrower_id' value='" . $row["borrower_id"] . "'>
                        <button type='submit' class='delete-btn'>Delete</button>
                    </form>
                    <form action='editborrower.php' method='GET' style='margin:0;'>
                        <input type='hidden' name='borrower_id' value='" . $row["borrower_id"] . "'>
                        <button type='submit' name='edit'>Edit</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data available</td></tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Borrower Information</title>
    <style>
        td button {
            padding: 4px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        button[name="edit"] {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <table style="width:50%; margin-bottom: 20px;">
        <thead>
            <tr>
                <th>Borrower ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="borrower-table-body">
            <?php fetchBorrowers($conn); ?>
        </tbody>
    </table>

    <button class="borrower_info">
        <a href="index.php">Go back</a>
    </button>
</body>
</html>
<?php $conn->close(); ?>