<?php
session_start();

require_once('db.php');
//create a variable called $pagename which contains the actual name of the page
$pagename = "Register Confirmation";

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

$color = "red";

if (isset($_POST['submit'])) {
    $userFName = $_POST['userFName'];
    $userSName = $_POST['userSName'];
    $userAddress = $_POST['userAddress'];
    $userPostcode = $_POST['userPostcode'];
    $userTelNo = $_POST['userTelNo'];
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $userRePassword = $_POST['userRePassword'];

    if (!empty($userFName) && !empty($userSName) && !empty($userAddress) && !empty($userPostcode) && !empty($userTelNo) && !empty($userEmail) && !empty($userPassword) && !empty($userRePassword)) {
        if ($userPassword != $userRePassword) {
            $message = 'Error: Passord does not match<br> Go back to <a href="register.php">Register</a>';
        } elseif (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $userEmail) == 0) {
            $message = 'Error: Email not valid<br> Go back to <a href="register.php">Register</a>';
        } else {
            $passwordHash = password_hash($userPassword, PASSWORD_BCRYPT);
            $query = "INSERT INTO users(userFName,userSName,userAddress,userPostcode,userTelNo,userEmail,userPassword) VALUES('{$userFName}','{$userSName}','{$userAddress}','{$userPostcode}','{$userTelNo}','{$userEmail}','{$passwordHash}')";

            $result = mysql_query($query);
            if ($result == false) {
                $message = 'Error: There is an existing user with the same email address<br> Go back to <a href="register.php">Register</a>';

            } else {
                $message = 'Registration succesful';
                $color = "green";
            }

            mysql_close($connection);
        }

    } else {
        $message = 'Error: All fields are mandatory<br> Go back to <a href="register.php">Register</a>';
    }

} else {
    $message = 'Error: Form data was not submitted!<br> Go back to <a href="register.php">Register</a>';
}

echo "<p><h3 style='color:" . $color . "'>" . $message . "</h3></p>";

//include head layout
include("footfile.html");
?>
