<?php
    include "kozos.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Starlight</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP examples.">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
<div class="menu-bar">
        <nav>
            <ul class="nav-list">
                <li><a href="index.php" class="menu-item active"><img src="img/home.png" alt="Kezdőoldal" width="20" class="menu-image kezdo-kep"></a></li>
                <li><a href="asztrofotok.php" class="menu-item">Asztro fotók</a></li>
                <li><a href="amateur.php" class="menu-item">Infók</a></li>
                <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])):?>
                    <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                <?php else: ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                    <li><a href="logout.php">Kijelentkezés</a></li>
                <?php endif;?>
                <li></li>
            </ul>
        </nav>
        </div>
</header>
<main>
<h1>Üdvözöljük az Asztrofotósok körében!</h1>
    <?php
        if(isset($_SESSION["user"])){
            echo "<p class='login-link big-top-margin'>Üdvözlünk az Asztrofotósok társaságában!</p>";
            echo "<p class='login-link'>Or you can <a href='logout.php'>Kijelentkezés</a>.</p>";
            
            echo '<form id="form-login" class="login-link" action="delete_user.php" method="POST">
                    <input type="submit" name="btn-delete-ueser"  value="Delete my account">
                </form>';
            echo "<p class='login-link'>Check your <a href='message/message_page.php'>messages</a>.</p>";
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