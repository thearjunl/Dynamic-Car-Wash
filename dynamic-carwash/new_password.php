<?php
require_once 'db_connect.php';



if(isset($_POST['submit'])){
$id = $_SESSION['id'];
echo $_SESSION['id'];
$password = $_POST['password'];

$sql = "UPDATE login SET password = '$password' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
	$_SESSION['message'] = "Password has been reset successfully!";
	header("location: login.php");
} else {
	$_SESSION['message'] = "Error resetting password: " . $conn->error;
	header("location: new_password.php");
}}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="log.css">
</head>
<body>
	<div class="log">
		<div class="container">
			<form id="newPasswordForm" action="#" method="POST">
				<h2>Create a New Password</h2>
				<p>Please choose a strong and secure password.</p>
				<div class="input-field">
					<input type="password" id="password" name="password" required />
					<label for="password">Password</label>
				</div>
				<div class="input-field">
					<input type="password" id="confirmPassword" name="confirmPassword" required />
					<label for="confirmPassword">Confirm Password</label>
				</div>
				<input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']; ?>">
				<button type="submit" name="submit">Update Password</button>
				<div class="Create-account">
					<p>Return to <a href="login.php">Log In</a></p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>