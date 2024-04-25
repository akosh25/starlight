<?php
session_start();
include "functions.php";

// be van jelentkezve?
if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// van elküldött adat?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // megvan-e minden adat
    if (isset($_POST["receiver_username"]) && isset($_POST["message"])) {
        // felhasználónév használata
        $sender_username = $_SESSION["user"]["username"];
        $receiver_username = $_POST["receiver_username"];
        $message = $_POST["message"];

        // fogadó létezik-e
        $receiver = loadUser($conn, $receiver_username);

        if ($receiver !== null) {
            // üzene küldése
            sendMessage($conn, $sender_username, $receiver_username, $message);
            $message = "Üzenet sikeresen elküldve!";
            header("Location: chat.php");
            exit;
        } else {
            echo "A fogadó felhasználó nem létezik!";
        }
    } else {
        echo "Hiányzó adatok!";
    }
} else {
    echo "Hibás kérés!";
}
?>