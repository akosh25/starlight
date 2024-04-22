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
    <meta name="description" content="Regisztráció" />
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
                    <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item active">Regisztráció</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>

<input type="checkbox" id="toggle">
<div class="container container">
    <section class="content">
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <label>Felhasználónév: <input type="text" name="username"></label><br>
            <label>Jelszó: <input type="password" name="password"></label><br>
            <label>Jelszó ismét: <input type="password" name="password2"></label><br>
            <label for="nev">Név: <input type="text" name="nev" id="nev"></label><br>
            <label for="szulev">Születési dátum: <input type="date" name="szulev" id="szulev"></label><br>
            <label>Kor: <input type="number" name="age"></label><br>
            <label>Profilkép: <input type="file" name="profile-pic"></label><br>
            <label><input type="radio" name="gender" value="m">Férfi</label>
            <label><input type="radio" name="gender" value="f">Nő</label><br>
            <label for="box">Adatkezelési szabályzat elfogadása:<input type="checkbox" name="box" id="box"></label><br/>
            <input type="submit" name="signup" value="Regisztráció"><br>    
        </form>

        <?php
            $errors = [];

            if(isset($_POST["signup"])){
                // Profilkép feltöltése
                if(isset($_FILES['profile-pic']['tmp_name']) && !empty($_FILES['profile-pic']['tmp_name'])) {
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["profile-pic"]["name"]);

                    // Kiterjesztés ellenőrzése
                    $kiterjesztes = strtolower(pathinfo($_FILES["profile-pic"]["name"], PATHINFO_EXTENSION));
                    if (!in_array($kiterjesztes, ['jpg', 'jpeg', 'png'])) {
                        $errors[] = "Csak JPG, JPEG és PNG formátumú képek engedélyezettek.";
                    }
                    
                    // Méret ellenőrzése
                    if ($_FILES["profile-pic"]["size"] > 31457280) {
                        $errors[] = "A fájl mérete nem lehet nagyobb 30 MB-nál.";
                    }

                    if(move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $target_file)) {
                        $profile_pic = $target_file;
                    } else {
                        $errors[] = "Hiba történt a kép feltöltésekor.";
                    }
                } else {
                    $profile_pic = "img/default_profile.jpg"; // Alapértelmezett kép
                }

                
                
                $user = $_POST["username"];
                $pass = $_POST["password"];
                $pass2 = $_POST["password2"];
                $nev = $_POST["nev"];
                $szulev = $_POST["szulev"];
                $age = $_POST["age"];
                $gender = $_POST["gender"];

                $user_data = [
                    'username' => $user,
                    'password' => $pass,
                    'nev' => $nev,
                    'szulev' => $szulev,
                    'age' => $age,
                    'gender' => $gender,
                    'profile_pic' => $profile_pic
                ];

                // Kor ellenőrzése
                if($age <= 0) {
                    $errors[] = "A kor nem lehet 0 vagy annál kisebb szám.";
                }
                
                // Ha nincs hiba, mentés
                if (count($errors) === 0) {
                    saveUser($conn, $user_data);
                    if(!empty($user_data['profile_pic'])) {
                        // Ha van feltöltött profilkép, akkor azt beállítjuk a $_SESSION változóban
                        $_SESSION['user']['profile_pic'] = $user_data['profile_pic'];
                    }
                 
                    // update
                    updateUserProfile($conn, $user, $pass, $profile_pic);
                    
                    // Elmentjük a felhasználó adatait a session-be
                    $_SESSION['user'] = $user_data;

                    sleep(3);

                    // Átirányítás
                    header('Location: index.php');
                    exit();

                 } else {
                    // Hibák megjelenítése
                    echo "<ul>";
                    foreach ($errors as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                    echo "</ul>";
                 }
            }
        ?>
    </section>
</div>

<?php include "footer.php";?>
</html>