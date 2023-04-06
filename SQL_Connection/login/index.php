<?php

    session_start();
    
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

?>

<!--
        SOURCE FOR SAMPLE CODE
    https://www.youtube.com/watch?v=WYufSGgaCZ8
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Login/Logout</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>This is the index page for the Sample Login/Logout tutorial</h1>

    <br>
    <h2>Hello, <?php echo $user_data['user_name']; ?></h2>

</body>
</html>