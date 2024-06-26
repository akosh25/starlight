﻿<?php  
session_start();
include "functions.php";  
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Információk amatőröknek</title>
    <meta name="author" content="Starlight team" />
    <meta name="description" content="hasznos információk" />
    <meta name="keywords" content="amatőr" />
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
                <li><a href="amateur.php" class="menu-item active">Infók</a></li>
                <li><a href="egyesulet.php" class="menu-item">Egyesület</a></li>
                <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
                <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])): ?>
                        <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                        <?php else: ?>
                        <?php $user = loadUser($conn, $_SESSION["user"]["username"]);
                          if($user !== null && $user['role'] !== 'admin'): ?>
                            <li><a href="profile.php">Felhasználó</a></li>
                        <?php else: ?>
                            <li><a href="admin.php">Admin</a></li>
                        <?php endif; ?>
                        <li><a href="upload_form.php" class="menu-item">Asztrofotó beküldés</a></li>
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

        <div id="content">
        <h1 id="astro-title">Hasznos információk  az amatőrcsillagászat iránt érdeklődőknek</h1>
        <br />
        <div>
            <h2 id="elso">Mi kell az égi objektumok megfigyeléséhez?</h2>
            <p>               
                <img src="img/telescope.jpg" alt="telescope" class="picture2" />
              <br>
                A puszta szemmel történő nézelődéstől a nagytávcsöves CCD-észlelésig számtalan fokozat létezik. <br> 
                A legtöbb amatőr birtokában ott a binokulár és a kisebb-nagyobb távcső, de számos <br>
                égi jelenség szabad szemmel látható legjobban (pl. meteorrajok, sarki fény, állatövi fény). <br>
                A különböző távcsövek más és más objektumok megfigyelésére optimálisak. Ebben nemcsak a távcső átmérője, <br>
                hanem típusa, optikai minősége és még sok egyéb tényező játszik szerepet.
            </p>
            <article>              
             
                
                <h2>Távcsövek típusai és főbb jellemzőik</h2>
                <table>
                    <tr>
                        <th id="tipus">Típus</th>
                        <th id="jellemzok">Jellemzők</th>
                        <th id="elony">Előny</th>
                        <th id="hatrany">Hátrány</th>
                        <th id="foto">Fotózáshoz</th>
                        <th id="celpontok">Főbb célpontok</th>
                      </tr>
                      <tr>
                        <td headers="tipus">akromatikus refraktorok</td>
                        <td headers="jellemzok">5–20 cm, <br>f/5–f/15</td>
                        <td headers="elony">Kis méretben ideális mobil műszer</td>
                        <td headers="hatrany">Növekvő fényerővel/átmérővel zavaró színi hiba</td>
                        <td headers="foto">Kellenek hozzá színi hibát csökkentő szűrők, képsík-korrektorok</td>
                        <td headers="celpontok">Fényerőtől függően: nagy kiterjedésű mélyégobjektumoktól a bolygókig</td>
                      </tr>
                      <tr>
                        <td headers="tipus">apokromatikus refraktorok</td>
                        <td headers="jellemzok">6–20 cm, <br>f/5–f/8–10</td>
                        <td headers="elony">Kis méretben ideális mobil műszer. <br>Színi hibától mentes, kontrasztos képezés.</td>
                        <td headers="hatrany">Nagyon magas ár</td>
                        <td headers="foto">Kell hozzá képsík-korrektor, fotográfiai szűrők</td>
                        <td headers="celpontok">Fényerőtől függően: nagy kiterjedésű mélyégobjektumoktól a bolygókig</td>
                      </tr>
                      <tr>
                        <td headers="tipus">fényerős Newton-reflektorok</td>
                        <td headers="jellemzok">10–50 cm, <br>f/4–f/5</td>
                        <td headers="elony">Nagyobb átmérőknél óriási fénygyűjtő képesség. A nyitott tubus miatt gyorsan átveszi a környezet hőmérsékletét.</td>
                        <td headers="hatrany">Nagy méreténél nehéz és költséges mechanika. A tükör gyakrabban tisztítandó.</td>
                        <td headers="foto">Drága kómakorrektor.</td>
                        <td headers="celpontok">Ideális latványos objektumokhoz, fotózáshoz, nagy látómezőjű megfigyeléshez.</td>
                      </tr>
                      <tr>
                        <td headers="tipus">közepes Newton-reflektorok</td>
                        <td headers="jellemzok">15–30 cm, <br>f/6–f/10</td>
                        <td headers="elony">Általános célú, jól használható műszerek, színihibamentes képezéssel.</td>
                        <td headers="hatrany">Hosszabb fókusztávú a tubus kényelmetleneül hosszú lehet.</td>
                        <td headers="foto">Drága kómakorrektor.</td>
                        <td headers="celpontok">Általános célú, minden észlelési területre bevehető.</td>
                      </tr>
                      <tr>
                        <td headers="tipus">Cassegrain-reflektorok</td>
                        <td headers="jellemzok">15-40 cm, <br>f/12-f/20</td>
                        <td headers="elony">Kompakt műszerek.</td>
                        <td headers="hatrany">Nagy látómező nehezen érhető el.</td>
                        <td headers="foto">Ideális nagy nagyítást igénylő észlelésekhez.</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td headers="tipus">Schmidt-Cassegrain-távcsövek</td>
                        <td headers="jellemzok">10–40 cm, <br>f/8-f/10</td>
                        <td headers="elony">Kompakt, univerzális, nagy teljesítményű műszerek.</td>
                        <td headers="hatrany">Jelentős a segédtükör kitakarása (kontrasztot csökkenti), és könnyen párásodik.</td>
                        <td headers="foto">Hasonló méretű Newtonokhoz képest jelentősen magasabb ár.</td>
                        <td headers="celpontok">Általános célú típus, kivéve az igazán nagy látómezőjű megfigyeléseket.</td>
                      </tr>
                      <tr>
                        <td headers="tipus">Makszutov-Cassegrain-távcsövek</td>
                        <td headers="jellemzok">8-30 cm, <br>f/12-f/15</td>
                        <td headers="elony">Kompakt, univerzális műszerek.</td>
                        <td headers="hatrany">Jelentős a segédtükör kitakarása, korrekciós lencse párásodása.</td>
                        <td headers="foto">Hasonló méretű Newtonokhoz képest jelentősen magasabb ár.</td>
                        <td headers="celpontok">Nagy látómező elérése nehezen megoldható.</td>
                      </tr>
                      <tr>
                        <td headers="tipus">Makszutov-Newton-távcsövek</td>
                        <td headers="jellemzok">12-25 cm, <br>f/5-f/10</td>
                        <td headers="elony">Univerzális műszerek. <br> Jól korrigált látómező.</td>
                        <td headers="hatrany">Newtonnál magasabb ár.</td>
                        <td headers="foto">Ideális asztrofotós műszer.</td>
                      </tr>
                </table>               
                <p>Táblázat forrása: Magyar Csillagászati Egyesület - Amatőrcsillagászok kézikönyve 2023</p>
                
                

            </article>
        </div>
         
        </div>
      
<?php include "footer.php"?>
</div>
</body>
</html>