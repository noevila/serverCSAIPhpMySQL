<?php

session_start();
include_once('connection.php');

if($_POST['submit']) {
	include_once('connection.php');
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);

	$sql = "SELECT username,password FROM members where username = '$username' LIMIT 1";
	$query = mysqli_query($db, $sql);
	if($query) {
		$row = mysqli_fetch_row($query);
		$dbUserName = $row[0];
		$dbPassword = $row[1];
	}
	if($username == $dbUserName && $password == $dbPassword) {
        $currentDateTime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO logs (username, currentDateTime) VALUES ('$username', '$currentDateTime')";
        $query = mysqli_query($db, $sql);
		$_SESSION['username'] = $username;
		header('Location: user.php');
	}
	else {
		echo "<b><i>Incorrect credentials</i><b>";

	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>PHP-SQL Login</title>
</head>
<body>
<h1>Login</h1>
<form method="post" action="index.php">
	<input type="text" name = "username" placeholder="Enter username">
	<input type="password" name="password" placeholder="Enter password here">
	<input type="submit" name="submit" value="Login">
</form>

<a href="register.php" >Register</a>

</body>
</html>
