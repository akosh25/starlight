<?php
	session_start();
	include("functions.php");
	
	if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
		$user_id = $_SESSION["user"]["id"];

		// Töröljük az összes olyan fotót, amelyek ehhez a felhasználóhoz tartoznak
		$delete_photos_query = "DELETE FROM photos WHERE user_id = $user_id";
		if(mysqli_query($conn, $delete_photos_query)){
			// Majd töröljük a felhasználó rekordját
			$delete_user_query = "DELETE FROM users WHERE id = $user_id";
			if(mysqli_query($conn, $delete_user_query)){
				session_unset();
				session_destroy();
				header('location: index.php');
				die;
			} else {
				echo "Hiba történt a felhasználói fiók törlése során: " . mysqli_error($conn);
			}
		} else {
			echo "Hiba történt a fotók törlése során: " . mysqli_error($conn);
		}
	}
	else{
		header('location: index.php');
		die;
	}
?>