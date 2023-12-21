<?php

include '../Controllers/UserController.php';

$userController = new UserController();
$userList = $userController->getUsers();
$error = '';

session_start();
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header("Location: /PhoneStore/Views/UserLogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($userList as $userSearch) {
        if ($userSearch->getUsername() == $_POST["username"] && $userSearch->getPassword() == $_POST["password"]) {
            $_SESSION['user'] = $userSearch;
            header("Location: PhoneRead.php");
            break;
        } else {
            $error = "Логін чи пароль не вірний!";
        }
    }
}



echo '<div class="container mt-5" style="width: 30vw;">
    <form action="/PhoneStore/Views/UserLogin.php" method="post" style="width: 30vw;" autocomplete="off">
        <h2>Вхід на сайт</h2>

        <div class="mb-3">
            <label for="username">Логін:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-success">Увійти</button>
        <a href="/PhoneStore/Views/UserRegister.php" class="btn btn-primary">Зареєструватися</a>
    </form>
    <div class="text-danger">'.$error.'</div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">';
