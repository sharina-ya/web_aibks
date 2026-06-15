<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "hack_site";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    echo "Ошибка создания БД: " . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);

$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL
)";

if ($conn->query($sql_users) !== TRUE) {
    echo "Ошибка при создании таблицы пользователей: " . $conn->error;
}

$sql_posts = "CREATE TABLE IF NOT EXISTS posts (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
)";

if ($conn->query($sql_posts) !== TRUE) {
    echo "Ошибка при создании таблицы постов: " . $conn->error;
}

$conn->close();
?>