    <link rel="stylesheet" type="text/css" href="style.css">
 <div class="container">
   
<?php
session_start();


if (isset($_GET['id'])) {
 $servername = "192.168.1.71";
$username = "admindev";
$password = "latech94@cours";
$dbname = "latech";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM adh WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $conn->error;
    }

    $conn->close();
} else {
    echo "Identifiant d'utilisateur non spécifié.";
}
?>
<form action="admin.php" method="post">
    <input type="submit" value="Retour" class="submit special-color">
</form>
<form action="logout.php" method="post">
    <input type="submit" value="Déconnexion" class="submit special-color">
</form>
</div>
