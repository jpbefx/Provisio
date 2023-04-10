<?php
require('databaseMgmt.php');

session_start();

signOutUser();

header("Location: ../index.php");
?>