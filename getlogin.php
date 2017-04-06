<?php
session_start();
require_once('db.php');

//create a variable called $pagename which contains the actual name of the page
$pagename = "Login Confirmation";

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
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    if (!empty($userEmail) && !empty($userPassword)) {
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $userEmail) == 0) {
            $message = 'Error: Email not valid<br><p> Go back to <a href="login.php">Login</a></p>';
        } else {

            $query = "SELECT userPassword,userId,userFName,userSName FROM users WHERE userEmail = '{$userEmail}'";

            $result = mysql_query($query);
            if (mysql_num_rows($result) == 0) {
                $message = 'Error: Sorry, the email you entered was not recognized<br><p> Go back to <a href="login.php">Login</a></p>';

            } else {
                $user_details = mysql_fetch_array($result);
                $paswordHash = $user_details[0];
                if (password_verify($userPassword, $paswordHash)) {
                    $_SESSION['c_userId'] = $user_details[1];
                    $_SESSION['c_userFName'] = $user_details[2];
                    $_SESSION['c_userSName'] = $user_details[3];

                    $message = '<strong>Hello, ' . $_SESSION['c_userFName'] . ' ' . $_SESSION['c_userSName'] . '</strong><br>You have successfully logged in to the system!<br>The email you entered is ' . $userEmail . '<br>The pasword you entered is ' . $userPassword . '<br><br>To continue shopping <a href="index.php">Product Index</a><br>To view basket <a href="basket.php">My Basket</a>';
                    $color = "green";
                } else {
                    $message = 'Error: Sorry, the password you entered is not valid<br><p> Go back to <a href="login.php">Login</a></p>';
                }
            }

            mysql_close($connection);
        }

    } else {
        $message = 'Error: All fields are mandatory<br><p> Go back to <a href="login.php">Login</a></p>';
    }

} else {
    $message = 'Error: Form data was not submitted!<br><p> Go back to <a href="login.php">Login</a></p>';
}

echo "<p><h3 style='color:" . $color . "'>" . $message . "</h3></p>";

//include head layout
include("footfile.html");
?>
