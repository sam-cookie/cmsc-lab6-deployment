<?php
include 'dbconnector.php';

if (!isset($_GET['borrower_id'])) {
    echo "No borrower selected.";
    exit();
}

$borrower_id = intval($_GET['borrower_id']);
$query = "SELECT * FROM borrowers_info WHERE borrower_id = $borrower_id";
$result = $conn->query($query);

if ($result->num_rows !== 1) {
    echo "Borrower not found.";
    exit();
}

$borrower = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Borrower</title>
    <style>
        form {
            width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 2px;
            box-sizing: border-box;
        }

        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        button, a.button {
            background-color: #000;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover, a.button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<form action="updateborrower.php" method="POST">
    <input type="hidden" name="borrower_id" value="<?php echo $borrower['borrower_id']; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($borrower['name']); ?>">

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required value="<?php echo htmlspecialchars($borrower['address']); ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($borrower['email']); ?>">

    <label for="contact_num">Contact Number:</label>
    <input type="text" id="contact_num" name="contact_num" required value="<?php echo htmlspecialchars($borrower['contact_num']); ?>">

    <div class="btn-group">
        <button type="submit">Update Borrower</button>
        <a class="button" href="borrower.php">Go Back</a>
    </div>
</form>

</body>
</html>