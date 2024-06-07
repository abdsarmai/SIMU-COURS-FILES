<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">

<header>Données saisies dans la base de données :</header>
<?php
$servername = "192.168.1.71";
$username = "admindev";
$password = "latech94@cours";
$dbname = "latech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM adh";
$result = $conn->query($sql);

$dir = "uploads/";
$files = [];
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                $files[] = $file;
            }
        }
        closedir($dh);
    }
}

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse postale</th>
                <th>Code postal</th>
                <th>Adresse e-mail</th>
                <th>Fichiers téléversés</th>
                <th>Actions</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["nom"]."</td>
                <td>".$row["prenom"]."</td>
                <td>".$row["date_de_naissance"]."</td>
                <td>".$row["adresse_postale"]."</td>
                <td>".$row["code_postal"]."</td>
                <td>".$row["adresse_mail"]."</td>
                <td>";
        foreach ($files as $file) {
            if (strpos($file, $row["nom"]) !== false || strpos($file, $row["prenom"]) !== false) {
                echo "<a href='$dir$file' target='_blank'>$file</a><br>";
            }
        }
        echo "</td>
                <td><a href='delete.php?id=".$row["id"]."'>Supprimer</a></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Aucune donnée trouvée dans la base de données.";
}

$conn->close();
?>

<form action="logout.php" method="post">
    <input type="submit" value="Déconnexion" class="submit special-color">
</form>
</div>
</body>
</html>
