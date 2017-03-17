<?php
session_start();
//create a variable called $pagename which contains the actual name of the page
$pagename = "Register";

//Google Web Fonts
echo "<link href='//fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>";
echo "<link href='//fonts.googleapis.com/css?family=Exo 2' rel='stylesheet'>";

//call in the style sheet called ystylesheet.css to format the page as defined in the style sheet
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

//display window title
echo "<title>" . $pagename . "</title>";

//include head layout
include("headfile.html");

echo "<p></p>";
//display name of the page and some random text
echo "<h2>" . $pagename . "</h2>";
?>

<form action="getregister.php" method="post">
    <table>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="userFName"/></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="userSName"/></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type="text" name="userAddress"/></td>
        </tr>
        <tr>
            <td>Postcode</td>
            <td><input type="text" name="userPostcode"/></td>
        </tr>
        <tr>
            <td>Tel No</td>
            <td><input type="number" name="userTelNo"/></td>
        </tr>
        <tr>
            <td>Email Address</td>
            <td><input type="text" name="userEmail"/></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="userPassword"/></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="userRePassword"/></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Register"/></td>
            <td><input type="reset" value="Clear Form"/></td>
        </tr>
    </table>
</form>

<?php
//include head layout
include("footfile.html");
?>
