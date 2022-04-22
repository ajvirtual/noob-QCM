<?php
namespace Library;

class PDOFactory {
    public static function getMysqlConnection() {
       try{
            $db = new \PDO('mysql:host=localhost;dbname=myblog', 'root', '');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 

            return $db;
            
       } catch(\PDOException $e) {
            $e->getMessage();
            exit();
       }
    }
}
?>