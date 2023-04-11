<!-- 
Nicholas Werner, James Bailey, Larissa Passamani Lima
CSD 460 - Red Team
 -->
<?php
require('databaseMgmt.php');

session_start();

signOutUser();

header("Location: ../index.php");
?>