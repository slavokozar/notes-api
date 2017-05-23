<?php

// db library
class db
{
    // connection to DB
    protected static $pdo = null;

    protected function __construct()
    {
        //Thou shalt not construct that which is unconstructable!
    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    // purpose: get PDO object
    public static function getPDO()
    {
        if(static::$pdo === null)
        {
            include '../config.php'; // includes $secret_password
            
            // 1. connect to the database
            // 'mysql:dbname=database_name;host=localhost;charset=utf8'
            try 
            {
                $dsn = 'mysql:dbname='.$db_database.';host='.$db_host.';port='.$db_port.';charset=utf8';

                $pdo = new PDO(
                    $dsn,
                    $db_username,
                    $db_password
                );
            } 
            catch (PDOException $e) 
            {
                echo 'Connection failed: ' . $e->getMessage();
            }

            // set level of error reporting
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // put the created PDO connection into static property
            static::$pdo = $pdo;
        }

        return static::$pdo;
    }

//    /**
//    * retrieves and returns one note based on it's id
//    *
//    * if the note is not found, returns null
//    * @param integer $note_id - id of the note to retrieve
//    * @return object(note) - the retrived note or null
//    */
//    public static function get_note($note_id)
//    {
//        $pdo = static::getPDO();
//
//        // 2. write the query
//        $query = "
//            SELECT *
//            FROM `notes`
//            WHERE `id` = ?
//        ";
//
//        // 3. write the query
//        $statement = $pdo->prepare($query);
//
//        // 4. execute the query and get the result
//        $statement->execute([$note_id]);
//
//        // makes any fetching fetch objects
//        // $statement->setFetchMode(PDO::FETCH_OBJ);
//
//        $statement->setFetchMode(PDO::FETCH_CLASS, 'note');
//
//        // 5. return the result
//        return $statement->fetch();
//    }
//
//    public static function get_all_notes()
//    {
//        $pdo = static::getPDO();
//
//        // 2. write the query
//        $query = "
//            SELECT *
//            FROM `notes`
//        ";
//
//        // 3. write the query
//        $statement = $pdo->prepare($query);
//
//        // 4. execute the query and get the result
//        $statement->execute();
//
//        $statement->setFetchMode(PDO::FETCH_CLASS, 'note');
//
//        // 5. return the result
//        return $statement->fetchAll();
//    }
//
//    public static function get_notes($limit = 10, $offset = 0, $order_by = 'created_at', $order_way = 'asc')
//    {
//        // create the SQL string for ORDER BY direction (ASC or DESC)
//        switch(strtolower($order_way))
//        {
//            default:
//            case 'asc': $order_way_sql = "ASC"; break;
//            case 'desc': $order_way_sql = "DESC"; break;
//        }
//
//        // create the SQL string for ORDER BY clause
//        switch($order_by)
//        {
//            default:
//            case 'created_at':
//                $order_by_sql = "ORDER BY `notes`.`created_at` ".$order_way_sql;
//                break;
//            case 'title':
//                $order_by_sql = "ORDER BY `notes`.`title` ".$order_way_sql;
//                break;
//            case 'id':
//                $order_by_sql = "ORDER BY `notes`.`id` ".$order_way_sql;
//                break;
//        }
//
//        // write the query
//        $query = "
//      SELECT `notes`.*
//      FROM `notes`
//      WHERE 1
//      ".$order_by_sql."
//      LIMIT :offset, :limit
//    ";
//
//        // connect to database
//        $pdo = static::getPDO();
//
//        // prepare the query
//        $statement = $pdo->prepare($query);
//
//        // bind values of $limit and $offset
//        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
//        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
//
//        // execute the query and get the result
//        $statement->execute();
//
//        // set the type of objects that fetching should return
//        $statement->setFetchMode(PDO::FETCH_CLASS, 'note');
//
//        // return the result
//        return $statement->fetchAll();
//    }
//
//    public static function delete_note($note_id)
//    {
//        // 2. write the query
//        $query = "
//            DELETE
//            FROM `notes`
//            WHERE `id` = ?
//        ";
//
//        // 3. write the query
//        $statement = static::getPDO()->prepare($query);
//
//        // 4. execute the query and get the result
//        $statement->execute([$note_id]);
//    }
}