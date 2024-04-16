<?php
	session_start();
	include("functions.php");
	
	if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
		$user_name = $_SESSION["user"]["username"];
		$query = "DELETE FROM users WHERE username = '$user_name'";
		if(mysqli_query($conn, $query)){
			session_unset();
			session_destroy();
			
			header('location: index.php');
			die;
		} else {
			echo "Hiba történt a felhasználói fiók törlése során: " . mysqli_error($conn);
		}
	}
	else{
		header('location: index.php');
		die;
	}
?>