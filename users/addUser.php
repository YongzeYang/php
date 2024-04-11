<?php
$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // 设置 PDO 错误模式，用于抛出异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (id, name, email, password,image_url)
    VALUES ('test0', 'test0', 'test0', 'test0','test0');";
    // 使用 exec() ，没有结果返回 
    $conn->exec($sql);
    echo "add new record successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
 
$conn = null;
?>