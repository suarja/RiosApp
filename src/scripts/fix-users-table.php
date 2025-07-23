<?php
// Script pour corriger la table users

require "vendor/autoload.php";

// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$DB_HOST = $_SERVER['DB_HOST'] ?? null;
$DB_PORT = $_SERVER['DB_PORT'] ?? null;
$DB_NAME = $_SERVER['DB_NAME'] ?? null;
$DB_USER = $_SERVER['DB_USER'] ?? null;
$DB_PASSWORD = $_SERVER['DB_PASSWORD'] ?? null;

try {
    $dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connexion à Railway MySQL réussie!\n\n";
    
    // Vérifier la structure actuelle
    $result = $pdo->query("DESCRIBE users");
    $columns = $result->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('username', $columns)) {
        // Ajouter la colonne username si elle n'existe pas
        $pdo->exec("ALTER TABLE users ADD COLUMN username VARCHAR(255) UNIQUE AFTER id");
        echo "✅ Colonne 'username' ajoutée\n";
        
        // Mettre à jour les utilisateurs existants avec un username temporaire basé sur l'email
        $pdo->exec("UPDATE users SET username = SUBSTRING_INDEX(email, '@', 1) WHERE username IS NULL");
        echo "✅ Usernames temporaires créés pour les utilisateurs existants\n";
    } else {
        echo "✅ Colonne 'username' existe déjà\n";
    }
    
    echo "\n🎉 Table users mise à jour avec succès!\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}