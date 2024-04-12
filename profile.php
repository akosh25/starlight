<?php  
session_start();
include "kozos.php";  
if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Keződőoldal</title>
    <meta name="author" content="Starlight team">
    <meta name="description" content="Bejelentkezés">
    <meta name="keywords" content="csillagok, asztrofotók, bolygók">
    <link rel="icon" href="logo/comet.jpg">
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
                    <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                    <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                    <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <li><a href="login.php" class="menu-item active">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                    <?php else: ?>
                        <li><a href="profile.php">Felhasználó</a></li>
                        <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                        <li><a href="logout.php">Kijelentkezés</a></li>
                    <?php endif; ?>
                    <li></li>
                </ul>
            </nav>
        </div>
    </header>
    <input type="checkbox" id="toggle">
    <div class="container">
        <section class="content">
            <div class="profile-info">
                <div>
                    <label>Név:</label>
                    <span><?=$_SESSION["user"]["username"]?></span>
                </div>
                <div>
                    <label>Kor:</label>
                    <span><?=$_SESSION["user"]["age"]?></span>
                </div>
            </div>
        </section>
    </div>
    <?php include "footer.php";?>
</body>
</html>