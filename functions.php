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
    $profile_pic = $_FILES['profile-pic']['name'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, nev, szulev, age, gender, profile_pic) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $username, $hashed_password, $nev, $szulev, $age, $gender);

    if ($stmt->execute()) {
        echo "Sikeres regisztráció!";
    } else {
        echo "Hiba történt a regisztráció során: " . $stmt->error;
    }
}

?>