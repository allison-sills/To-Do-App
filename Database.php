<?php

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = 'password')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }

    public function update($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        // Bind parameters to the statement
        foreach ($params as $key => $value) {
            $this->statement->bindValue($key, $value);
        }

        $this->statement->execute();

        return $this;
    }

}