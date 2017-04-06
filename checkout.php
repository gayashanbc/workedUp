<?php
session_start();
include('db.php');
//create a variable called $pagename which contains the actual name of the page
$pagename = "Checkout";

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

echo "<p></p>";
//display name of the page and some random text
echo "<h2>" . $pagename . "</h2>";
$total = 0;
$subTotal = 0;
$orderDateTime = date('Y-m-d H:i:s', time());

$query = "INSERT INTO orders(userId,orderDateTime) VALUES('{$_SESSION["c_userId"]}','{$orderDateTime}')";

$result = mysql_query($query) or die(mysql_error());

if ($result) {
    $query = "SELECT MAX(orderNo) FROM orders WHERE userId = '{$_SESSION["c_userId"]}'";
    $result = mysql_query($query) or die(mysql_error());
    $orderId = mysql_fetch_array($result, MYSQL_NUM)[0];
    echo '<p>Order has been placed successfully.<br>Order Id: ' . $orderId . '</p>';
}
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
        $result = mysql_query($query) or die('error: ' . mysql_error());
        $row = mysql_fetch_array($result);
        $total += ($row[4] * $value);
        $subTotal = ($row[4] * $value);
        $sql = "INSERT INTO order_line(orderNo,prodId,quantityOrdered,subTotal) VALUES ($orderId,$key,$value,$subTotal)";
        mysql_query($sql) or die('error: ' . mysql_error());
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
<?php
$query = "UPDATE orders SET orderTotal = {$total} WHERE orderNo = '{$orderId}'";
$result = mysql_query($query) or die('error: ' . mysql_error());

if ($result) {
    ?>
    <a href='logout.php'>Logout</a>
    <?php
    unset($_SESSION['basket']);
}
//include head layout
include("footfile.html");
?>
