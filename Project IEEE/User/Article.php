<?php 
class Article{
    private $id; 
    private $title; 
    private $content;
    private $todaydate;
    private $author;

    public function __construct(array $articles){
		$this->hydrate($articles);
	}

	public function hydrate(array $articles){
		foreach($articles as $key => $value){
			$method = "set".ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}
     
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
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

    public function setId($id){
		$id = (int)$id;
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setTitle($title){
		if(is_string($title)){
			$this->title = $title; 
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
}
?>