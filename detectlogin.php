<?php
if (isset($_SESSION['c_userId'])) {
    if ($_SESSION['c_userId'] != "") {
        echo '<em>Name: ' . $_SESSION['c_userFName'] . ' ' . $_SESSION['c_userSName'] . ' / Customer No: ' . $_SESSION['c_userId'] . '</em><hr>';
    }
}
?>