<?php
require_once('db.php');

if (!isset($_COOKIE['User'])) {
    header("Location: login.php");
}

$link = mysqli_connect('localhost', 'root', '1234', 'hack_site');

if (isset($_POST['submit'])) {
    $title = $_POST['postTitle'];
    $main_text = $_POST['postContent'];

    if (!$title || !$main_text) die("Заполните все поля");

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$main_text')";

    if (!mysqli_query($link, $sql)) die("Ошибка при сохранении поста");

    if (!empty($_FILES["file"])) {
        if (((@$_FILES["file"]["type"] == "image/gif") || (@$_FILES["file"]["type"] == "image/jpeg")
        || (@$_FILES["file"]["type"] == "image/jpg") || (@$_FILES["file"]["type"] == "image/pjpeg")
        || (@$_FILES["file"]["type"] == "image/x-png") || (@$_FILES["file"]["type"] == "image/png"))
        && (@$_FILES["file"]["size"] < 10240000)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "Файл загружен в: " . "upload/" . $_FILES["file"]["name"];
        } else {
            echo "Ошибка при загрузке файла";
        }
    }
}
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
    <nav class="navbar navbar-dark bg-dark p-3" style="border-bottom: 2px solid #3f3;">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand d-flex align-items-center gap-3">
                <img src="logohack.webp" alt="логотип" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                <span style="color: #3f3; font-weight: bold;">History</span>
            </a>
            <form action="logout.php" method="POST">
                <button name="logout" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="login-box p-4 rounded mx-auto" style="max-width: 800px;">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 mb-4">
                <div class="text-start w-100">
                    <p class="fs-5 m-0" style="color: #3f3;">Привет, <?php echo $_COOKIE['User']; ?>! Здесь ты можешь делиться своими мыслями.</p>
                </div>
                <img src="hack1.webp" alt="фото" class="hacker-img rounded">
            </div>

            <div class="text-center mt-4">
                <button id="toggleButton" class="btn btn-primary">Open</button>
            </div>

            <div id="extraImage" class="mt-4 text-center" style="display: none;">
                <img class="hacker-img rounded" src="hack2.webp" alt="скрытое_фото">
            </div>

            <hr style="border-color: #3f3; border-width: 2px; opacity: 1;" class="my-5">

            <h2 class="text-center mb-4">Add New Post</h2>
            <form action="profile.php" id="postForm" class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data">
                <div class="text-start">
                    <label class="form-label fw-bold" style="color: #3f3;" for="postTitle">Post Title</label>
                    <input type="text" name="postTitle" class="form-control custom-input" id="postTitle" placeholder="Enter post Title" required>
                </div>
                <div class="text-start">
                    <label class="form-label fw-bold" style="color: #3f3;" for="postContent">Post Content</label>
                    <textarea name="postContent" class="form-control custom-input" id="postContent" placeholder="Enter post Content" rows="5" required></textarea>
                </div>
                <div class="text-start">
                    <label class="form-label fw-bold" style="color: #3f3;" for="file">Upload file</label>
                    <input type="file" name="file" class="form-control custom-input" id="file" style="background-color: #fff !important; color: #000 !important;">
                </div>
                <button class="btn btn-primary mt-3" type="submit" name="submit">Save Post</button>
            </form>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>