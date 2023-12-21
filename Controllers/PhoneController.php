<?php
include '../Models/Phone.php';

class PhoneController
{
    public $phoneList = array();

    public function getPhones()
    {
        $sql = "SELECT * FROM `phones`;";
        $conn = $this->getConn();

        if (!$conn) {
            echo "<p>NOT Connected</p>";
            echo mysqli_connect_errno();
            return false;
        }

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $phone = new Phone(
                $row['id'],
                $row['brand'],
                $row['model'],
                $row['releaseYear'],
                $row['color'],
                $row['operatingSystem'],
                $row['price']
            );
            $this->phoneList[] = $phone;
        }

        mysqli_close($conn);
        return $this->phoneList;
    }

    public function createPhone($brand, $model, $releaseYear, $color, $operatingSystem, $price)
    {
        $sql = "INSERT INTO `phones`(`brand`, `model`, `releaseYear`, `color`, `operatingSystem`, `price`) VALUES ('$brand','$model','$releaseYear','$color','$operatingSystem','$price')";
        $conn = $this->getConn();

        if (!$conn) {
            echo "<p>NOT Connected</p>";
            echo mysqli_connect_errno();
            return false;
        }

        $conn->query($sql);
        mysqli_close($conn);
    }

    public function updatePhone($id, $brand, $model, $releaseYear, $color, $operatingSystem, $price)
    {
        $sql = "UPDATE `phones` SET `brand`='$brand',`model`='$model',`releaseYear`='$releaseYear',`color`='$color',`operatingSystem`='$operatingSystem',`price`='$price' WHERE `id`= $id";
        $conn = $this->getConn();

        if (!$conn) {
            echo "<p>NOT Connected</p>";
            echo mysqli_connect_errno();
            return false;
        }

        $conn->query($sql);
        mysqli_close($conn);
    }

    public function deletePhone($id)
    {
        $sql = "DELETE FROM `phones` WHERE id=$id";
        $conn = $this->getConn();

        if (!$conn) {
            echo "<p>NOT Connected</p>";
            echo mysqli_connect_errno();
            return false;
        }

        $conn->query($sql);
        mysqli_close($conn);
    }

    public function getConn()
    {
        $server = "127.0.0.1";
        $database = "phonestoredb";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($server, $username, $password, $database);
        return $conn;
    }
}