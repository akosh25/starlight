<?php  
session_start();
include "functions.php";  

//user check
if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

// Tiltás gomb 
if(isset($_POST['ban_user'])) {
// van-e felhasználónév
if(isset($_POST['username'])) {
    $username_to_ban = $_POST['username'];
    // tiltunk
    banUser($conn, $username_to_ban);
    // eltároljuk a tiltást üzenetben
    $_SESSION['ban_message'] = "A felhasználó sikeresen le lett tiltva.";
} else {
    // oldal újratöltése 
    header("Location: admin.php");
    exit();
}
} else if(isset($_POST['unban_user'])) { // tiltás visszavonása
// van-e felhasználónév
if(isset($_POST['username'])) {
    $username_to_unban = $_POST['username'];
    // visszavonjuk a tiltást
    unbanUser($conn, $username_to_unban);
    // oldal újratöltése
    header("Location: admin.php");
    exit();
} else {
    // hibajelentés
    echo "Hiba: Nem sikerült megadni a tiltás visszavonandó felhasználónevet.";
}
}

$user = loadUser($conn, $_SESSION["user"]["username"]);

// admin?
if($user !== null && $user['role'] !== 'admin') {
    // ha nem:
    header("Location: profile.php");
    exit();
}

// a user létezik és van profilképe
if($user !== null && !empty($user['profile_pic'])) {
    // profilkép beállítása
    $_SESSION['user']['profile_pic'] = $user['profile_pic'];
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Keződőoldal</title>
    <meta name="author" content="Starlight team">
    <meta name="description" content="Bejelentkezés">
    <meta name="keywords" content="csillagok, asztrofotók, bolygók">
    <link rel="icon" href="logo/comet.jpg">
    <link rel="stylesheet" href="style/style.css">
    <style>

        .profile-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-info th {
            background-color: #f2f2f2;
        }
    </style>
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
                        <li><a href="login.php" class="menu-item active">Bejelentkezés</a></li>
                        <li><a href="register.php" class="menu-item">Regisztráció</a></li>
                        <?php else: ?>
                        <?php if($user !== null && $user['role'] !== 'admin'): ?>
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

    <div class="profile">
    <table class="profile">
        <tr>
            <th>Saját adatok</th>
            <th>Felhasználók</th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Felhasználónév:</td>
                        <td><?=$_SESSION["user"]["username"]?></td>
                    </tr>
                    <tr>
                        <td>Név:</td>
                        <td><?=$_SESSION["user"]["nev"]?></td>
                    </tr>
                    <tr>
                        <td>Jelszó módosítása:</td>
                        <td>
                            <form action="update_profile.php" method="POST">
                                <label for="new_password">Új jelszó:</label>
                                <input type="password" id="new_password" name="new_password">
                                <input type="submit" value="Mentés">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Születési idő:</td>
                        <td><?=$_SESSION["user"]["szulev"]?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <form action="update_profile.php" method="POST">
                                <label for="new_birthdate">Új születési dátum:</label>
                                <input type="date" id="new_birthdate" name="new_birthdate">
                                <input type="submit" value="Mentés">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Profilkép:</td>
                        <td><img src="<?=$_SESSION['user']['profile_pic']?>" alt="Profilkép"></td>
                    </tr>
                    <tr>
                        <td>Profilkép módosítása:</td>
                        <td>
                            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                                <label for="new_profile_pic">Új profilkép kiválasztása:</label>
                                <input type="file" id="new_profile_pic" name="new_profile_pic">
                                <input type="submit" value="Mentés">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>Szerepkör:</td>
                        <td>
                            <?php 
                                if(isset($_SESSION["user"]["role"])) {
                                    if($_SESSION["user"]["role"] === "admin") {
                                        echo "Adminisztrátor";
                                    } else {
                                        echo "Felhasználó";
                                    }
                                } else {
                                    echo "Nincs meghatározva";
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <th>Felhasználónév</th>
                        <th>Profilkép</th>
                        <th>Szerepkör</th>
                        <th>Tiltás</th>
                        <th>Le van tiltva?</th>
                    </tr>
                    <?php
                    // felhasználók betöltése
                    $users = loadAllUsers($conn);

                    // felhasználói adatok listázása
                    foreach($users as $user) {  
                        echo "<tr>";
                        echo "<td>".$user['username']."</td>";
                        echo "<td><img src='".$user['profile_pic']."' alt='Profilkép' style='width: 50px; height: 50px; border-radius: 50%;'></td>"; 
                        echo "<td>".$user['role']."</td>";
                        echo "<td>";
                        echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='POST'>";
                        echo "<input type='hidden' name='username' value='" . $user["username"] . "'>";
                        if(isset($user['banned']) && $user['banned'] == 1) {
                            echo "<input type='submit' name='unban_user' value='Tiltás visszavonása'>";
                        } else {
                            echo "<input type='submit' name='ban_user' value='Tiltás'>";
                        }
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        if(isset($user['banned'])) {
                            echo ($user['banned'] == 1 ? "Igen" : "Nem");
                        };
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>
    <?php
    //törlés gomb
    echo '<form id="form-login" class="login-link" action="delete_user.php" method="POST">
    <input type="submit" name="btn-delete-user"  value="felhasználói fiók törlése">
    </form>';
    ?>
    <?php include "footer.php";?>
</body>
</html>