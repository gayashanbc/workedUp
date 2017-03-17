<?php
session_start();
unset($_SESSION['basket']);
//create a variable called $pagename which contains the actual name of the page
$pagename = "Clear Basket";

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
//display name of the page and some random text
echo "<h2>" . $pagename . "</h2>";
echo "<p> Ordering basket now clear</p>";

//include head layout
include("footfile.html");
?>
