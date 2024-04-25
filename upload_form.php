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
    <title>Asztrofotó beküldés</title>
    <meta name="author" content="Starlight team" />
    <meta name="description" content="Feltöltési formula" />
    <meta name="keywords" content="asztrofotók" />
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
                    <li><a href="egyesulet.php" class="menu-item">Egyesület</a></li>
                    <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                    <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                        <?php else: ?>
                        <?php if($user !== null && $user['role'] !== 'admin'): ?>
                            <li><a href="profile.php">Felhasználó</a></li>
                        <?php else: ?>
                            <li><a href="admin.php">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="upload_form.php" class="menu-item active">Asztrofotó beküldés</a></li>
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
        <h1>Asztrofotó beküldés</h1>
        <h3 id="form-title">Kérjük töltse ki a következő űrlapot!</h3>
        <div class="audio-container">
            <audio controls>
                <source src="audio/smooching.mp3" type="audio/mpeg"/>
                <span>A böngésződ nem támogatja a hanglejátszást.</span>
            </audio>
            <p class="audio-description">🎵 Az űrlap kitöltéséhez hangulatzene indítását javasoljuk. 🎵</p>
        </div>

        <form action="upload_form.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <label for="nev">Név: <input type="text" name="nev" id="nev"></label>
            <br>
            <label for="fotodatum">Mikor készült a kép?: <input type="date" name="fotodatum" id="fotodatum"></label>
            <br>
            <label for="email">E-mail-cím: <input type="email" name="email" placeholder="James@Webb.com" id="email"></label>
            <br>
            <label for="mob">Mobilszám: <input type="tel" name="mob" id="mob"></label>
            <br>
            <label for="kategoriak">Válassz kategóriát:</label>
            <select name="kategoriak" id="kategoriak">
                <option value="valasz">Válasz kategóriát</option>    
                <option value="csillagok">Csillagok és csillagképek</option>    
                <option value="holdak">Holdak és bolygók</option>    
                <option value="kodok">Galaxisok és ködök</option>    
                <option value="meteorok">Meteorok és meteorzáporok</option>    
                <option value="tajkep">Asztrofotós tájképek</option>  
                <option value="timelapse">Asztrofotós timelapsek</option>  
            </select>
            <br>
            <label for="kep-cime">A kép címe: <input type="text" name="kep-cime" maxlength="50" id="kep-cime"></label>
            <br>
            <div class="form-section">
                <fieldset>
                    <legend>Mikor készült a fotó?</legend>
                    <label for="tavasz">Tavasz<input type="radio" name="evszakok" value="tavasz" id="tavasz"></label>
                    <label for="nyar">Nyár<input type="radio" name="evszakok" value="nyar" id="nyar"></label>
                    <label for="osz">Ősz<input type="radio" name="evszakok" value="osz" id="osz"></label>
                    <label for="tel">Tél<input type="radio" name="evszakok" value="tel" id="tel"></label>
                </fieldset>
            </div>
            <br>
            <label for="box">Adatkezelési szabályzat elfogadása:<input type="checkbox" name="box" id="box"></label>
            <br>
            <br>
            <label for="file">Fájl feltöltés: <input type="file" name="file" id="file"></label>
            <br>
            <br>
            <input type="reset" name="reset" value="Visszaállítás" class="button-interaction">
            <br>
            <input type="submit" name="submit" value="Beküldés" class="button-interaction">
            <br>
        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['kep-cime'];
        $image = file_get_contents($_FILES['file']['tmp_name']);
        $user_id = $_SESSION["user"]["id"];

        // Adatbázis kapcsolat
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ellenőrizd az e-mail cím formátumát
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Hibás e-mail formátum";
            exit; 
        }

        // Ellenőrizd a mobilszám hosszát
        $mob = $_POST['mob'];
        if (!preg_match('/^[+-]?[0-9]{7,15}$/', $mob)) {
            echo "Hibás mobilszám formátum";
            exit; 
        }

        // Fájl feltöltése és adatbázisba mentése
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            echo "Hiba történt a fájl feltöltésekor: " . $_FILES['file']['error'];
        } else {
            $stmt = $conn->prepare("INSERT INTO photos (user_id, title, image) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $title, $image);

            if ($stmt->execute()) {
                echo "A kép sikeresen feltöltve.";
            } else {
                echo "Hiba történt a kép feltöltésekor: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();
    }
    ?>

<?php include "footer.php"?>
</body>
</html>