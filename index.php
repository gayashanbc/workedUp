<?php
session_start();
//include a db.php file to connect to database
include("db.php");
//create a variable called $pagename which contains the actual name of the page
$pagename = "Index";
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
//display name of the page and some text
echo "<h2>" . $pagename . "</h2>";
echo "<p> Amazing products for your home, for your work, for you!</p> <br><br><hr>";
//create a new variable containing a SQL statement retrieving names of products from the product table
$SQL = "select prodId, prodName, prodPicName from product";
//Create a new variable containing the execution of the SQL query i.e. select the records or get out
$exeSQL = mysql_query($SQL) or die (mysql_error());
//create an array of records (2 dimensional variable) called $prodArray.
//populate it with the records retrieved by the SQL query previously executed.
//loop through the array i.e while the end of the array has not been reached go through it
while ($arrayprod = mysql_fetch_array($exeSQL)) {
    echo "<br>";
//make each product a link to the next page and pass the product id to the next page by URL //concatenate a string of characters u_prodid which carries the value of the actual id
    echo "<p><a href=prodinfo.php?u_prodid=" . $arrayprod['prodId'] . ">";
    echo $arrayprod['prodName'];
    echo "<br>";
    echo "</a></p>";
    echo "<br><br>";
    echo "<img src=Images/" . $arrayprod['prodPicName'] . ">";
    echo "<hr>";
}
//include head layout
include("footfile.html");
?>
