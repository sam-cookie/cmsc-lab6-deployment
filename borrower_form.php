<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body> 
        <button class="borrower_info">
            <a href="borrower.php">Borrower Information</a>
        </button>
        <h1>SINO MAY UTANG SAYO</h1>
            <form action="addborrower.php" method="get">
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Amount:</td>
                        <td><input type="text" name="amount"></td>
                    </tr>
                    <tr>
                        <td>Type:</td>
                        <td><input type="text" name="type"></td>
                    </tr>
                    <tr>
                        <td>Contact Num:</td>
                        <td><input type="text" name="contact_num"></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input type="text" name="address"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>Reason:</td>
                        <td><input type="text" name="reason"></td>
                    <tr>
                        <td class="tlabel"></td>
                        <td><input type="submit" value="Add Borrower"></td>
                    </tr>
                </table>
            </form>
    </body>
</html>