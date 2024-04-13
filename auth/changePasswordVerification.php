<?php
$servername="localhost";
$username = "root";
$password = "123456";
$dbname = "petShop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set PDO error mode to throw exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // user submit new password and code
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["verify_code"])) {
        $code = $_POST["code"];
        $new_password = $_POST["new_password"];
        if ($_SESSION["code"] == $code && time() <= $_SESSION["code_expiration"]) { //retrieve code from session
            $sql = "UPDATE users SET password='{$new_password}' WHERE email='{$_SESSION["email"]}'";
            $conn->exec($sql);
            echo "The password has been reset successfully!";
        } else {
            echo "Invalid Verification Code!";
        }
    }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
