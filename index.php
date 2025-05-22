
<?php 
include 'dbconnector.php';

echo "<table style='width:50%; margin-bottom: 20px;'>";
echo "<tr>";
echo "<th>Borrower ID</th>";
echo "<th>Name</th>";
echo "<th>Amount</th>";
echo "<th>Type</th>";
echo "<th>Reason</th>";
echo "</tr>";

$sql = "SELECT borrowers.borrower_id, borrowers_info.name, borrowers.amount, borrowers.type, borrowers.reason
        FROM borrowers
        JOIN borrowers_info ON borrowers.borrower_id = borrowers_info.borrower_id";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row["borrower_id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["amount"] . "</td>";
            echo "<td>" . $row["type"] . "</td>";
            echo "<td>" . $row["reason"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'><br>walang may utang sau</td></tr>";
}

echo "</table>";

echo 
include 'borrower_form.php';

$conn->close();
?>
