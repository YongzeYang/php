<?php
require 'utils/mail.php';

$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set PDO error mode to throw exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // User request to change password
    # if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_password"])) {
        $email = $_POST["email"];
        $sql = "SELECT * FROM users WHERE email='{$email}'";
        $res = $conn->query($sql);
        $user = $res->fetch();
        if ($user) {
            $code = rand(100000, 999999); // Generate random verification code
            sendVerficationEmailCode($email, $code); // send an email with code
            $_SESSION["code"] = $code;
            $_SESSION["email"] = $email;
            $_SESSION["code_expiration"] = time() + 15 * 60; // valid duration: 15 minutes
            echo "Verification code has been sent.";
        } else {
            echo "The email does not exist.";
        }
    # }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
