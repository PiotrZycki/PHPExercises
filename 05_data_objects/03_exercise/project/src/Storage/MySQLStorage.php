<?php

namespace Storage;

use PDO;
use PDOException;
use Concept\Distinguishable;
use Storage\Storage;

class MySQLStorage extends DatabaseStorage
{
    //private static PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "test", "test123");
        parent::__construct();
    }
}
