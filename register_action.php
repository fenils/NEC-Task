<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    $firstName = strip_tags(trim($_POST["firstName"]));
    $lastName = strip_tags(trim($_POST["lastName"]));
    $email = strip_tags(trim($_POST["email"]));
    $password = strip_tags(trim($_POST["password"]));

	$pdo = new PDO("mysql:host=10.15.252.155;dbname=users", "develop", "@skmet0Ch@nge");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $isEmailUnique = $stmt->fetch(PDO::FETCH_ASSOC);
	
    if ($isEmailUnique) {
        echo "Email address is already registered. Please use a different email.";
    } else {
		
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = new PDO("mysql:host=10.15.252.155;dbname=users", "develop", "@skmet0Ch@nge");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
			$_SESSION['msg'] = "Registration was successful";
			header("Location: login.php");
			exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
