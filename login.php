<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != "")
{
    header("Location: upload.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
		<?php
		if(isset($_SESSION['msg']) && $_SESSION['msg'] != "")
		{
			echo '<span class="text-success">'.$_SESSION['msg'].'</span>';
		}
		?>
        <form id="loginForm" method="post" action="login_action.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
			<a href="register.php">Register User</a>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#loginForm").validate({
                rules: {
                    username: "required",
                    password: "required"
                },
                messages: {
                    username: "Please enter your username",
                    password: "Please enter your password"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
