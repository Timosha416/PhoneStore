<?php
include '../Models/User.php';

class UserController
{
    public $userList = array();

    public function getUsers()
    {
        $sql = "SELECT * FROM `users`;";
        $conn = $this->getConn();

        if (!$conn) {
            echo "<p>NOT Connected</p>";
            echo mysqli_connect_errno();
            return false;
        }

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['password'],
                $row['role']
            );
            $this->userList[] = $user;
        }

        mysqli_close($conn);
        return $this->userList;
    }

    public function createUser($username, $email, $password, $role)
    {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `role`) VALUES ('$username','$email','$password','$role')";
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
