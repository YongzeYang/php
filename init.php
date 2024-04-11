<?php
//include_once "conn.php";
include_once "placeholder.php";

// 1.create Database function petShop
function createDB($pdo){
    $sql = "CREATE DATABASE IF NOT EXISTS petShop";
    if ( $pdo->query($sql) === TRUE) {
        echo "Databse created successfully";
    } else {
        echo "database already existed ";
    }
};

// 2.seed table uses and users data into DB
function seedUsers($pdo,$users)
{
    try{
        // create table
        $pdo->query("CREATE TABLE IF NOT EXISTS users (
                    id VARCHAR(36) DEFAULT (UUID()) PRIMARY KEY, 
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password TEXT NOT NULL,
                    image_url VARCHAR(255) NOT NULL
                );");
        echo "<br />Created 'users' table";
        // insert users data
        foreach ($users as $user) {
            $hashedPassword = password_hash($user["password"],PASSWORD_DEFAULT); // hash encryption,default using bcrypt and cost 10
            $pdo->query("INSERT INTO users (id, name, email, password,image_url)
                  VALUES ('{$user["id"]}', '{$user["name"]}', '{$user["email"]}', '{$hashedPassword}','{$user["image_url"]}');");
        }
        echo "<br> Seeded  users successfully";
    }catch(PDOException $e)
    {
        echo "<br>" . "error in seedUsers:".$e->getMessage();
    }
}

// 3.seed table toys and toys data into DB
function seedToys($pdo,$toys)
{
    try{
        // create table
        $pdo->query("CREATE TABLE IF NOT EXISTS toys (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            price INT NOT NULL,
            date DATE NOT NULL,
            stock INT NOT NULL,
            image_url VARCHAR(255) NOT NULL
          );");
        echo "<br> Created 'toys' table";
        // insert users data
        foreach ($toys as $toy) {
            $pdo->query("INSERT INTO toys (name, price, date,stock,image_url)
            VALUES ('{$toy["name"]}', '{$toy["price"]}', '{$toy["date"]}','{$toy["stock"]}','{$toy["image_url"]}');");
        }
        echo "<br> Seeded  toys successfully";
    }catch(PDOException $e){
        echo "<br>" . "error in seedToys:".$e->getMessage();
    }
}

// 4.seed table food and food data into DB
function seedFood($pdo,$food)
{
    try{
        // create table
        $pdo->query("CREATE TABLE IF NOT EXISTS food (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            price INT NOT NULL,
            date DATE NOT NULL,
            stock INT NOT NULL,
            image_url VARCHAR(255) NOT NULL
          );");
        echo "<br> Created 'food' table";
        // insert users data
        foreach ($food as $row) {
            $pdo->query("INSERT INTO food (name, price, date,stock,image_url)
            VALUES ('{$row["name"]}', '{$row["price"]}', '{$row["date"]}','{$row["stock"]}','{$row["image_url"]}');");
        }
        echo "<br> Seeded  food successfully";
    }catch(PDOException $e){
        echo "<br>" . "error in seedFood:".$e->getMessage();
    }
}

// 5.seed table invoices and invoices data into DB
function seedInvoices($pdo,$invoices)
{
    try{
        // create table
        $pdo->query("CREATE TABLE IF NOT EXISTS invoices (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id VARCHAR(36) NOT NULL,
            amount INT NOT NULL,
            status VARCHAR(255) NOT NULL,
            date DATE NOT NULL
          );");
        echo "<br> Created 'invoices' table";
        // insert users data
        foreach ($invoices as $invoice) {
            $pdo->query("INSERT INTO invoices (customer_id, amount, status, date)
            VALUES ('{$invoice["customer_id"]}', '{$invoice["amount"]}', '{$invoice["status"]}', '{$invoice["date"]}');");
        }
        echo "<br> Seeded  invoices successfully";
    }catch(PDOException $e){
        echo "<br>" . "error in seedInvoices:".$e->getMessage();
    }
}

// 6.seed table managers and managers data into DB
function seedManagers($pdo,$managers)
{
    try{
        // create table
        $pdo->query("CREATE TABLE IF NOT EXISTS managers (
            id VARCHAR(36) DEFAULT (UUID()) PRIMARY KEY, 
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password TEXT NOT NULL,
            image_url VARCHAR(255) NOT NULL
          );");
        echo "<br> Created 'Managers' table";
        // insert Managers data
        foreach ($managers as $manager) {
            $hashedPassword = password_hash($manager["password"],PASSWORD_DEFAULT);
            $pdo->query("INSERT INTO managers (id, name, email, password,image_url)
            VALUES ('{$manager["id"]}', '{$manager["name"]}', '{$manager["email"]}','{$hashedPassword}', '{$manager["image_url"]}');");
        }
        echo "<br> Seeded  Managers successfully";
    }catch(PDOException $e){
        echo "<br>" . "error in seedManagers".$e->getMessage();
    }
}

// 7.seed table managers and managers data into DB
function seedRevenue($pdo,$revenue)
{
    try{
        // create table
        $pdo->query("CREATE TABLE IF NOT EXISTS revenue (
            month VARCHAR(4) NOT NULL UNIQUE,
            revenue INT NOT NULL
          );");
        echo "<br> Created 'revenue ' table";
        // insert revenue  data
        foreach ($revenue as $row) {
            $pdo->query("INSERT INTO revenue (month, revenue)
            VALUES ('{$row["month"]}', '{$row["revenue"]}');");
        }
        echo "<br> Seeded  revenue  successfully";
    }catch(PDOException $e){
        echo "<br>" . "error in seedRevenue:".$e->getMessage();
    }
}


// 0.connect mysql using php pdo
$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";
 
try {
    $pdo = new PDO("mysql:host=$servername", $username, $password);

    // 设置 PDO 错误模式为异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "数据库连接成功<br>";
}
catch(PDOException $e)
{
    echo "<br>connect DB error: " . $e->getMessage();
}
createDB($pdo);

$pdo = null;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
seedUsers($conn,$users);
seedToys($conn,$toys);
seedFood($conn,$food);
seedInvoices($conn,$invoices);
seedManagers($conn,$managers);
seedRevenue($conn,$revenue);
// close connect
$conn = null
?>