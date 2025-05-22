<?php
include 'dbconnector.php';

echo "<table style='width:50%; margin-bottom: 20px;'>";
echo "<tr>";
echo "<th>Borrower ID</th>";
echo "<th>Name</th>";
echo "<th>Address</th>";
echo "<th>Email</th>";
echo "<th>Contact Number</th>";
echo "</tr>";

$sql_borrowers = "SELECT * FROM borrowers_info";
$results_borrowers = $conn->query($sql_borrowers);

if ($results_borrowers->num_rows > 0) {

    while($row = $results_borrowers->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row["borrower_id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["contact_num"] . "</td>";
        echo "</tr>";
    }
} else {    
    echo "<tr>";
        echo "<td colspan='5'><br>wala may utang sau</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Borrower Information</title>
    </head>
    <body> 
        <button class="borrower_info">
            <a href="index.php">Go back</a>
        </button>
    </body>
</html>





