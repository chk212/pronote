<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = connect_to_database();

    // Vérification des identifiants
    $stmt = $conn->prepare("SELECT id, role FROM Utilisateurs WHERE email = ? AND mot_de_passe = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin.php");
        } elseif ($user['role'] === 'professeur') {
            header("Location: professeur.php");
        } elseif ($user['role'] === 'eleve') {
            header("Location: eleve.php");
        }
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
    </header>
    <main>
        <form action="login.php" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2023 Gestion des Notes</p>
    </footer>
</body>
</html>
