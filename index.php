<?php
require_once("Includes/db.php");
$logonSuccess = false;


// verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials($_POST['user'], $_POST['userpassword']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editWishList.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form name="wishlist" action="wishlist.php">
            Show wish list of: <input type="text" name="user" value="" />
            <input type="submit" value="Go" />
            <br>Still don't have a wish list?! <a href="createNewWisher.php">Create now</a>
        </form>

        <form name="logon" action="index.php" method="POST" >
            Username: <input type="text" name="user">
            Password  <input type="password" name="userpassword">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!$logonSuccess)
                    echo "Invalid name and/or password";
            }
            ?>
            <input type="submit" value="Edit My Wish List">
        </form>
    </body>
</html>
