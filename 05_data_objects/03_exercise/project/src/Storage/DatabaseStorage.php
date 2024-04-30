<?php

namespace Storage;

use PDO;
use PDOException;
use Concept\Distinguishable;
use Storage\Storage;
use Config\Directory;

class DatabaseStorage implements Storage
{
    protected PDO $pdo;
    protected string $tableName = "objects";
    public function __construct()
    {
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function store(Distinguishable $distinguishable): void
    {
        $i = 0;
        $ser = serialize($distinguishable);
        //$sh = $this->pdo->prepare( "SHOW TABLES LIKE test");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->tableName(`key` VARCHAR(255) PRIMARY KEY, `data` TEXT)");

        //$this->pdo->exec("DELETE FROM test");
        $kk = $distinguishable->key();
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE `key`='$kk' ");
        //$result = $this->pdo->query($query);
        $row = $query->execute();
        //$rows = $result->query("SELECT COUNT(*) as count FROM USERIDS");
        //$row = $rows->fetchArray();
        //$numRows = $row['count'];
        //if(!$row || $query->rowCount()==0){
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName VALUES (:key, :data)");
        $statement->bindValue('key', $distinguishable->key());
        $statement->bindValue('data', $ser);
        $statement->execute();
        //}

        //if(!$query->execute()){

        //}
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {
        $dis = [];
        $query = $this->pdo->query("SELECT * FROM objects");
        if($query) {
            foreach ($query->fetchAll(PDO::FETCH_NUM)  as $f) {
                $unser = unserialize($f[1]);
                if(is_object($unser) && get_parent_class($unser) && get_parent_class($unser) == "Widget\Widget") {
                    $dis[] = $unser;
                }
            }
        }
        return $dis;
    }
}
