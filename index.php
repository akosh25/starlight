<?php
    include "functions.php";
    session_start();

    $latogatasok = 1; // hányszor látogattuk meg a weboldalt eddig

  // ha már van egy, az eddigi látogatások számát tároló sütink, akkor betöltjük annak az értékét
  if (isset($_COOKIE["visits"])) {
    $latogatasok = $_COOKIE["visits"] + 1;  // az eddigi látogatások számát megnöveljük 1-gyel
  }

  // egy "visits" nevű süti a látogatásszám tárolására, amelynek élettartama 30 nap
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
                <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])):?>
                    <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                <?php else: ?>
                    <li><a href="profile.php">Felhasználó</a></li>
                    <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                    <li><a href="logout.php">Kijelentkezés</a></li>
                <?php endif;?>
                <li></li>
            </ul>
        </nav>
        </div>
</header>
<main>
<?php
if ($latogatasok > 1) {     // már járt az oldalon
          echo "<h1>Köszöntünk újra itt az Asztrofotósok körében!</h1>";
        } else {                    // először jár az oldalon
            echo "<h1>Köszöntünk először az Asztrofotósok körében! Örülünk, hogy itt vagy!</h1>";
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
</body>
</html>