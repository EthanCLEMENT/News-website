<?php 
class Comment{
    private $id; 
    private $content;
    private $todaydate;
    private $author;
    private $articleid;

    public function __construct(array $comments){
		$this->hydrate($comments);
	}

	public function hydrate(array $comments){
		foreach($comments as $key => $value){
			$method = "set".ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}
     
    public function getId(){
        return $this->id;
    }

    public function getContent(){
        return $this->content;
    }

    public function getTodaydate(){
        return $this->todaydate;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getArticleid(){
        return $this->articleid;
    }

    public function setId($id){
		$id = (int)$id;
		if ($id > 0) {
			$this->id = $id;
		}
	}
	public function setContent($content){
		if(is_string($content)){
			$this->content = $content;
		}
	}

	public function setTodaydate($todaydate){
		if(date($todaydate)){
			$this->todaydate = $todaydate;
		}
	}

    public function setAuthor($author){
        if(is_String($author)){
            $this->author = $author;
        }
    }

    public function setArticleid($articleid){
        if(is_String($articleid)){
            $this->articleid = $articleid;
        }
    }
}
?>