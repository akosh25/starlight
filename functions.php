<?php
//mySQL
$servername = "localhost";
$username = "root"; 
$password = "starlight25+"; 
$dbname = "starlight"; 

// mySQL kapcsolat
$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrzés, hogy sikeres-e a kapcsolat
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

function updateUserProfile($conn, $username, $newPassword, $newProfilePic, $newRole) {
    // empty check
    if(empty($username) || (empty($newPassword) && empty($newProfilePic) && empty($newRole))) {
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
    // Ellenőrizzük, hogy a felhasználó nem admin
    $sql = "SELECT role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['role'] !== 'admin') {
            // Ha a felhasználó nem admin, akkor tiltjuk
            $sql = "UPDATE users SET banned = 1 WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
        } else {
            // Ha a felhasználó admin, nem végezzük el a tiltást
            echo "Adminisztrátorok nem tiltásra kerülhetnek.";
        }
    } else {
        // Ha a felhasználó nem található az adatbázisban, hibát jelzünk
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
?>