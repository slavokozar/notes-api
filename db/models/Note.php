<?php
class Note
{
    protected static $table = 'notes';

    public $id = null;
    public $title = null;
    public $text = null;
    public $created_at = null;
    public $updated_at = null;

    public function __construct($data = null)
    {
        if($data != null){
            $this->title = $data['title'];
            $this->text = $data['text'];
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = $this->created_at;

            $this->save();

            return $this;
        }

    }


    /**
     * updates note based on it's id
     *
     * @param integer $id - id of the note to update
     */
    public function save()
    {
        if($this->id == null){
            $query = "
                INSERT
                INTO `".static::$table."` (`title`,`text`,`created_at`,`updated_at`)
                VALUES (?, ?, ?, ?) 
            ";

            $statement = db::getPDO()->prepare($query);

            $statement->execute([$this->title, $this->text, $this->created_at, $this->updated_at]);

            $this->id = db::getPDO()->lastInsertId();
        }else{
            $query = "
                UPDATE `".static::$table."` 
                SET `title` = ?, `text` = ?, `updated_at` = ?
                WHERE `id` = ?
            ";

            $statement = db::getPDO()->prepare($query);

            $this->updated_at = date('Y-m-d H:i:s');
            $statement->execute([$this->title, $this->text, $this->updated_at, $this->id]);
        }
    }

    /**
     * returns $this->text but formatted so that newlines
     * and HTML code are preserved
     */
    public function getFormattedText()
    {
        $text = $this->text;

        // format the copy
        // ...

        // preserve HTML
        $text = htmlspecialchars($text);

        $text = nl2br($text);

        return $text;
    }

    public function toString()
    {
        return json_encode($this);
    }

    public static function all($limit = null, $offset = null, $order_by = 'created_at', $order_type = 'asc')
    {
        $pdo = db::getPDO();


        // 2. write the query
        $query = "
            SELECT *
            FROM `".static::$table."`
            ORDER BY `".$order_by."` ".$order_type."
        ";

        if($limit != null){
            $limit = intval($limit);
            $query .= "
                LIMIT {$limit}
            ";
        }

        if($offset != null){
            $offset = intval($offset);
            $query .= "
                OFFSET {$offset} 
            ";
        }


        // 3. write the query
        $statement = $pdo->prepare($query);


        // 4. execute the query and get the result
        $statement->execute();


        $statement->setFetchMode(PDO::FETCH_CLASS, 'note');

        // 5. return the result
        return $statement->fetchAll();
    }

    /**
    * retrieves and returns one note based on it's id
    *
    * if the note is not found, returns null
    * @param integer $id - id of the note to retrieve
    * @return object(note) - the retrived note or null
    */
    public static function find($id)
    {
        $pdo = db::getPDO();

        // 2. write the query
        $query = "
            SELECT *
            FROM `".static::$table."`
            WHERE `id` = ?
        ";

        // 3. write the query
        $statement = $pdo->prepare($query);

        // 4. execute the query and get the result
        $statement->execute([$id]);

        // makes any fetching fetch objects
        // $statement->setFetchMode(PDO::FETCH_OBJ);

        $statement->setFetchMode(PDO::FETCH_CLASS, 'note');

        // 5. return the result
        return $statement->fetch();
    }

    /**
     * deletes note based on it's id
     *
     * if the note is not found, returns null
     * @param integer $id - id of the note to delete
     */
    public static function delete($id)
    {
        // 2. write the query
        $query = "
            DELETE
            FROM `notes`
            WHERE `id` = ?
        ";

        // 3. write the query
        $statement = db::getPDO()->prepare($query);

        // 4. execute the query and get the result
        $statement->execute([$id]);
    }
}
