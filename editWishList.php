<?php

session_start();
if (array_key_exists("user", $_SESSION)) {
    echo "Hello " . $_SESSION['user'];
} else {
    header('Location: index.php');
    exit;
}
?>
