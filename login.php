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

        

    if(isset($_POST["login"])){
        
        $user = $_POST["username"];
        $pass = $_POST["password"];

    $msg = "Sikertelen belépés!";

        foreach($accounts as $account){
            if($user === $account["username"] && $pass === $account["password"]){
                $msg = "Sikeres belépés";
                break;
            }
        }
        echo $msg . "<br>";
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
                    <li><a href="index.php" class="menu-item">Asztro fotók</a></li>
                    <li><a href="amateur.php" class="menu-item">Információk érdeklődőknek</a></li>
                    <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                    <li><a href="login.php" class="menu-item active">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item">Regisztráció</a></li>
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
    <form action="login.php" method="POST">
        <label>Felhasználónév: <input type="text" name="username"></label>
        <br>
        <label>Jelszó: <input type="password" name="password"></label>
        <br>
        <input type="submit" name="login" value="Bejelentkezés">
        <br>
        <?php
        if(isset($_POST["login"])) {
            if(empty($errors)) {
                echo "<p>Sikeres bejelentkezés!</p>";
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
