<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
->
<?php
$username = $_SESSION['username'];

session_unset();

sleep(1);

$_SESSION['username'] = $username;

header("Location: ../index.php");

?>