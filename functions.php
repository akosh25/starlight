<?php
//mySQL
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "starlight"; 

// mySQL kapcsolat
$conn = new mysqli($servername, $username, $password, $dbname);

// sikeres-e a kapcsolat
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás: " . $conn->connect_error);
}

function loadUser($conn, $username){
    $felhasznalo = null;
    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // A felhasználó létezik
        $felhasznalo = $result->fetch_assoc();
    } else {
        // A felhasználó nem létezik
        $felhasznalo = null;
    }

    return $felhasznalo;
}

function saveUser($conn, $user){
    $username = $user['username'];
    $password = $user['password'];
    $nev = $user['nev'];
    $szulev = $user['szulev'];
    $age = $user['age'];
    $gender = $user['gender'];
    $role = $user['role'];
    $profile_pic = $user['profile_pic'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, nev, szulev, age, gender, profile_pic) 
           VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $username, $hashed_password, $nev, $szulev, $age, $gender, $profile_pic);

    if ($stmt->execute()) {
        echo "Sikeres regisztráció!";
    } else {
        echo "Hiba történt a regisztráció során: " . $stmt->error;
    }
}

function updateUserBirthdate($conn, $username, $newBirthdate) {
    // empty check
    if(empty($username) || empty($newBirthdate)) {
        return false;
    }

    // date check
    if(!strtotime($newBirthdate)) {
        return false; 
    }

    $sql = "UPDATE users SET szulev = ? WHERE username = ?";

    $stmt = $conn->prepare($sql);

    if($stmt === false) {
        return false;
    }

    $formattedDate = date('Y-m-d', strtotime($newBirthdate));

    $stmt->bind_param("ss", $formattedDate, $username);

    $success = $stmt->execute();

    // success check
    if($success) {
        return true; 
    } else {
        return false; 
    }
}

function updateUserProfile($conn, $username, $newPassword, $newProfilePic) {
    // empty check
    if(empty($username) || (empty($newPassword) && empty($newProfilePic))){
        return false;
    }

    // password check
    if(!empty($newPassword)) {
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $username);
        $success = $stmt->execute();
        if(!$success) {
            return false;
        }
    }

    // profile pic update
    if(!empty($newProfilePic)) {
        $sql = "UPDATE users SET profile_pic = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newProfilePic, $username);
        $success = $stmt->execute();
        if(!$success) {
            return false;
        }
    }

    // role update
    if(!empty($newRole)) {
        $sql = "UPDATE users SET role = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newRole, $username);
        $success = $stmt->execute();
        if(!$success) {
            return false;
        }
    }

    return true;
}

function banUser($conn, $username) {
    // admin-e?
    $sql = "SELECT role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['role'] !== 'admin') {
            // ha nem admin akkor tiltjuk:
            $sql = "UPDATE users SET banned = 1 WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
        } else {
            // ha admin akkor nem tiltható
            echo "Adminisztrátorokat nem lehet letiltani.";
        }
    } else {
        //a felhasználó nincs az adatbázisban
        echo "Hiba történt a felhasználó keresésekor.";
    }
}

function unbanUser($conn, $username) {
    // Tiltás visszavonása
    $sql = "UPDATE users SET banned = 0 WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
}

function loadAllUsers($conn) {
    $users = array();

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    return $users;
}

function sendMessage($conn, $sender_username, $receiver_username, $message) {
    // üzenet tárolása az adatbázisban
    $sql = "INSERT INTO messages (sender_username, receiver_username, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $sender_username, $receiver_username, $message);
    
    if ($stmt->execute()) {
        return true; // sikeres üzenetküldés
    } else {
        return false; // sikertelen üzenetküldés
    }
}

function getMessages($conn, $username) {
    $messages = array();

    // Lekérdezzük az üzeneteket, amelyeket a felhasználó kapott
    $sql = "SELECT * FROM messages WHERE receiver_username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    return $messages;
}

function loadUserPhotos($conn, $username) {
    $photos = array();

    // Felhasználó azonosítása az username alapján
    $user_id_query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($user_id_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Lekérdezzük az összes fotót az adott felhasználóhoz tartozó user_id alapján
        $sql = "SELECT * FROM photos WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $photos[] = $row;
            }
        }
    }

    return $photos;
}
?>