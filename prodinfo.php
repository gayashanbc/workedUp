<?php
session_start();
//include a db.php file to connect to database
include("db.php");

//create a variable called $pagename which contains the actual name of the page
$pagename = "Product Information";

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

//retrieve the product id passed from the previous page using the $_GET superglobal variable 
//store the value in a variable called $prodid 
$prodid = $_GET['u_prodid'];
//echo "<p>Selected product Id: ".$prodid;
//query the product table to retrieve the record for which the value of the product id  
//matches the product id of the product that was selected by the user 
$prodSQL = "select prodId, prodName, prodPicName,  prodDescrip , prodPrice, prodQuantity from product where prodId=" . $prodid;
//execute SQL query 
$exeprodSQL = mysql_query($prodSQL) or die(mysql_error());
//create array of records & populate it with result of the execution of the SQL query 
$thearrayprod = mysql_fetch_array($exeprodSQL);
//display product name in capital letters 
echo "<h3 style='text-align:center;font-size:1.8em;'>" . strtoupper($thearrayprod['prodName']);
echo "<br>";
echo "</h3>";
echo "<br><br>";
echo "<img src=Images/" . $thearrayprod['prodPicName'] . "><br><p>";
echo $thearrayprod['prodDescrip'] . "<br><br>";
echo $thearrayprod['prodPrice'] . " Euros<br><br>";
echo $thearrayprod['prodQuantity'] . "</center></p>";

//display form made of one text box and one button for user to enter quantity 
//pass the product id to the next page basket.php as a hidden value 
echo "<form action=basket.php method=post>";
echo "<p><center>Quantity: ";
echo "<select name=p_quantity> ";
for ($i = 1; $i <= $thearrayprod['prodQuantity']; $i++) {
    echo "<option value=" . $i . ">" . $i . "</option>  ";
}
echo "</select> ";
echo "<input type=submit value='Add to Basket'>";
echo "<input type=hidden name=h_prodid value=" . $prodid . ">";
echo "</center>";
echo "</form>";

//include head layout
include("footfile.html");
?>
