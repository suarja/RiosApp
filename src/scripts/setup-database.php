<?php
// Script pour créer les tables nécessaires sur Railway

require "vendor/autoload.php";

// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$DB_HOST = $_SERVER['DB_HOST'] ?? null;
$DB_PORT = $_SERVER['DB_PORT'] ?? null;
$DB_NAME = $_SERVER['DB_NAME'] ?? null;
$DB_USER = $_SERVER['DB_USER'] ?? null;
$DB_PASSWORD = $_SERVER['DB_PASSWORD'] ?? null;

if (!$DB_HOST || !$DB_USER || !$DB_PASSWORD || !$DB_NAME) {
    die("Erreur: Variables de base de données manquantes dans .env\n");
}

try {
    $dsn = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connexion à Railway MySQL réussie!\n\n";
    
    // Créer la table users
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) UNIQUE NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    echo "✅ Table 'users' créée/vérifiée\n";
    
    // Créer la table players
    $sql = "CREATE TABLE IF NOT EXISTS players (
        id VARCHAR(255) PRIMARY KEY,
        type VARCHAR(50),
        title_id VARCHAR(255),
        shard_id VARCHAR(50),
        clan_id VARCHAR(255),
        name VARCHAR(255),
        ban_type VARCHAR(50),
        patch_version VARCHAR(50),
        assets_json TEXT,
        matches_json TEXT,
        link_self VARCHAR(255),
        link_schema VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    echo "✅ Table 'players' créée/vérifiée\n";
    
    // Créer les index (avec gestion d'erreur si déjà existants)
    try {
        $pdo->exec("CREATE INDEX idx_players_name ON players(name);");
        echo "✅ Index idx_players_name créé\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate key name') !== false) {
            echo "✅ Index idx_players_name existe déjà\n";
        } else {
            throw $e;
        }
    }
    
    try {
        $pdo->exec("CREATE INDEX idx_users_username ON users(username);");
        echo "✅ Index idx_users_username créé\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate key name') !== false) {
            echo "✅ Index idx_users_username existe déjà\n";
        } else {
            throw $e;
        }
    }
    
    try {
        $pdo->exec("CREATE INDEX idx_users_email ON users(email);");
        echo "✅ Index idx_users_email créé\n";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'Duplicate key name') !== false) {
            echo "✅ Index idx_users_email existe déjà\n";
        } else {
            throw $e;
        }
    }
    
    echo "\n🎉 Base de données configurée avec succès!\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur de connexion: " . $e->getMessage() . "\n";
    echo "\nVérifiez vos informations de connexion dans le fichier .env\n";
}