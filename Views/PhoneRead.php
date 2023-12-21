<?php
include '../Controllers/PhoneController.php';
include '../Models/User.php';
$phoneController = new PhoneController();
$phoneList = $phoneController->getPhones();
$user = null;

session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: UserLogin.php");
    exit();
}

echo '<div class="container" style="position: absolute; top: 10px; right: 10px; background-color: #f8f9fa; padding: 10px; border: 1px solid #dee2e6; border-radius: 5px; width: 250px; height: 140px;">';
echo '<p><strong>Користувач:</strong> ' . $user->getUsername() . '</p>';
echo '<p><strong>Роль:</strong> ' . $user->getRole() . '</p>';
echo '<a href="/PhoneStore/Views/UserLogin.php?logout=true" class="btn btn-danger">Вихід</a>';
echo '</div>';

echo '<div class="container d-flex justify-content-center align-items-center" style="height: 150px; font-weight: bold; font-size: 46px;">Список телефонів</div>';
if ($user->getRole() == 'Admin')
    echo '<a href="/PhoneStore/Views/PhoneCreate.php" class="btn btn-success mainblock">Додати телефон</a>';
echo '<table class="table table-hover">';
echo '<thead class="thead-light">';
echo '<tr>';
echo '<th>Марка</th>';
echo '<th>Модель</th>';
echo '<th>Рік випуску</th>';
echo '<th>Колір</th>';
echo '<th>Операційна система</th>';
echo '<th>Ціна</th>';
echo '<th></th>';
echo '<th></th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($phoneList as $phone) {
    echo '<tr>';
    echo '<td>' . $phone->getBrand() . '</td>';
    echo '<td>' . $phone->getModel() . '</td>';
    echo '<td>' . $phone->getReleaseYear() . '</td>';
    echo '<td>' . $phone->getColor() . '</td>';
    echo '<td>' . $phone->getOperatingSystem() . '</td>';
    echo '<td>$' . $phone->getPrice() . '</td>';
    if ($user->getRole() == 'Admin')
        echo '<td><button class="btn btn-primary btn-sm" onclick="updatePhone(' . $phone->getId() . ')">Редагувати</button></td>';
    if ($user->getRole() == 'Admin')
        echo '<td><button class="btn btn-danger btn-sm" onclick="deletePhone(' . $phone->getId() . ')">Видалити</button></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">';
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function deletePhone(phoneId) {
        $.ajax({
            type: 'POST',
            url: '/PhoneStore/Views/PhoneDelete.php',
            data: {phoneId: phoneId},
            success: function () {
                location.reload();
            }
        });
    }
</script>
<script>
    function updatePhone(phoneId) {
        window.location.href = '/PhoneStore/Views/PhoneUpdate.php?phoneId=' + phoneId;
    }
</script>