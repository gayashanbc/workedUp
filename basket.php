<?php
session_start();
include('db.php');

$total = 0;

//create a variable called $pagename which contains the actual name of the page
$pagename = "Ordering Basket";


//Google Web Fonts
echo "<link href='//fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>";
echo "<link href='//fonts.googleapis.com/css?family=Exo 2' rel='stylesheet'>";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>" . $pagename . "</title>";

//include head layout
include("headfile.html");
require_once('detectlogin.php');

if (isset($_POST['h_prodid']) && isset($_POST['p_quantity'])) {

    $newprodid = $_POST['h_prodid'];
    $reququantity = $_POST['p_quantity'];


    if (isset($_SESSION['basket'])) {
        if (isset($_SESSION['basket'][$newprodid])) {
            $_SESSION['basket'][$newprodid] += $reququantity;
        } else {
            $_SESSION['basket'][$newprodid] = $reququantity;
        }

    } else {
        $_SESSION['basket'] = [];
        $_SESSION['basket'][$newprodid] = $reququantity;
    }

    $message = 'Your basket has been updated.';

} else {
    if (empty($_SESSION['basket'])) {
        $message = 'Empty basket.';
    } else {
        $message = 'Existing basket.';
    }
}

echo "<p></p>";
//display name of the page and some random text
echo "<h2>" . $pagename . "</h2>";
echo "<p>" . $message . "</p>";

if (!empty($_SESSION['basket'])) {
    ?>

    <table border=2>
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>

        <tbody>

        <?php
        foreach ($_SESSION['basket'] as $key => $value) {
            $query = "SELECT * FROM product WHERE prodId = '{$key}'";
            $result = mysql_query($query) or die('error'.mysql_error());
            $row = mysql_fetch_array($result);
            $total += ($row[4] * $value);
            ?>
            <tr>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $value; ?></td>
                <td><?php echo($row[4] * $value); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th colspan=3>Total</th>
            <th>GBP <?php echo $total; ?></th>
        </tr>
        </tbody>
    </table>
    <br/>
    <a href='clearbasket.php'>Clear basket</a>
    <p>New workedUp Customers <a href="register.php">Register</a></p>
    <p>Registered workedUp Members <a href="login.php">Login</a></p>
    <?php
}
//include head layout
include("footfile.html");
mysql_close($connection);
?>
