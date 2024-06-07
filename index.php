<div class="container">	  
      <div class="form-outer">
<?php

$servername = "192.168.1.71";
$username = "admindev";
$password = "latech94@cours";
$dbname = "latech";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];


    $sql = "SELECT identifiant, role FROM utilisateurs WHERE identifiant='$identifiant' AND mot_de_passe='$mot_de_passe'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row["role"] === "adh") {

            header("Location: step1.php");
            exit();
        } else if ($row["role"] === "admin") {

            header("Location: admin.php");
            exit();
        }
    } else {

        echo "Identifiant ou mot de passe incorrect";
    }
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de connexion</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
					  <img src="./images/logo.png" width="130px" height="130px"/>

    <div class="container">	  
      <div class="form-outer">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="page slide-page">
            <div class="title">Page de connexion:</div>
            <div class="field">
              <div class="label">Identifiant:</div>
              <input type="text" name="identifiant" id="identifiant" required>
            </div>
            <div class="field">
              <div class="label">Mot de passe:</div>
              <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            </div>
            <div class="field">
              <button class="firstNext next">Suivant</button>
            </div>
          </div>
        </form>
    </div>
</body>
</html>





