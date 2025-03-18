<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'professeur') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eleve_id = $_POST['eleve_id'];
    $matiere_id = $_POST['matiere_id'];
    $note = $_POST['note'];

    $conn = connect_to_database();

    // Ajout de la note
    $stmt = $conn->prepare("INSERT INTO Notes (eleve_id, matiere_id, note, date) VALUES (?, ?, ?, CURDATE())");
    $stmt->bind_param("iid", $eleve_id, $matiere_id, $note);
    $stmt->execute();

    echo "<p>Note ajoutée avec succès !</p>";

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Professeur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Espace Professeur</h1>
    </header>
    <main>
        <section id="saisie-notes">
            <h2>Saisir des notes</h2>
            <form action="professeur.php" method="post">
                <label for="eleve">Élève :</label>
                <select id="eleve" name="eleve_id" required>
                    <?php
                    $conn = connect_to_database();

                    // Récupération des élèves
                    $result = $conn->query("SELECT id, nom, prenom FROM Utilisateurs WHERE role = 'eleve'");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>";
                    }

                    $conn->close();
                    ?>
                </select>
                <label for="matiere">Matière :</label>
                <select id="matiere" name="matiere_id" required>
                    <?php
                    $conn = connect_to_database();

                    // Récupération des matières
                    $result = $conn->query("SELECT id, nom FROM Matieres");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
                    }

                    $conn->close();
                    ?>
                </select>
                <label for="note">Note :</label>
                <input type="number" step="0.01" id="note" name="note" required>
                <button type="submit">Ajouter la note</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Gestion des Notes</p>
    </footer>
</body>
</html>
