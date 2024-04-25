<?php  
    session_start();
    include "functions.php";
    if(isset($_SESSION["user"]) || !empty($_SESSION["user"])){
        header("Location: index.php");
        exit();
    }  
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Keződőoldal</title>
    <meta name="author" content="Starlight team" />
    <meta name="description" content="Bejelentkezés" />
    <meta name="keywords" content="csillagok, asztrofotók, bolygók" />
    <link rel="icon" href="logo/comet.jpg" />
    <link rel="stylesheet" href="style/style.css" />
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
                <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])):?>
                    <li><a href="login.php" class="menu-item active">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                <?php else: ?>
                    <li><a href="admin.php">Felhasználó</a></li>
                    <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                    <li><a href="logout.php">Kijelentkezés</a></li>
                <?php endif;?>
                <li></li>
            </ul>
        </nav>
        </div>
    </header>
    <input type="checkbox" id="toggle">
    <div class="container container">
<section class="content">
    <form action="login.php" method="POST">
        <label>Felhasználónév: <input type="text" name="username"></label>
        <br>
        <label>Jelszó: <input type="password" name="password"></label>
        <br>
        <input type="submit" name="login" value="Bejelentkezés">
        <br>    
    </form>
    <?php

    if(isset($_POST["login"])){
        $user = $_POST["username"];
        $pass = $_POST["password"];
        
        $user_data = loadUser($conn, $user);
        if($user_data){
            $banned = $user_data['banned'];
    
            if($banned){
                echo "A felhasználó le lett tiltva! Keresd meg az adminisztrátort";
            } else if(password_verify($pass, $user_data["password"])){
                $_SESSION["user"] = $user_data;
                header("Location: admin.php");
                exit();
            } else {
                echo "Sikertelen belépés.";
            }
        } else {
            echo "Sikertelen belépés.";
        }
    }
    ?>
    </section>
    <br/>
    <br/>
    <?php include "footer.php";?>
    </div>    
</body>
</html>
