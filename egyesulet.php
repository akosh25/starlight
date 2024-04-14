<?php  
session_start();
include "functions.php";  
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Egyesületek</title>
    <meta name="author" content="Starlight team" />
    <meta name="description" content="egyesuleti infok" />
    <meta name="keywords" content="egyesulet" />
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
                <li><a href="egyesulet.php" class="menu-item active">Egyesületi élet</a></li>
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
    <input type="checkbox" id="toggle">
    <div class="container container">

        <div id="header">
        <h1 id="astro-title">Csillagászati Egyesületek</h1>
        <br />
        <article>
            Ha valakit érdekel a csillagászat közzöségi szinten, minden lista elején <br>
            a Magyar Csillagászati Egyesület (<a href="https://www.mcse.hu/" target="_blank">MCSE</a>) szerepel, jó okkal. Ez hazánk legrégebbi és legnagyobb <br>
            ilyen témájú egyesülete, számos helyi csoporttal, remek közösségi programokkal. <br>
            Érdemes is keresni a lehetőséget a személyes találkozásra, mert sokszor sokkal egyszerűbb <br>
            így megoldani a hobbi elkezdésével felmerülő kérdéseket, leginkább a távcső és <br>
            mechanika beállításával kapcsolatos problémákat, amik rendszerint felmerülnek, hiszen nem <br>
            feltétlenül magától értetődő ezeknek az összetett műszereknek a megfelelő használata. <br>
            Legnagyobb program minden évben rendszerint a nyári tábor, ahol manapság már több száz érdeklődő <br>
            szokott összegyűlni néhány napra, amiből általában legalább néhány derült éjszaka szokott adódni a közös csillagászkodásra, <br>
            eszmecserére és egyéb programokra. <br>
            <img src="img/MCSE_logo.png" alt="mcse logo" class="picture2" />
            <img src="img/mcse_tabor.jpg" alt="tábori életkép" class="picture2" /><br>

            Másik, mára már országos méretű egyesület a Vega Csillagászati Egyesület (<a href="http://vcse.hu//" target="_blank">VCSE</a>), <br>
            amely erediteleg egy zalaegerszegi egyesületként indult, de mára már az egész országban vannak tagjai, <br>
            többek között Szegeden és külföldön is. Szintén szerveznek nyári táborokat, amelyek kisebb létszámmal<br>
            családiasabb hangulatban, és talán sötétebb ég alatt szoktak zajlani, ég állapotától függetlenül jó hangulattal. <br>
            Utóbbi években Ausztriában is rendszeressé váltak "expedíciók", illetve több észlelőhétvége is egy évben, <br>
            amelyek általában Zalaegerszeg közelében kerülnek megrendezésre. <br>
            <img src="img/austria1.jpg" alt="életkép" class="picture2">
            <img src="img/VEGA.jpg" alt="vega logo" class="picture2" />
            <img src="img/ausztria2.jpg" alt="életkép" class="picture2"><br>

            Szegeden pedig utóbbi években lett ismét aktívabb az MCSE alatt futó Szegedi Helyi Csoport (<a href="https://szegedicsillagaszok.hu/" target="_blank">SZHCS</a>), <br>
            mely nagy múltra tekint vissza, hiszen több, ma intézetvezető csillagászprofeszor is tagja volt.<br>
            Szoros összefonódásban van az SZTE-vel, hiszen központja a Szegedi Csillagvizsgáló, <br>
            és amatőr- és szakcsillagászok együtt tartanak bemutatót, nyáron hullócsillaglest, és egyre inkább rendszeressé <br>
            váló közös csillagleseket. <br>
            <img src="img/szhcs.JPG" alt="életkép" class="picture2">
            <img src="img/szhcs2.JPG" alt="életkép" class="picture2"> <br>

            Választék tehát van bőven, akit érdekel a csillagászat és szeretne hasonló érdeklődésű <br>
            emberekkel találkozni, vegye fel a kapcsolatot valamelyik egyesülettel a fenti linkeken. <br>



        </article>
    
        <br>
    
        </div>
    </div>
<?php include "footer.php"?>
</body>
</html>