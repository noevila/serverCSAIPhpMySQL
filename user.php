<?php
session_start();
$db = mysqli_connect("localhost", "root", "rootroot", "login") or die ("Failed to connect");
if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}
else {
	header('Location: index.php');
	die();
}
    
if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        }else{
            $task = $_POST['task'];
            $sql = "INSERT INTO todo (task, username) VALUES ('$task', '$username')";
            mysqli_query($db, $sql);
            header('location: user.php');
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome user</title>
</head>
<body>
<h3>Welcome <?php echo $username; ?>. , these are your personal notes, all your notes and log times will be saved. </h3>

<form method="post" action="user.php" class="input_form">
    <input type="text" name="task" class="task_input">
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add note</button>
</form>

<table>
    <thead>
        <tr>
            <th>N</th>
            <th>Notes</th>
        </tr>
    </thead>

    <tbody>
        <?php
        // select all tasks if page is visited or refreshed
        $tasks = mysqli_query($db, "SELECT task FROM todo WHERE username = '$username'");
        $i = 1;
            while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td> <?php echo $i; ?> </td>
                <td class="task"> <?php echo $row['task']; ?> </td>
            </tr>
        <?php $i++; } ?>
    </tbody>
</table>
<?php
$logtask = mysqli_query($db, "SELECT currentDateTime FROM logs WHERE username = '$username' ORDER BY currentDateTime DESC LIMIT 1,1");
$logrow = mysqli_fetch_row($logtask)
?>
<p> Your registered your previous login at <?php echo $logrow[0]; ?>, the new one is registered at <?php echo date('Y-m-d H:i:s'); ?> </p>

<form action="logout.php">
	<input type="submit" name="logout" value="Logout"> 
</form>

</body>
</html>
