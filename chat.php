<?php  
session_start();
include "functions.php";

if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$user = loadUser($conn, $_SESSION["user"]["username"]);

// létezik a felhasnzáló
if($user !== null && !empty($user['profile_pic'])) {
    // profilképet mentése, hogy más lapok is lássák
    $_SESSION['user']['profile_pic'] = $user['profile_pic'];
}

// Felhasználók lekérdezése az adatbázisból
$users = loadAllUsers($conn);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <div class="menu-bar">
            <nav>
                <ul class="nav-list">
                    <li><a href="index.php" class="menu-item"><img src="img/home.png" alt="Kezdőoldal" class="menu-image kezdo-kep"></a></li>
                    <li><a href="asztrofotok.php" class="menu-item">Asztro fotók</a></li>
                    <li><a href="amateur.php" class="menu-item">Infók</a></li>
                    <li><a href="egyesulet.php" class="menu-item">Egyesület</a></li>
                    <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                    <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                    <?php else: ?>
                        <li><a href="profile.php">Felhasználó</a></li>
                        <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                        <li><a href="chat.php" class="menu-item active">Chat</a></li>
                        <li><a href="logout.php">Kijelentkezés</a></li>
                    <?php endif; ?>
                    <li></li>
                </ul>   
            </nav>
        </div>
    </header>
    <h1>Chat</h1>
    
    <div class="messages"></div>

    <?php
    // üzenetek lekérdezése
    $messages = getMessages($conn, $_SESSION["user"]["username"]);

    // üzenetek megjelenítése fordított időrendben
    $messages = array_reverse($messages);
    foreach ($messages as $message): ?>
        <div class="message">
            <span class="sender"><?= $message['sender_username'] ?>:</span>
            <span class="content"><?= $message['message'] ?></span>
        </div>
    <?php endforeach; ?>
    
    <?php if (isset($_GET["message"])): ?>
        <p><?= $_GET["message"] ?></p>
    <?php endif; ?>
    
    <br>
    <form action="send_message.php" method="POST">
        <select name="receiver_username" required>
            <option value="" disabled selected>Válasszon címzettet...</option>
            <?php foreach ($users as $user): ?>
                <?php if ($user['username'] !== $_SESSION["user"]["username"]): ?>
                    <option value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select> 
        <br>
        <textarea name="message" 
            style="max-width: 20%; width: 20%; min-height: 10px; padding: 10px;" 
            placeholder="Írj üzenetet..." required>
        </textarea>
        <br>
        <button type="submit">Küldés</button>
    </form>
    <br>
    <br>
    <a href="logout.php">Kijelentkezés</a>
    
</body>
</html>