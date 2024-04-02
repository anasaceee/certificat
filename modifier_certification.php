<?php
include 'connect.php';

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données existantes pour cet ID
    $sql = "SELECT * FROM certifications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $certification = $stmt->fetch();

    // Vérifier si le formulaire de modification a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $certification = $_POST['certification'];

        // Mettre à jour la base de données
        $sql = "UPDATE certifications SET nom = ?, prenom = ?, certification = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $certification, $id]);

        // Rediriger vers l'affichage des certifications
        header('Location: afficher_certifications.php');
        exit;
    }
} else {
    echo "Certification non trouvée.";
    exit;
}

?>

<!-- Formulaire de modification pré-rempli -->
<!DOCTYPE html>
<html>
<head>
    <title>Modifier Certification</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Modifier Certification</h2>
    <form method="post">
        Nom: <input type="text" name="nom" value="<?php echo $certification['nom']; ?>"><br>
        Prenom: <input type="text" name="prenom" value="<?php echo $certification['prenom']; ?>"><br>
        Certification: <input type="text" name="certification" value="<?php echo $certification['certification']; ?>"><br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
