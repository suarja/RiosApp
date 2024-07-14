<?php

require "vendor/autoload.php";

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$DB_URL = $_SERVER['DB_URL'] ?? null;
$DB_USER = $_SERVER['DB_USER'] ?? null;
$DB_PASSWORD = $_SERVER['DB_PWD'] ?? null;
$DB_HOST = $_SERVER['DB_HOST'] ?? null;
$DB_PORT = $_SERVER['DB_PORT'] ?? null;
$DB_NAME = $_SERVER['DB_NAME'] ?? null;

if (!$DB_URL) {
    throw new Exception('No database URL provided. Please add a DB_URL to the .env file.');
} else if (!$DB_USER) {
    throw new Exception('No database user provided. Please add a DB_USER to the .env file.');
} else if (!$DB_PASSWORD) {
    throw new Exception('No database password provided. Please add a DB_PWD to the .env file.');
} else if (!$DB_HOST) {
    throw new Exception('No database host provided. Please add a DB_HOST to the .env file.');
} else if (!$DB_PORT) {
    throw new Exception('No database port provided. Please add a DB_PORT to the .env file.');
} else if (!$DB_NAME) {
    throw new Exception('No database name provided. Please add a DB_NAME to the .env file.');
}

$dsn = "mysql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME}";
class Database
{
    private $pdo;
    public function __construct($dsn, $user = "root", $password = "")
    {
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function query($sql)
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $statement = new Statement($statement);
        return $statement;
    }

    public function fetch($statement)
    {
        return $statement->fetch();
    }
    public function fetchAll($statement)
    {
        return $statement->fetchAll();
    }

    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = array_map(function ($value) {
            return is_numeric($value) ? $value : "'$value'";  // Enclose non-numeric values in single quotes
        }, array_values($data));
        $values = implode(", ", $values);
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }

    public function debugInsert()
    {
        $this->pdo->prepare('INSERT INTO users (name) VALUES ("Jason")')->execute();
        $users = $this->query('SELECT * FROM users')->fetchAll();
        dd($users);
    }

    public  function createPlayersTable()
    {
        /* CREATE TABLE IF NOT EXISTS players (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; */
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
        $this->pdo->exec($sql);
    }
}

class Statement
{
    private $statement;
    public function __construct($statement)
    {
        $this->statement = $statement;
    }
    public function fetch()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }
    public function fetchAll()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$db = new Database($dsn, $DB_USER, $DB_PASSWORD);
