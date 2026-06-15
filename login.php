<?php
require_once('db.php');

$link = mysqli_connect('localhost', 'root', '1234', 'hack_site');

if (isset($_COOKIE['User'])) {
    header("Location: profile.php");
}

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];

    if (!$login || !$pass) {
        die("Пожалуйста, введите все значения!");
    }

    $sql = "SELECT * FROM users WHERE username='$login' AND password='$pass'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        setcookie("User", $login, time()+7200);
        header("Location: profile.php");
    } else {
        echo "Неверный логин или пароль";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Котляренко Анастасия</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-box p-4 rounded">
        <h1 class="mb-4 text-center">login</h1>
        <form action="login.php" method="POST" class="d-flex flex-column gap-3">
            <input type="text" name="login" class="form-control custom-input" placeholder="login">
            <input type="password" name="password" class="form-control custom-input" placeholder="password">
            <button class="btn btn-primary mt-3" type="submit" name="submit">Login</button>
            <p class="mt-3 text-center">Don't have an account? <a href="registration.php">Register</a></p>
        </form>
    </div>
</div>
</body>
</html>