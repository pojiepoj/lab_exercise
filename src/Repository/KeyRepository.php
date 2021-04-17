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
                id = ?;
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

    public function findhistory($keyvalue, $timestamp)
    {
        $statement = "
            SELECT 
                id, firstname, lastname, firstparent_id, secondparent_id
            FROM
                person;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
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

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE person
            SET 
                firstname = :firstname,
                lastname  = :lastname,
                firstparent_id = :firstparent_id,
                secondparent_id = :secondparent_id
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'firstname' => $input['firstname'],
                'lastname'  => $input['lastname'],
                'firstparent_id' => $input['firstparent_id'] ?? null,
                'secondparent_id' => $input['secondparent_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }    

}