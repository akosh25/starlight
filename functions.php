<?php
//mySQL
$servername = "localhost";
$username = "root"; 
$password = "starlight25+"; 
$dbname = "starlight_db"; 

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
    if(empty($username) || (empty($newPassword) && empty($newProfilePic))) {
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

    return true;
}

?>