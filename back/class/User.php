<?php
class User
{
    private $conn;

    public $username;
    public $password;
    public $email;
    public $hash;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Function for user register
     *
     * @return mixed
     */

    public function register()
    {
        try {
            $sql = "INSERT INTO `users` (user_name, user_password, user_email, user_hash, user_created) VALUES (:username, :password, :email, :hash, :created);";
            $query = $this->conn->prepare($sql);

            $string = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";

            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $this->hash = substr(str_shuffle($string), 0, 12);
            $this->created = date('Y-m-d H:i:s');

            $query->bindParam(":username", $this->username);
            $query->bindParam(":password", $this->password);
            $query->bindParam(":email", $this->email);
            $query->bindParam(":hash", $this->hash);
            $query->bindParam(":created", $this->created);
            $query->execute();

            return $query;
        } catch(PDOException $exception) {
            echo "SQL Error: ".$exception->getMessage();
        }
    }

    /**
     * Function for user login
     *
     * @param $username
     * @param $email
     * @param $password
     * @return bool
     */

    public function login($username, $email, $password)
    {
        try {
            $sql = 'SELECT user_name, user_password, user_email, user_hash FROM users WHERE user_name = :username OR user_email = :email LIMIT 1';
            $query = $this->conn->prepare($sql);
            $query->bindParam(":username", $username);
            $query->bindParam(":email", $email);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() > 0) {
                if(password_verify($password, $row['user_password'])) {
                    setcookie('crud_cookie', $row['user_hash'], time() + 31556926, '/');

                    return true;
                } else {
                    return false;
                }
            }
        } catch(PDOException $exception) {
            echo "SQL Error: ".$exception->getMessage();
        }
    }
}