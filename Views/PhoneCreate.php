<?php

include '../Controllers/PhoneController.php';
include '../Models/User.php';

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 'Admin') {
    header("Location: UserLogin.php");
    exit();
}

$phoneController = new PhoneController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneController->createPhone(
        $_POST["brand"],
        $_POST["model"],
        $_POST["releaseYear"],
        $_POST["color"],
        $_POST["operatingSystem"],
        $_POST["price"]
    );
    header("Location: PhoneRead.php");
    exit();
}

echo '<div class="container mt-5" style="width: 30vw;">
    <form action="/PhoneStore/Views/PhoneCreate.php" method="post" style="width: 30vw;" autocomplete="off">
        <h2>Додати телефон</h2>

        <div class="mb-3">
            <label for="brand">Марка:</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>

        <div class="mb-3">
            <label for="model">Модель:</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>

        <div class="mb-3">
            <label for="releaseYear">Рік випуску:</label>
            <input type="number" class="form-control" id="releaseYear" name="releaseYear" required>
        </div>

        <div class="mb-3">
            <label for="color">Колір:</label>
            <input type="text" class="form-control" id="color" name="color" required>
        </div>

        <div class="mb-3">
            <label for="operatingSystem">Операційна система:</label>
            <input type="text" class="form-control" id="operatingSystem" name="operatingSystem" required>
        </div>

        <div class="mb-3">
            <label for="price">Ціна:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <button type="submit" class="btn btn-success">Додати</button>
        <a href="/PhoneStore/Views/PhoneRead.php" class="btn btn-danger">Назад</a>
    </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">';
