<?php
    $accounts = [
        [
            "username" => "joe",
            "password" => "123",
            "age" => 30,
            "gender" => "m"
        ],

        [
            "username" => "jill",
            "password" => "456",
            "age" => 33,
            "gender" => "f"
        ]
    ];
    $errors = [];
        

    if(isset($_POST["signup"])){
        
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $pass2 = $_POST["password2"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];


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

        if(count($errors) === 0){
            echo "Sikeres regisztráció! <br>";
        }
        else{
            foreach($errors as $error){
                echo $error . "<br>";
            }
        }
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
                    <li><a href="index.php" class="menu-item">Asztro fotók</a></li>
                    <li><a href="amateur.php" class="menu-item">Információk érdeklődőknek</a></li>
                    <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                    <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item active">Regisztráció</a></li>
                    <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
                    <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
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
        <?php
        if(isset($_POST["signup"])) {
            if(empty($errors)) {
                echo "<p>Sikeres regisztráció!</p>";
            } else {
                foreach($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
        ?>
    
    </form>
    </section>

</body>
<?php include "footer.php";?>
</html>
