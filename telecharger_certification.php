<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête pour obtenir le chemin du fichier PDF
    $sql = "SELECT chemin_pdf FROM certifications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    if ($result && file_exists($result['chemin_pdf'])) {
        $filepath = $result['chemin_pdf'];
        $filename = basename($filepath);

        // Headers nécessaires pour le téléchargement de fichier
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Nettoyer le tampon de sortie
        ob_clean();

        // Lire le fichier pour le téléchargement
        readfile($filepath);
        exit;
    } else {
        echo "Fichier non trouvé.";
    }
}
?>
