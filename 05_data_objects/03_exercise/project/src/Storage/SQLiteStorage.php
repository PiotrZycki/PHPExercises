<?php

namespace Storage;

use Config\Directory;
use PDO;
use PDOException;
use Concept\Distinguishable;
use Storage\Storage;

class SQLiteStorage extends DatabaseStorage
{
    private string $dbName = "db.sqlite";
    public function __construct()
    {
        $this->pdo = new PDO("sqlite:".Directory::storage().$this->dbName);
        parent::__construct();
    }
}
