<?php
class User{

	private int $id;
	private string $username;
	private string $pwd;
	private string $email;
	private string $validAccount;

	public function __construct(array $datas){
		$this->hydrate($datas);
	}

	public function hydrate(array $datas){
		foreach($datas as $key => $value){
			$method = "set".ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPwd(){
		return $this->pwd;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setId($id){
		$id = (int)$id;
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setUsername($username){
		if(is_string($username)){
			$this->username = $username; 
		}
	}

	public function setPwd($pwd){
		if(is_string($pwd)){
			$this->pwd = $pwd;
		}
	}

	public function setEmail($email){
		if(is_string($email)){
			$this->email = $email;
		}
	}

	public function getValidAccount(){
		return $this->validAccount;
	}

	public function setValidAccount(bool $validAccount){
		$this->validAccount = $validAccount;

		return $this;
	}
}

