<?php
session_start();

// Fonction pour rediriger lorsqu'un fichier est uploadé
function redirect($url) {
    header("Location: $url");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si des fichiers ont été téléchargés
    if (isset($_FILES['CNI']) && isset($_FILES['attestation']) && isset($_FILES['facture'])) {
        // Dossier de destination pour les fichiers téléchargés
        $uploadDir = './uploads/';

        // Récupération du nom de famille depuis la session
        if (isset($_SESSION['nom_famille'])) {
            $nom_famille = $_SESSION['nom_famille'];

            // Traitement de l'image
            $imageFileType = strtolower(pathinfo($_FILES['CNI']['name'], PATHINFO_EXTENSION));
            $imageDestination = $uploadDir . $nom_famille . "_CNI." . $imageFileType;

            // Traitement des fichiers PDF
            $pdf1Destination = $uploadDir . $nom_famille . "_Attestation.pdf";
            $pdf2Destination = $uploadDir . $nom_famille . "_Facture.pdf";

            // Vérification des types de fichiers
            $attestationFileType = strtolower(pathinfo($_FILES['attestation']['name'], PATHINFO_EXTENSION));
            $factureFileType = strtolower(pathinfo($_FILES['facture']['name'], PATHINFO_EXTENSION));

            if (($imageFileType === 'jpg' || $imageFileType === 'jpeg' || $imageFileType === 'png') &&
                $attestationFileType === 'pdf' &&
                $factureFileType === 'pdf') {

                // Déplacement des fichiers téléchargés
                $imageMoved = move_uploaded_file($_FILES['CNI']['tmp_name'], $imageDestination);
                $pdf1Moved = move_uploaded_file($_FILES['attestation']['tmp_name'], $pdf1Destination);
                $pdf2Moved = move_uploaded_file($_FILES['facture']['tmp_name'], $pdf2Destination);

                if ($imageMoved && $pdf1Moved && $pdf2Moved) {
                    // Rediriger vers step3.php en cas de succès
                    redirect('step3.php');
                } else {
                    echo "<script>alert('Erreur lors du téléchargement des fichiers. Veuillez réessayer.');</script>";
                }
            } else {
                echo "<script>alert('Type de fichier non valide. Seules les images JPEG/PNG et les fichiers PDF sont autorisés.');</script>";
            }
        } else {
            echo "<script>alert('Nom de famille introuvable dans la session.');</script>";
        }
    } else {
        echo "<script>alert('Veuillez sélectionner tous les fichiers à télécharger.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Télécharger des fichiers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
   <header>Étape 2 : </header>
    <div class="title">Télécharger des fichiers:</div>
    <div class="container">	  
      <div class="form-outer">
    <form method="post" enctype="multipart/form-data">
          <div class="page slide-page">
            <div class="field">
              <div class="label">CNI :</div>
              <input type="file" name="CNI" id="CNI" accept="image/jpeg, image/png" required>
            </div>
            <div class="field">
              <div class="label">Attestation:</div>
              <input type="file" name="attestation" id="attestation" accept=".pdf" required>
            </div>
            <div class="field">
              <div class="label">Quittance de loyer :</div>
              <input type="file" name="facture" id="facture" accept=".pdf" required>
            </div>
            <div class="field">
              <button class="firstNext next" onclick="history.back()">Retour</button>
              <button class="firstNext next">Télécharger</button>
            </div>
          </div>
        </form>
    </div>
</body>
</html>
