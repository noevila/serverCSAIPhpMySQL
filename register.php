<?php 
	session_start();
	include_once('connection.php');
	if($_POST['submit']){
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
        $phone = strip_tags($_POST['phone']);
        $mail = strip_tags($_POST['mail']);
		
		$query = "INSERT INTO members(username,password,activated) VALUES('$username', '$password','1')";
		$result = mysqli_query($db,$query);
		if($result) {
			echo "Succesfully registered";
            $dataQuery = "INSERT INTO userData(username,phone,mail) VALUES('$username', '$phone','$mail')";
            $resultData = mysqli_query($db,$dataQuery);
			header('Location: index.php');
		}
		else {
			echo "Failed to register";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<h1>Register</h1>
<form method="post" action="register.php">
	<input type="text" name = "username" placeholder="Enter username">
	<input type="password" name="password" placeholder="Enter password here">
	<input type="phone number" name="phone" placeholder="Insert your phone number for contact">
	<input type="mail" name="mail" placeholder="Insert your email address for contact">
	<input type="submit" name="submit" value="Register">
</form>
<a href = "index.php" >Login</a>

</body>
</html>
