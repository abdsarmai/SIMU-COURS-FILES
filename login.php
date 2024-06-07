<?php
session_start();

$servername = "localhost";
$username = "admindev";
$password = "latech94@cours";
$dbname = "utilisateurs";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];

    // Vérifier les identifiants
    $sql = "SELECT id FROM users WHERE identifiant = '$identifiant' AND mdp = '$mdp'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentification réussie, rediriger vers l'étape 1
        $_SESSION['identifiant'] = $identifiant;
        header("Location: step1.php");
        exit();
    } else {
        // Identifiants incorrects, rediriger vers la page de connexion
        header("Location: index.php");
        exit();
    }
}
?>

