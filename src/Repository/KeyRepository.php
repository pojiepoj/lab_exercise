<?php
namespace Src\Repository;

class KeyRepository {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $statement = "
            SELECT 
                mykey, value, timestamp
            FROM
                master_key;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($keyvalue)
    {
        $statement = "
            SELECT 
                mykey, value, timestamp
            FROM
                master_key   
            WHERE 
                mykey = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($keyvalue));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function checkKeyExist($input) 
    {
        $statement = "
            SELECT 
                mykey
            FROM
                master_key
            WHERE
                mykey = ?;
        ";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($input));                     
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }        
    }

    public function insert(Array $input)
    {        
        $statement = "
            INSERT INTO master_key 
                (mykey, value, timestamp)
            VALUES
                (:mykey, :value, :timestamp);
        ";

        try {
            $timestamp = new \DateTime();
            $time['timestamp'] = $timestamp->format('U');
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'mykey' => $input['mykey'],
                'value'  => $input['value'],
                'timestamp' => $time['timestamp'],               
            ));
            
            return array_merge($input,$time);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }    

    public function update(Array $input)
    {        
        $statement = "
            UPDATE master_key 
            SET 
                value = :value,
                timestamp  = :timestamp
            WHERE 
                mykey = :mykey;
        ";

        try {
            $timestamp = new \DateTime();
            $time['timestamp'] = $timestamp->format('U');
            
            $statement = $this->db->prepare($statement);
            
            $statement->execute(array(
                'mykey' => $input['mykey'],
                'value' => $input['value'],
                'timestamp'  => $time['timestamp'],
            ));
            
            return array_merge($input,$time);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }    

    public function insertHistory($keyvalue)
    {
        $res = $this->find($keyvalue);

        $statement = "
        INSERT INTO key_history 
            (mykey, value, timestamp)
        VALUES
            (:mykey, :value, :timestamp);
        ";
        try{
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'mykey' => $res[0]['mykey'],
                'value'  => $res[0]['value'],
                'timestamp' => $res[0]['timestamp'],               
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        } 
    }

    public function getKeyHistory($keyvalue,$timestamp)
    {
        $statement = "
            SELECT 
                mykey, value, timestamp
            FROM
                key_history   
            WHERE 
                mykey = :mykey 
            AND
                timestamp = :timestamp;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'mykey' => $keyvalue,
                'timestamp' => $timestamp,   
            ));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

}