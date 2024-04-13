<?php
$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set PDO error mode to throw exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $psw = $_POST["password"];// Note: NOT hashed

    $sql = "SELECT * FROM users WHERE email='{$_POST["email"]}' AND password='{$psw}'";
    $res = $conn->query($sql);
    $user = $res->fetch();
    if ($user) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user["id"];
        $_SESSION["email"] = $user["email"];
        setcookie("user", $user["email"], time() + (86400 * 30), "/"); // 86400 = 1 day
        echo "Login successful";
    } else {
        echo "Wrong password or email";
    }


}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
