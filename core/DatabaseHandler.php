<?php

namespace core;

use PDO;
use PDOException;

class DatabaseHandler
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbname = DB_NAME;

    private \PDO $handler;
    private string $error;
    private false|\PDOStatement $statement;

    public function __construct()
    {
        $connection = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->handler = new PDO($connection, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($query): void
    {
        $this->statement = $this->handler->prepare($query);
    }

    public function bind($param, $value, $type = null): void
    {

        if(is_null($type))
        {
            switch(true) {
                case is_int ($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool ($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null ($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute(): bool
    {
        return $this->statement->execute();
    }

    public function resultSet(): bool|array
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(): bool|array
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function lastInsertId(): bool|string
    {
        return $this->handler->lastInsertId();
    }
}
