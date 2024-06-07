<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étape 3</title>
    <script>
        function confirmerEnvoi() {
            // Afficher une boîte de dialogue de confirmation
            var confirmation = confirm("Êtes-vous sûr de vouloir envoyer les informations ?");

            // Rediriger vers la page step4.php si l'utilisateur confirme
            if (confirmation) {
                window.location.href = "index.php";
            }
        }
    </script>
</head>
<body>
    <link rel="stylesheet" href="style.css">
<div class="container">
<header>Étape 3 : Informations du client et fichiers téléchargés</header>


<?php
$servername = "localhost";
$username = "admindev";
$password = "latech94@cours";
$dbname = "latech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM adh ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h3>Informations du client :</h3>";
    echo "<p><strong>Nom :</strong> " . $row["nom"] . "</p>";
    echo "<p><strong>Prénom :</strong> " . $row["prenom"] . "</p>";
    echo "<p><strong>Date de naissance :</strong> " . $row["date_de_naissance"] . "</p>";
    echo "<p><strong>Adresse postale :</strong> " . $row["adresse_postale"] . "</p>";
    echo "<p><strong>Code postal :</strong> " . $row["code_postal"] . "</p>";
    echo "<p><strong>Adresse e-mail :</strong> " . $row["adresse_mail"] . "</p>";
} else {
    echo "Aucune information sur le client trouvée.";
}

$conn->close();
?>

<br>

<h3>Fichiers téléchargés :</h3>
<ul>
    <?php
    $dir = "uploads/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != ".." && strpos($file, $row["nom"]) !== false) {
                    echo "<li><a href='$dir$file' target='_blank'>$file</a></li>";
                }
            }
            closedir($dh);
        }
    }
    ?>
</ul>

<br>



<!-- Bouton pour passer à l'étape suivante avec confirmation -->
<form>
    <input type="button" class="submit special-color" value="Envoyer" onclick="confirmerEnvoi()">
</form>
</div>
</body>
</html>

