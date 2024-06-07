<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "admindev";
    $password = "latech94@cours";
    $dbname = "latech";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nom = $_POST["nom"];
    $_SESSION['nom_famille'] = $nom;  // Stocker le nom de famille dans la session
    $prenom = $_POST["prenom"];
    $date_de_naissance = $_POST["date_de_naissance"];
    $adresse_postale = $_POST["adresse_postale"];
    $code_postal = $_POST["code_postal"];
    $adresse_mail = $_POST["adresse_mail"];

    $sql = "INSERT INTO adh (nom, prenom, date_de_naissance, adresse_postale, code_postal, adresse_mail) 
            VALUES ('$nom', '$prenom', '$date_de_naissance', '$adresse_postale', '$code_postal', '$adresse_mail')";

    if ($conn->query($sql) === TRUE) {
        echo "Les informations du formulaire de step1 ont été enregistrées avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement des informations du formulaire de step1: " . $conn->error;
    }

    $conn->close();

    // Redirection vers step2.php
    header("Location: step2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de connexion</title>
    <link rel="stylesheet" action="step1.php" type="text/css" href="./style.css">

</head>
<body>
    <div class="container">	  
      <div class="form-outer">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="page slide-page">
                  <header>Étape 1 : </header>
            <div class="title">Informations sur l'adhérent:</div>
		<div class="field">
              <div class="label">Nom de famille:</div>
            <input type="text" name="nom" id="nom" required>
            </div>
        <div class="field">
              <div class="label">Prénom:</div>
            <input type="text" name="prenom" id="prenom" required>
            </div>
	<div class="field">
              <div class="label">Date de naissance:</div>
            <input type="date" name="date_de_naissance" id="date_de_naissance" required>
            </div>
	<div class="field">
              <div class="label">Adresse postale:</div>
            <input type="text" name="adresse_postale" id="adresse_postale" required>
            </div>
	<div class="field">
              <div class="label">Code postale:</div>
            <input type="text" name="code_postal" id="code_postal" required>
            </div>
	<div class="field">
              <div class="label">Adresse e-mail:</div>
            <input type="mail" name="adresse_mail" id="adresse_mail" required>
            </div>
            <div class="field">
              <button class="firstNext next">Suivant</button>
            </div>
          </div>
        </form>
    </div>
</body>
</html>

