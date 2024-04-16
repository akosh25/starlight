<?php  
session_start();
include "functions.php";  
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Asztrofotók</title>
    <meta name="author" content="Starlight team" />
    <meta name="description" content="Kategóriák" />
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
                <li><a href="asztrofotok.php" class="menu-item active">Asztro fotók</a></li>
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
    <input type="checkbox" id="toggle">

    <div id="header">
        <h1 id="astro-title">Szegedi asztrofotók</h1>
        <br />
        <img src="img/stars.jpg" alt="csillag header" class="picture fadeInUpFirst" />
        
        <ul class="navigation">
            <li><a href="#elso">Csillagok és csillagképek</a></li>
            <li><a href="#masodik">Holdak és bolygók</a></li>
            <li><a href="#harmadik">Galaxisok és ködök</a></li>
            <li><a href="#negyedik">Meteorok és meteorzáporok</a></li>
            <li><a href="#otodik">Asztrofotós tájképek</a></li>
            <li><a href="#hatodik">Asztrofotós timelapsek</a></li>
        </ul>
    </div>
<div id="content">
    <h2 id="elso">Csillagok és csillagképek</h2>
    <p>
        A csillagok olyan hatalmas, forró, gázokból és plazmából álló égitestek, amelyek 
        saját fényt bocsátanak ki a termonukleáris reakciók során. 
        <br />
        A csillagképek olyan csoportok vagy alakzatok, amelyeket a csillagok képeznek az égbolton, 
        <br />
        és hagyományosan nevezzük őket egy adott formához vagy történethez kapcsolódóan.
        <br />
        <br />
        <img src="img/csillagok_01.jpg" alt="ustokos1" class="picture" />
        <img src="img/csillagok_02.jpg" alt="ustokos2" class="picture"/>
    </p>
    <h2 id="masodik">Holdak és bolygók</h2>
    <p>
        Holdnak nevezzük a bolygók, törpebolygók és kisbolygók körül keringő égitesteket.
        <br />
        A bolygók olyan égitestek, amelyek közvetlenül a Nap körül keringenek, 
        és a Nap fényét visszatükrözik.
        <br />
        <br />
        <img src="img/holdak_01.jpg" alt="bolygok1" class="picture" />
        <img src="img/holdak_02.jpg" alt="bolygok2" class="picture" />
    </p>
    <h2 id="harmadik">Galaxisok és ködök</h2>
    <p>
        A galaxisok hatalmas csillagrendszerek, amelyek milliárdnyi csillagból, 
        gázokból, porból és sötét anyagból állnak. 
        <br />
        A ködök olyan felhők, amelyek 
        gázokból és porból állnak, és a csillagok körül vagy a galaxisok között találhatók. 
        <br />
        A ködök lehetnek bolygóködök, csillagködök vagy galaxisködök.
        <br />
        <br />
        <img src="img/kod_01.jpg" alt="bolygok1" class="picture" />
        <img src="img/kod_02.jpg" alt="bolygok2" class="picture" />
    </p>
    <h2 id="negyedik">Meteorok és meteorzáporok</h2>
    <p>
        A meteorok apró aszteroidák vagy üstökösökből származó részecskék, 
        amelyek belépnek a Föld légkörébe, 
        <br />
        és fényes nyomot hagynak maguk után. Ezt nevezzük "csillaghullásnak". 
        <br />
        A meteorzáporok az égbolt olyan eseményei, amikor a Föld áthalad 
        <br />
        egy aszteroida vagy üstökös porszemcsék sűrű felhőjén, 
        és nagy számban megjelennek a meteorok.
        <br />
        <br />
        <img src="img/meteor_01.jpg" alt="bolygok1" class="picture" />
        <img src="img/meteor_02.jpg" alt="bolygok2" class="picture" />
    </p>
    <h2 id="otodik">Asztrofotós tájképek</h2>
    <p>
        Az asztrofotós tájképek olyan képek, amelyek az éjszakai égboltot és 
        az éjszakai tájat ötvözik művészi módon. 
        <br />
        <br />
        <img src="img/landscape_01.jpg" alt="bolygok1" class="picture" />
        <img src="img/landscape_02.jpg" alt="bolygok2" class="picture" />
    </p>
    <h2 id="hatodik">Asztrofotós timelapsek</h2>
    <p>
        A "timelapse" egy olyan filmmódszer, amely során 
        egy lassú időbeli folyamatot gyorsított sebességgel mutatnak be. 
        <br />
        <br />
        <video controls width="400" height="250">
            <source src="video/timelapse_chile.mp4" type="video/mp4">
            Sajnos a böngésző nem támogatja a videó lejátszását.
        </video>
    </p>
</div>

<div id="footer">
    <span id="source-title">Forrás:</span>
    <a href="https://en.wikipedia.org/wiki/Astrophotography" target="_blank">Wikipedia</a>
    <br />
    <br />
    Kulcsszavak: <b>Bolygók </b><b>Csillagok </b><b>Galaxisok </b><b>Meteorok </b><b>Asztrofotók </b>
</div>
<br>

</div>
<?php include "footer.php"?>
</body> 
</html>