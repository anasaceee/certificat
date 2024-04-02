<?php
include 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $certification = $_POST['certification'];
    $sql = "INSERT INTO certifications (nom, prenom, certification) VALUES (?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $certification]);
    header("Location: afficher_certifications.php");
}
?>