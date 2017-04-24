<?php
class Article
{
    private $conn;

    public $id;
    public $title;
    public $content;
    public $author;
    public $date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Function for article write
     *
     * @return mixed
     */

    public function write()
    {
        global $USER_ID;

        try {
            $sql = 'INSERT INTO `articles` (article_title, article_content, article_author, article_date) VALUES (:title, :content, :author, :date);';
            $query = $this->conn->prepare($sql);

            $this->title = trim($this->title);
            $this->content = trim($this->content);
            $this->author = $USER_ID;
            $this->date = date('Y-m-d H:i:s');

            $query->bindParam(":title", $this->title);
            $query->bindParam(":content", $this->content);
            $query->bindParam(":author", $this->author);
            $query->bindParam(":date", $this->date);
            $query->execute();

            return $query;
        } catch(PDOException $exception) {
            return "SQL Error: ".$exception->getMessage();
        }
    }

    /**
     * Function for article view
     *
     * @param $id
     * @return bool
     */

    public function view($id)
    {
        try {
            $sql = 'SELECT article_title, article_content, article_author, article_date FROM `articles` WHERE id = :article_id';
            $query = $this->conn->prepare($sql);
            $query->bindParam(":article_id", $id);
            $query->execute();

            return $query;
        } catch(PDOException $exception) {
            return "SQL Error: ".$exception->getMessage();
        }
    }

    /**
     * Function for article edit
     *
     * @param $id
     * @return string
     */

    public function fetch($id)
    {
        try {
            $sql = 'SELECT article_title, article_content FROM `articles` WHERE id = :id';
            $query = $this->conn->prepare($sql);

            $query->bindParam(":id", $id);
            $query->execute();

            return $query;
        } catch(PDOException $exception) {
            return "SQL Error: ".$exception->getMessage();
        }
    }

    /**
     * Function for article update
     *
     * @param $id
     * @param $title
     * @param $content
     * @return string
     */

    public function update($id, $title, $content)
    {
        try {
            $sql = 'UPDATE `articles` SET article_title = :title, article_content = :content WHERE id = :id';
            $query = $this->conn->prepare($sql);

            $query->bindParam(":id", $id);
            $query->bindParam(":title", $title);
            $query->bindParam(":content", $content);
            $query->execute();

            return $query;
        } catch(PDOException $exception) {
            return "SQL Error: ".$exception->getMessage();
        }
    }

    /**
     * Function for article delete
     *
     * @param $id
     * @return string
     */

    public function delete($id)
    {
        try {
            $sql = 'DELETE FROM `articles` WHERE id = :id';
            $query = $this->conn->prepare($sql);

            $query->bindParam(":id", $id);
            $query->execute();

            return $query;
        } catch(PDOException $exception) {
            return "SQL Error: ".$exception->getMessage();
        }
    }

    /**
     * Function for article listing
     *
     * @param $field
     * @param $ordering
     * @param $total
     * @return $query results
     */

    public function listing($field, $ordering, $total)
    {
        $sql = 'SELECT id, article_title, article_date, article_author FROM `articles` ORDER BY '.$field.' '.$ordering.' LIMIT '.$total;
        $query = $this->conn->prepare($sql);
        $query->execute();

        return $query;
    }
}