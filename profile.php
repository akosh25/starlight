<?php  
session_start();
include "functions.php";  
if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$user = loadUser($conn, $_SESSION["user"]["username"]);

// Ha a felhasználó létezik az adatbázisban és van profilképe
if($user !== null && !empty($user['profile_pic'])) {
    // A profilképet beállítjuk a $_SESSION változóban, hogy elérhető legyen más oldalakon is
    $_SESSION['user']['profile_pic'] = $user['profile_pic'];
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
    <style>

        .profile-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-info th {
            background-color: #f2f2f2;
        }
    </style>
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

            <div class="profile">
                <table>
                    <tr>
                        <th colspan="2">Felhasználói adatok</th>
                    </tr>
                    <tr>
                        <td>Felhasználónév:</td>
                        <td><?=$_SESSION["user"]["username"]?></td>
                    </tr>
                    <tr>
                        <td>Név:</td>
                        <td><?=$_SESSION["user"]["nev"]?></td>
                    </tr>
                    <tr>
                        <td>Születési idő:</td>
                        <td><?=$_SESSION["user"]["szulev"]?></td>
                    </tr>
                    <tr>
                        <td>Kor:</td>
                        <td><?=$_SESSION["user"]["age"]?></td>
                    </tr>
                    <tr>
                        <td>Profilkép:</td>
                        <td><img src="<?=$_SESSION['user']['profile_pic']?>" alt="Profilkép"></td>
                    </tr>
                </table>
            </div>
               

    <?php include "footer.php";?>
</body>
</html>