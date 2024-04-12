<?php  
    session_start();
    include "kozos.php";

    if(isset($_SESSION["user"]) || !empty($_SESSION["user"])){
        header("Location: profile.php");
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
    <input type="checkbox" id="toggle">
    <div class="container container">
<section class="content">
    <form action="register.php" method="POST">
        <label>Felhasználónév: <input type="text" name="username"></label>
        <br>
        <label>Jelszó: <input type="password" name="password"></label>
        <br>
        <label>Jelszó ismét: <input type="password" name="password2"></label>
        <br>
        <label>Kor: <input type="number" name="age"></label>
        <br>
        <label>Profilkép: <input type="file" name="profile-pic"></label>
        <br>
        <label><input type="radio" name="gender" value="m">Férfi</label>
        <label><input type="radio" name="gender" value="f">Nő</label>
        <br>
        <label for="box">Adatkezelési szabályzat elfogadása:<input type="checkbox" name="box" id="box"></label>
        <br/>
        <input type="submit" name="signup" value="Regisztráció">
        <br>    
    </form>
    <?php
        $errors = [];
        

        if(isset($_POST["signup"])){
            
            $user = $_POST["username"];
            $pass = $_POST["password"];
            $pass2 = $_POST["password2"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $agreement = isset($_POST["box"]);
    
    
            foreach($accounts as $account){
                if($account["username"] === $user){
                    $errors[] = "A felhasználónév már foglalt!";
                }
            }
    
            if(strlen($pass) < 5){
                $errors[] = "A jelszó túl rövid!";
            }
    
            if(!preg_match('/[A-Za-z]/',$pass) || !preg_match('/[0-9]/', $pass)){
                $errors[] = "A jelszónak tartalmaznia kell betűt és számjegyet egyaránt!";
            }
    
            if($pass !== $pass2){
                $errors[] = "A két jelszó nem egyezik";
            }
    
            if($age < 12){
                $errors[] = "Csak 12 éves kor felett lehet regisztrálni";
            }
    
            if(!$agreement) {
                $errors[] = "Az adatkezelési tájékoztatót el kell fogadni a regisztrációhoz!";
            }
    
            if(count($errors) === 0){
                echo "Sikeres regisztráció! <br>";
            
                #új felhasználó adatai
            $data = [
                "username" => $user,
                "password" => hashPassword($pass),
                "age" => $age,
                "gender" => $gender,
            ];
    
            saveUser("felhasznalok.txt", $data);
        }
            else{
                foreach($errors as $error){
                    echo $error . "<br>";
                }
            }
        }
    ?>
    </section>

</body>
<?php include "footer.php";?>
</html>
