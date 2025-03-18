-- Table des utilisateurs
CREATE TABLE Utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('admin', 'professeur', 'eleve')
);

-- Table des classes
CREATE TABLE Classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

-- Table des matières
CREATE TABLE Matieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

-- Table des notes
CREATE TABLE Notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eleve_id INT,
    matiere_id INT,
    note DECIMAL(4, 2),
    date DATE,
    FOREIGN KEY (eleve_id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (matiere_id) REFERENCES Matieres(id)
);

-- Table pour associer les professeurs aux matières
CREATE TABLE ProfesseursMatieres (
    professeur_id INT,
    matiere_id INT,
    PRIMARY KEY (professeur_id, matiere_id),
    FOREIGN KEY (professeur_id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (matiere_id) REFERENCES Matieres(id)
);

-- Table pour associer les élèves aux classes
CREATE TABLE ElevesClasses (
    eleve_id INT,
    classe_id INT,
    PRIMARY KEY (eleve_id, classe_id),
    FOREIGN KEY (eleve_id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (classe_id) REFERENCES Classes(id)
);
