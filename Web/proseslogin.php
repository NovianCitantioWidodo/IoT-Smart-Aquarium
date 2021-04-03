<?php 
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
if ($user == "realmi" && $pass == "123321") {
	$_SESSION["username"] = "realmi";
	$_SESSION["password"] = "123321";
	echo $_SESSION["username"];
	echo $_SESSION["password"];
	header("location:123321.php");
} else {
	echo("Username dan Password tidak cocok.");
	setcookie("message", "Maaf, Username atau Password salah", time()+60);
	header("location:login.php");
}
?>