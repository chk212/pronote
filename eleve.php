<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'eleve') {
    header("Location: login.php");
    exit();
}

$eleve_id = $_SESSION['user_id'];

$conn = connect_to_database();

// Récupération des notes de l'élève
$stmt = $conn->prepare("
    SELECT m.nom AS matiere, n.note, n.date, u.nom AS prof_nom, u.prenom AS prof_prenom
    FROM Notes n
    JOIN Matieres m ON n.matiere_id = m.id
    LEFT JOIN ProfesseursMatieres pm ON m.id = pm.matiere_id
    LEFT JOIN Utilisateurs u ON pm.professeur_id = u.id
    WHERE n.eleve_id = ?
");
$stmt->bind_param("i", $eleve_id);
$stmt->execute();
$result = $stmt->get_result();

$notes = [];
$total_notes = 0;
$count_notes = 0;

while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
    $total_notes += $row['note'];
    $count_notes++;
}

$moyenne = $count_notes > 0 ? $total_notes / $count_notes : 0;

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Élève</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Espace Élève</h1>
    </header>
    <main>
        <section id="consultation-notes">
            <h2>Consulter vos notes</h2>
            <?php if (!empty($notes)): ?>
                <table border='1'>
                    <tr>
                        <th>Matière</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?php echo $note['matiere']; ?></td>
                            <td><?php echo $note['note']; ?></td>
                            <td><?php echo $note['date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <p>Moyenne des notes : <?php echo number_format($moyenne, 2); ?></p>
            <?php else: ?>
                <p>Aucune note disponible.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Gestion des Notes</p>
    </footer>
</body>
</html>
