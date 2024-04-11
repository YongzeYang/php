<?php
$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // 设置 PDO 错误模式，用于抛出异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email='{$_GET["email"]}'";
    $res = $conn->query($sql);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($res->fetch());
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
 
$conn = null;
?>