<?php
// Проверяем, передан ли параметр id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Ошибка: ID поста не указан");
}

$id = $_GET['id'];

// Проверяем, что id - число
if (!is_numeric($id)) {
    die("Ошибка: ID должен быть числом");
}

// Подключаемся к БД
$link = mysqli_connect('localhost', 'root', '1234', 'hack_site');

// Проверяем подключение
if (!$link) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Безопасный запрос (экранируем id)
$id = mysqli_real_escape_string($link, $id);
$sql = "SELECT * FROM posts WHERE id = $id";
$res = mysqli_query($link, $sql);

// Проверяем, найден ли пост
if (mysqli_num_rows($res) == 0) {
    die("Пост не найден");
}

$rows = mysqli_fetch_array($res);
$title = $rows['title'];
$content = $rows['content'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Шарина Юлия</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-12 p-5 rounded login-box" style="background-color: #212529; color: #fff;">
        <h1 class="mb-4 text-center"><?php echo htmlspecialchars($title); ?></h1>
        <p class="fs-5"><?php echo nl2br(htmlspecialchars($content)); ?></p>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">На главную</a>
        </div>
    </div>
</div>
</body>
</html>