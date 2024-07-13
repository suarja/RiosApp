<?php
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

class Database
{
    private $pdo;
    public function __construct($dsn, $user, $password)
    {
        $this->pdo = new PDO($dsn, $user, $password);
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
