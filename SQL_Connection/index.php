<?php
    $conn= new mysqli("localhost","root","","provisio") or die("Unable to connect");
    if($conn)
        echo "YAY It has connected successfully";
?>