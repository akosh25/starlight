<?php
session_start();
include "functions.php";

if(isset($_POST["new_birthdate"]) && !empty($_POST["new_birthdate"])) {
    $new_birthdate = $_POST["new_birthdate"];
    $username = $_SESSION["user"]["username"];
 
    updateUserBirthdate($conn, $username, $new_birthdate);
 
    $_SESSION["user"]["szulev"] = $new_birthdate;
 
    header("Location: profile.php");
    exit();
 }
 
 if(isset($_POST["new_password"]) || isset($_FILES["new_profile_pic"])) {
    $username = $_SESSION["user"]["username"];
    $newPassword = isset($_POST["new_password"]) ? $_POST["new_password"] : null;
    $newProfilePic = null;
 
    // Profilkép frissítése
    if(isset($_FILES['new_profile_pic']['tmp_name']) && !empty($_FILES['new_profile_pic']['tmp_name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["new_profile_pic"]["name"]);
        if(move_uploaded_file($_FILES["new_profile_pic"]["tmp_name"], $target_file)) {
            $newProfilePic = $target_file;
        } else {
            echo "Hiba történt a kép feltöltésekor.";
        }
    }
 
    updateUserProfile($conn, $username, $newPassword, $newProfilePic);
 
    if(!empty($newProfilePic)) {
        $_SESSION["user"]["profile_pic"] = $newProfilePic;
    }
 
    header("Location: profile.php");
    exit();
 }
?>