<?php



class Database
{
    private $pdo;
    public function __construct(array $config)
    {
        $this->pdo = new PDO($config['dsn'], $config['user'], $config['password']);
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
        $keys = array_keys($data);
        $columns = implode(", ", $keys);
        $placeholders = ':' . implode(", :", $keys);

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

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

    public function isPlayerInDatabase($playerId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM players WHERE id = :id");
        $statement->execute(['id' => $playerId]);
        $player = $statement->fetch();
        return $player;
    }

    public function isPlayerInDatabaseFromName($playerName)
    {
        $statement = $this->pdo->prepare("SELECT * FROM players WHERE name = :name");
        $statement->execute(['name' => $playerName]);
        $player = $statement->fetch();
        return $player;
    }

    public function getPlayerFromName($playerName)
    {
        $statement = $this->pdo->prepare("SELECT * FROM players WHERE name = :name");
        $statement->execute(['name' => $playerName]);
        $statement = new Statement($statement);
        return $statement->fetch();
    }

    public function insertPlayer($player)
    {
        $sql = "INSERT INTO players (id, type, title_id, shard_id, clan_id, name, ban_type, patch_version, assets_json, matches_json, link_self, link_schema) VALUES (:id, :type, :title_id, :shard_id, :clan_id, :name, :ban_type, :patch_version, :assets_json, :matches_json, :link_self, :link_schema)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $player->id,
            'type' => $player->type,
            'title_id' => $player->attributes->titleId,
            'shard_id' => $player->attributes->shardId,
            'clan_id' => $player->attributes->clanId,
            'name' => $player->attributes->name,
            'ban_type' => $player->attributes->banType,
            'patch_version' => $player->attributes->patchVersion,
            'assets_json' => json_encode($player->relationships->assets),
            'matches_json' => json_encode($player->relationships->matches),
            'link_self' => $player->links->self,
            'link_schema' => $player->links->schema,
        ]);
    }

    public function updatePlayer($player)
    {
        $sql = "UPDATE players SET type = :type, title_id = :title_id, shard_id = :shard_id, clan_id = :clan_id, name = :name, ban_type = :ban_type, patch_version = :patch_version, assets_json = :assets_json, matches_json = :matches_json, link_self = :link_self, link_schema = :link_schema WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $player->id,
            'type' => $player->type,
            'title_id' => $player->attributes->titleId,
            'shard_id' => $player->attributes->shardId,
            'clan_id' => $player->attributes->clanId,
            'name' => $player->attributes->name,
            'ban_type' => $player->attributes->banType,
            'patch_version' => $player->attributes->patchVersion,
            'assets_json' => json_encode($player->relationships->assets),
            'matches_json' => json_encode($player->relationships->matches),
            'link_self' => $player->links->self,
            'link_schema' => $player->links->schema,
        ]);
    }

    public function deletePlayer($playerId)
    {
        $statement = $this->pdo->prepare("DELETE FROM players WHERE id = :id");
        $statement->execute(['id' => $playerId]);
    }

    public function getPlayers(
        $limit = 10,
        $offset = 0,
        $orderBy = 'created_at',
        $order = 'DESC'
    ) {
        $statement = $this->pdo->prepare("SELECT * FROM players ORDER BY $orderBy $order LIMIT $limit OFFSET $offset");
        $statement->execute();
        return $statement->fetchAll();
    }


    public function getPlayer($playerId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM players WHERE id = :id");
        $statement->execute(['id' => $playerId]);
        return $statement->fetch();
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

