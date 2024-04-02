<?php
include 'connect.php';

$sql = "SELECT * FROM certifications";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$certifications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Affichage des Certifications</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h2>Liste des Certifications</h2>
    <a href="index.html" class="btn-add">Ajouter une nouvelle certification</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Certification</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($certifications as $certification): ?>
            <tr>
                <td><?= htmlspecialchars($certification['nom']) ?></td>
                <td><?= htmlspecialchars($certification['prenom']) ?></td>
                <td><?= htmlspecialchars($certification['certification']) ?></td>
                <td>
                    <a href="modifier_certification.php?id=<?= $certification['id'] ?>">Modifier</a> |
                    <a href="supprimer_certification.php?id=<?= $certification['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette certification ?');">Supprimer</a> |
                    <a href="telecharger_certification.php?id=<?= $certification['id'] ?>">Télécharger</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
