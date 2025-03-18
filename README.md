# Pronote

# Description
Ce projet est une application web clé en main simple pour la gestion des notes des élèves, inspirée de Pronote. Elle permet aux administrateurs de créer et gérer les professeurs, les élèves, les classes, et les matières. Les professeurs peuvent saisir des notes, et les élèves peuvent consulter leurs notes et leur moyenne.

# Fonctionnalités
Administrateur : Gérer les utilisateurs (professeurs, élèves) et les matières.
Professeur : Saisir des notes pour les élèves.
Élève : Consulter ses notes et sa moyenne.
Prérequis
Serveur web (Apache, Nginx, etc.)
PHP 7.0 ou supérieur
MySQL

# Installation

# Étape 1 : Configuration de la base de données
Créez une base de données nommée gestion_notes.
Importez le schéma de la base de données en exécutant le script SQL pronote.sql.

# Étape 2 : Création de l'utilisateur administrateur
Exécutez la requête SQL suivante pour créer un utilisateur administrateur :

INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, role)
VALUES ('Admin', 'Admin', 'admin@example.com', 'password', 'admin');

Remarque : Pour des raisons de sécurité, il est recommandé de hacher les mots de passe avant de les stocker dans la base de données. Utilisez password_hash() en PHP pour hacher les mots de passe.

# Étape 3 : Configuration du projet
Clonez ce dépôt ou téléchargez les fichiers du projet.
Placez les fichiers dans le répertoire racine de votre serveur web (par exemple, htdocs pour XAMPP ou www pour WAMP).
Assurez-vous que le fichier db_connect.php contient les bonnes informations de connexion à votre base de données.


# Étape 4 : Accéder à l'application
Ouvrez votre navigateur et accédez à http://localhost/votre-repertoire-projet.
Connectez-vous avec les identifiants de l'administrateur :
Email : admin@example.com
Mot de passe : password

# Utilisation
Administrateur : Ajoutez des professeurs, des élèves, et des matières via l'interface admin.
Professeur : Connectez-vous pour saisir des notes pour les élèves.
Élève : Connectez-vous pour consulter vos notes et votre moyenne.

# Contribution
Les contributions sont les bienvenues ! N'hésitez pas à proposer des améliorations ou à signaler des bugs.
