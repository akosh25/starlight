<?php
    session_start();
    include "functions.php";  

    $latogatasok = 1; // hányszor látogattuk meg a weboldalt

    // ha már van egy, az eddigi látogatások számát tároló sütink, akkor betöltjük annak az értékét
    if (isset($_COOKIE["visits"])) {
        $latogatasok = $_COOKIE["visits"] + 1;  // az eddigi látogatások számát megnöveljük 1-gyel
    }

    // süti a látogatásszám tárolása
    setcookie("visits", $latogatasok, time() + (60*60*24*30), "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Starlight</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
<div class="menu-bar">
        <nav>
            <ul class="nav-list">
                <li><a href="index.php" class="menu-item active"><img src="img/home.png" alt="Kezdőoldal" class="menu-image kezdo-kep"></a></li>
                <li><a href="asztrofotok.php" class="menu-item">Asztro fotók</a></li>
                <li><a href="amateur.php" class="menu-item">Infók</a></li>
                <li><a href="egyesulet.php" class="menu-item">Egyesület</a></li>
                <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                        <?php else: ?>
                        <?php $user = loadUser($conn, $_SESSION["user"]["username"]); 
                            if($user !== null && $user['role'] !== 'admin'): ?>
                            <li><a href="profile.php">Felhasználó</a></li>
                        <?php else: ?>
                            <li><a href="admin.php">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                        <li><a href="chat.php" class="menu-item">Chat</a></li>
                        <li><a href="logout.php">Kijelentkezés</a></li>
                        <?php endif; ?>
                    <li></li>
            </ul>
        </nav>
        </div>
</header>
<input type="checkbox" id="toggle">
<div class="container container">
<main>
<?php
if ($latogatasok > 1) {     // már járt az oldalon
          echo "<h1>Köszöntünk újra itt az Asztrofotósok körében!</h1>";
        } else {                    // először jár az oldalon
            echo "<h1>Köszöntünk először az Asztrofotósok körében!</h1>";
            echo "<h1>Örülünk, hogy itt vagy!</h1>";
        }
?>

    <?php
        if(isset($_SESSION["user"])){
            echo "<p class='login-link big-top-margin'>Jelenleg bejelentkeztél a profilodba!</p>";
            echo "<p class='login-link'><a href='logout.php'>Kijelentkezés</a></p>";            
        }
        else{
            
            echo "<img src='img/telescope.JPG' alt='csillag header' class='picture fadeInUpFirst'>";
            echo "<br>";
            echo "Amennyiben asztrofotót szeretnél beküldeni, akkor arra kérünk, hogy ";
            echo "<p class='login-link big-top-margin'>
            <a href='login.php'>Jelentkezz be</a>
             vagy 
            <a href='register.php'>Regisztrálj</a>!</p>";
        }

        
    ?>
</main>
<?php include "footer.php"?>
</div>
</body>
</html>