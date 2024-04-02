<?php
include 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM certifications WHERE id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: afficher_certifications.php");
}
?>