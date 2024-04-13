<?php

require 'utils/mail.php';

$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    # Note: the password is not hashed!
    $sql = "INSERT INTO users (id, name, email, password, image_url)
    VALUES ('{$_POST["id"]}', '{$_POST["name"]}', '{$_POST["email"]}', '{$_POST["password"]}', '{$_POST["image_url"]}');";
    $conn->exec($sql);

    echo "Registration Successful";
    sendWelcomeEmail($_POST["email"]);

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
