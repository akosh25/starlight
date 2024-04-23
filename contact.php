<?php  
session_start();
include "functions.php";  

if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$user = loadUser($conn, $_SESSION["user"]["username"]);


?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kapcsolat</title>
    <meta name="author" content="Starlight team" />
    <meta name="description" content="Elérhetőségek" />
    <meta name="keywords" content="csillagok, asztrofotók, bolygók" />
    <link rel="icon" href="logo/comet.jpg" />
    <link rel="stylesheet" href="style/style.css" />
</head>
<body class="contact-background">
<main id="contact-content">
    <header>
        <div class="menu-bar">
        <nav>
            <ul class="nav-list">
                <li><a href="index.php" class="menu-item"><img src="img/home.png" alt="Kezdőoldal" class="menu-image kezdo-kep"></a></li>
                <li><a href="asztrofotok.php" class="menu-item">Asztro fotók</a></li>
                <li><a href="amateur.php" class="menu-item">Infók</a></li>
                <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                <li><a href="contact.php" class="menu-item active">Kapcsolat</a></li>
                <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <li><a href="login.php" class="menu-item active">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                        <?php else: ?>
                        <?php if($user !== null && $user['role'] !== 'admin'): ?>
                            <li><a href="profile.php">Felhasználó</a></li>
                        <?php else: ?>
                            <li><a href="admin.php">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                        <li><a href="logout.php">Kijelentkezés</a></li>
                        <?php endif; ?>
                    <li></li>
            </ul>
        </nav>
        </div>
    </header>
    <input type="checkbox" id="toggle">
    <h1>Kapcsolat</h1>
    <form action="kapcsolat-feldolgoz.html" method="post" enctype="multipart/form-data">
        <label for="name">Név:</label>
        <input type="text" id="name" name="name" required>
        <label for="email" class="small-input">Email cím:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="message" class="email-icon fadeInUpFirst">Üzenet <img src="img/email.png" alt="email"></label>
        <br>
        <textarea id="message" name="message" class="small-input" maxlength="300" rows="10" required></textarea>
        <button type="submit">Küldés</button>
    </form>
</main>

<?php include "footer.php"?>
</body> 
</html>