<?php
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
    </head>
    <body>
        Hello <?php echo $_SESSION['user']; ?><br/>
        <table border="black">
            <tr><th>Item</th><th>Due Date</th></tr>
            <?php
            require_once("Includes/db.php");
            $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION['user']);
            $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>" . htmlentities($row['description']) . "</td>";
                echo "<td>" . htmlentities($row['due_date']) . "</td></tr>\n";
            }
            mysqli_free_result($result);
            ?>
        </table>
        <form name="addNewWish" action="editWish.php">
            <input type="submit" value="Add Wish"/>
        </form>
        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Back To Main Page"/>
        </form>

    </body>
</html>