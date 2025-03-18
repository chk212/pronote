<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom_matiere'])) {
        $nom_matiere = $_POST['nom_matiere'];

        $conn = connect_to_database();

        // Ajout de la matière
        $stmt = $conn->prepare("INSERT INTO Matieres (nom) VALUES (?)");
        $stmt->bind_param("s", $nom_matiere);
        $stmt->execute();

        echo "<p>Matière ajoutée avec succès !</p>";

        $stmt->close();
        $conn->close();
    } else {
        $role = $_POST['role'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = connect_to_database();

        // Ajout de l'utilisateur
        $stmt = $conn->prepare("INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nom, $prenom, $email, $password, $role);
        $stmt->execute();

        echo "<p>Utilisateur ajouté avec succès !</p>";

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Espace Admin</h1>
    </header>
    <main>
        <section id="gestion">
            <h2>Gestion des utilisateurs</h2>
            <form action="admin.php" method="post">
                <label for="role">Rôle :</label>
                <select id="role" name="role">
                    <option value="admin">Administrateur</option>
                    <option value="professeur">Professeur</option>
                    <option value="eleve">Élève</option>
                </select>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Ajouter</button>
            </form>

            <h2>Gestion des matières</h2>
            <form action="admin.php" method="post">
                <label for="nom_matiere">Nom de la matière :</label>
                <input type="text" id="nom_matiere" name="nom_matiere" required>
                <button type="submit">Ajouter</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Gestion des Notes</p>
    </footer>
</body>
</html>
