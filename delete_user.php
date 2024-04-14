<?php
	session_start();
	include("functions.php");
	
	if(isset($_SESSION["username"])){
		$user_name = $_SESSION["username"];
		$query = "DELETE FROM users WHERE username = '$username'";
		if(mysqli_query($con, $query)){
		    session_unset();
		    session_destroy();
		    echo "A felhasználói fiók sikeresen törölve lett.";
		    header('location: login.php'); // Átirányítás az index.php fájlra
		    die;
		} else {
		    echo "Hiba történt a felhasználói fiók törlése során.";
		}
	}
	else{
		header('location: asztrofotok.php');
		die;
	}
?>