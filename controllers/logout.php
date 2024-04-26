<?php

session_start();
session_unset();
session_destroy();
$_SESSION['is_login'] = false;
echo "<script> location.href='/index.php'; </script>";

?>