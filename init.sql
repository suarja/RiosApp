-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create players table (already in Database.php but good to have here)
CREATE TABLE IF NOT EXISTS players (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create indexes for better performance
CREATE INDEX idx_players_name ON players(name);
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_users_email ON users(email);