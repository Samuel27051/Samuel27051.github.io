<?php
// Zobrazenie chýb
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Konfigurácia pripojenia k databáze
$host = 'localhost'; 
$dbname = 'my_database'; 
$username = 'root'; 
$password = ''; 

// Pripojenie k databáze
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Získanie údajov z formulára
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password']; // Ukladáme heslo bez hashovania

// Uloženie údajov do databázy
try {
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
    $stmt->execute([
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':email' => $email,
        ':password' => $password, // Uloženie hesla bez hashovania
    ]);
    echo "<h1>Registrácia úspešná!</h1>";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

