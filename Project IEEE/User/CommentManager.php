<?php 

class CommentManager{

    private $db;

    public function __construct(){
        $dbName = "blog";
        $port = "3306";
        $articlename = "root";
        $password = "root";

        try{
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port", $articlename, $password));
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }

    public function setDb($db){
        $this->db = $db;
        return $this;
    }

    public function add(Comment $comment){
        $req = $this->db->prepare("INSERT INTO `comment` (content, todaydate, author) VALUES(:content, :todaydate, :author)");

        $req->bindValue(":content", $comment->getContent(), PDO::PARAM_STR);
        $req->bindValue(":todaydate", $comment->getTodaydate(), date('Y-m-d H:i:s'));
        $req->bindValue(":author", $comment->getAuthor(), PDO::PARAM_STR);
    

        $req->execute();
    }

    public function update(Comment $comment){
        $req = $this->db->prepare("UPDATE `comment` SET content = :content, author = :author WHERE id = :id");

        $req->bindValue(":id", $comment->getId(), PDO::PARAM_INT);
        $req->bindValue(":content", $comment->getContent(), PDO::PARAM_STR);
        $req->bindValue(":todaydate", $comment->getTodaydate(), date('Y-m-d H:i:s'));
        $req->bindValue(":author", $comment->getAuthor(), PDO::PARAM_STR);

        $req->execute();
    }

    public function get(int $id){
        $req = $this->db->prepare("SELECT * FROM `comment` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $comments = $req->fetch();
        $comment = new comment($comments);
        return $comment;
    }

    public function getAll(): array{
        $comments = [];
        $req = $this->db->query("SELECT * FROM `comment`");
        $req->execute();

        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $articles[] = new comment($data);
        }

        return $articles;
    }

    public function getAllByArticleId(): array{
        $articles = [];
        $req = $this->db->query("SELECT * FROM `comment`");
        $req->execute();

        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $articles[] = new article($data);
        }

        return $articles;
    }

    public function delete(int $id): void{
        $req = $this->db->prepare("DELETE FROM `comment` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}

?>