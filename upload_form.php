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
                    <li><a href="index.php" class="menu-item">Asztro fotók</a></li>
                    <li><a href="amateur.php" class="menu-item">Információk érdeklődőknek</a></li>
                    <li><a href="egyesulet.php" class="menu-item">Egyesületi élet</a></li>
                    <li><a href="login.php" class="menu-item">Bejelentkezés</a></li>
                    <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                    <li><a href="upload_form.php" class="menu-item active">Asztrofotó beküldés</a></li>
                    <li><a href="contact.php" class="menu-item">Kapcsolat</a></li>
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

        <form action="upload_form.html" method="post" enctype="multipart/form-data" autocomplete="off">
            
            <label for="nev">Név: <input type="text" name="nev" class="input-field" id="nev"></label>
            <br/>
            <label for="fotodatum">Mikor készült a kép?: <input type="date" name="fotodatum" id="fotodatum"></label>
            <br/>
            <label for="email">E-mail-cím: <input type="email" name="email" placeholder="James@Webb.com" id="email"></label>
            <br/>
            <label for="mob">Mobilszám: <input type="tel" name="mob" id="mob"></label>
            <br/>
            <label for="file">Fájl feltöltés: <input type="file" name="file" id="file"></label>
            <br/>
            <label for="kategoriak"></label>
            <br/>
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
            <br/>
            <label for="kep-cime">A kép címe: <input type="text" name="kep-cime" maxlength="50" id="kep-cime"></label>
            <br/>
            <br/>
            <div class="form-section">
                <fieldset>
                    <legend>Mikor készült a fotó?</legend>
                    <label for="tavasz">Tavasz<input type="radio" name="evszakok" value="tavasz" id="tavasz"></label>
                    <label for="nyar">Nyár<input type="radio" name="evszakok" value="nyar" id="nyar"></label>
                    <label for="osz">Ősz<input type="radio" name="evszakok" value="osz" id="osz"></label>
                    <label for="tel">Tél<input type="radio" name="evszakok" value="tel" id="tel"></label>
                </fieldset>
            </div>
            <br/>
            <label for="box">Adatkezelési szabályzat elfogadása:<input type="checkbox" name="box" id="box"></label>
            <br/>
            <br/>
            <input type="reset" name="reset" value="Visszaállítás" class="button-interaction">
            <br/>
            <input type="submit" name="submit" value="Beküldés" class="button-interaction">
            <br/>
        </form>
    </div>
<?php include "footer.php"?>
</body>
</html>