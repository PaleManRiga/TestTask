 <?php

    require_once 'database.php';

    class User
    {
        private $conn;

        public function __construct()
        {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runQuery($sql)
        {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }


        // insert
        public function insert($email){
            try {
                $stmt = $this->conn->prepare("INSERT INTO crud_users (email) VALUES(:email)");
                $stmt->bindparam(":email", $email);
                $stmt->execute();
                return $stmt;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        // update

        public function update($email, $id){
            try{
                $stmt = $this->conn->prepare("UPDATE crud_users SET email = :email WHERE id = :id");
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        }


        // delete

        public function delete($id){
            try{
                $stmt = $this->conn->prepare("DELETE FROM crud_users WHERE id = :id");
                $stmt->bindparam(":id", $id);
                return $stmt;
            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        // redirect

        public function redirect($url){
            header("Location: $url");
        }
    }



    ?>