<?php 

class ArticleManager{

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

    public function add(Article $article){
        $req = $this->db->prepare("INSERT INTO `article` (title, content, todaydate, author) VALUES(:title, :content, :todaydate, :author)");

        $req->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
        $req->bindValue(":todaydate", $article->getTodaydate(), date('Y-m-d H:i:s'));
        $req->bindValue(":author", $article->getAuthor(), PDO::PARAM_STR);
    
        $req->execute();
    }

    public function update(article $article){
        $req = $this->db->prepare("UPDATE `article` SET title = :title, content = :content, author = :author WHERE id = :id");

        $req->bindValue(":id", $article->getId(), PDO::PARAM_INT);
        $req->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
       //  $req->bindValue(":todaydate", $article->getTodaydate(), date('Y-m-d H:i:s'));
        $req->bindValue(":author", $article->getAuthor(), PDO::PARAM_STR);

        $req->execute();
    }

    public function get(int $id){
        $req = $this->db->prepare("SELECT * FROM `article` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $articles = $req->fetch();
        $article = new article($articles);
        return $article;
    }

    public function getAll(): array{
        $articles = [];
        $req = $this->db->query("SELECT * FROM `Article`");
        $req->execute();

        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $articles[] = new article($data);
        }

        return $articles;
    }

    public function delete(int $id): void{
        $req = $this->db->prepare("DELETE FROM `Article` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}

?>