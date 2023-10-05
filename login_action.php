<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strip_tags(trim($_POST["username"]));
    $password = strip_tags(trim($_POST["password"]));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    
    $pdo = new PDO("mysql:host=10.15.252.155;dbname=users", "develop", "@skmet0Ch@nge");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $username, PDO::PARAM_STR);
    $stmt->execute();
    $user_details = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $validPassword = $user_details['password'];
    $validUsername = $user_details['email'];
        
    if ($username === $validUsername && password_verify($password,  $validPassword)) {
        $_SESSION["username"] = $username;
        header("Location: upload.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Login Page</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>
