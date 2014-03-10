<?php
class Database
{
    private static $dbName = 'github' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'dbrootpass';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
    public function setAction($action, $parentId, $parentType)
    {
        $sql = 'SELECT * FROM `mobidev_github_likes`
                WHERE `mobidev_github_likes`.`parent_id`="'.$parentId .'"'.
                ' AND `mobidev_github_likes`.`parent_type`="' . $parentType .'"'.
                ' ORDER BY like_id DESC';
       // $query = self::$cont->query($sql);
        $query = self::$cont->prepare($sql);
        $query->execute();
        $row = $query->fetch();
        if (!$row and  $action == 'like') {
            $sql = 'INSERT INTO `mobidev_github_likes` (parent_id, parent_type)
                    VALUES ("'.$parentId.'","'.$parentType.'")';
            $insert = self::$cont->prepare($sql);
            $insert->execute();
            return true;
        } elseif($row and  $action == 'unlike') {
            $sql = 'DELETE FROM `mobidev_github_likes` WHERE `mobidev_github_likes`.`like_id` ="' . $row['like_id'] . '"';
            $delete = self::$cont->prepare($sql);
            $delete->execute();
            return true;
        } else {
            return false;
        }
    }
    public function isLaked($parentType, $parentId)
    {
        $sql = 'SELECT * FROM `mobidev_github_likes`
                WHERE `mobidev_github_likes`.`parent_id`="'.$parentId .'"'.
                ' AND `mobidev_github_likes`.`parent_type`="' . $parentType .'"'.
                ' ORDER BY like_id DESC';
       // $query = self::$cont->query($sql);
        $query = self::$cont->prepare($sql);
        $query->execute();
        $row = $query->fetch();
        if ($row) {
            return true;
        }
        return false;
    }
}

