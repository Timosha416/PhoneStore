<?php

include '../Controllers/UserController.php';

$userController = new UserController();
$userList = $userController->getUsers();
$error = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($userList as $userSearch) {
        if ($userSearch->getUsername() == $_POST["username"] || $userSearch->getEmail() == $_POST["email"]) {
            $error = "Логін чи електронна пошта уже існує!";
            break;
        }
    }
    if ($error =='') {
        $userController->createUser(
            $_POST["username"],
            $_POST["email"],
            $_POST["password"],
            $_POST["role"]
        );
        header("Location: UserLogin.php");
        exit();
    }
}
echo '<div class="container mt-5" style="width: 30vw;">
    <form action="/PhoneStore/Views/UserRegister.php" method="post" style="width: 30vw;" autocomplete="off">
        <h2>Реєстрація</h2>

        <div class="mb-3">
            <label for="username">Логін:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email">Електронна пошта:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div class="mb-3">
            <label for="role">Роль:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="Admin">Адміністратор</option>
                <option value="User">Користувач</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Зареєструватися</button>
        <a href="/PhoneStore/Views/UserLogin.php" class="btn btn-danger">Назад</a>
    </form>
    <div class="text-danger">'.$error.'</div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">';
