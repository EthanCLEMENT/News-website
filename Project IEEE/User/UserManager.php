<?php 
// interact with database : add users, update user...
class UserManager{
    private $db;

    public function __construct(){
        $dbName = "blog";
        $port = "3306";
        $username = "root";
        $password = "root";
        try {
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port", $username, $password));
        }catch(PDOException $error){
            echo $error->getMessage();
        } 
    }
    public function setDb($db){
        $this->db = $db;
        return $this;
    }

    public function add(User $user){
        $req = $this->db->prepare("INSERT INTO `user` (username, pwd, email) VALUES (:username, :pwd, :email)");

        $req->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $req->bindValue(":pwd", $user->getPwd(), PDO::PARAM_STR);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $req->execute();
    }

    public function update(User $user){
        $req = $this->db->prepare("UPDATE `user` SET username = :username, pwd = :pwd, email = :email WHERE id = :id");

        $req->bindValue(":id", $user->getId(), PDO::PARAM_INT);
        $req->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $req->bindValue(":pwd", $user->getPwd(), PDO::PARAM_INT);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_INT);

        $req->execute();
    }

    public function get(int $id){
        $req = $this->db->prepare("SELECT * FROM `user` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $datas = $req->fetch();
        $user = new User($datas);
        return $user;
    }

    public function getAll(): array{
        $users = [];
        $req = $this->db->query("SELECT * FROM `User`");
        $req->execute();

        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $users[] = new User($data);
        }
        return $users;
    }

    public function delete(int $id): void{
        $req = $this->db->prepare("DELETE FROM `User` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
