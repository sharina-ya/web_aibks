<?php
$link = mysqli_connect('127.0.0.1', 'root', 'your_password');

if (!$link) {
    die('Error: ' . mysqli_connect_error());
}

echo 'Good!';
mysqli_close($link);
?>