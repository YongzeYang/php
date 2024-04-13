<?php
$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set PDO error mode to throw exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();
    $_SESSION = array();
    session_destroy(); // Destroy session
    setcookie("user", "", time() - 3600);
    echo "Logout successful.";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
