<?php
class Users{

	public $id;
	public $email;
	public $name;

	public function nameToUpper(){
		return strtoupper($this->name);
	}
}


    $db = new PDO("sqlite:users.db");

	$sql = "SELECT * FROM user";

    $stmt = $db->query($sql);
	
	//$obj = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'Users');
	//$obj = $stmt->fetchALL(PDO::FETCH_COLUMN, 1);
	//var_dump($obj);exit;
	
    foreach($obj as $user){
        echo $user->nameToUpper().'<br>';
    }
    $db = null;

	
	
	$db = new PDO("sqlite:city.db");
	/*
	$dbu->exec("CREATE TABLE user(name, city, color)");
	$dbu->exec("INSERT INTO user VALUES ('John', 'London', 'red')");
	$dbu->exec("INSERT INTO user VALUES ('John', 'London', 'green')");
	$dbu->exec("INSERT INTO user VALUES ('John', 'Moscow', 'green')");
	$dbu->exec("INSERT INTO user VALUES ('John', 'Moscow', 'red')");
	$dbu->exec("INSERT INTO user VALUES ('Mike', 'Moscow', 'red')");
	$dbu->exec("INSERT INTO user VALUES ('Mike', 'Moscow', 'green')");
	$dbu->exec("INSERT INTO user VALUES ('Mike', 'London', 'yellow')");
	$dbu->exec("INSERT INTO user VALUES ('Ivan', 'London', 'yellow')");
	$dbu->exec("INSERT INTO user VALUES ('Ivan', 'Moscow', 'yellow')");
	*/
	$sql = "SELECT city, name, color FROM user";
	$stmt = $db->query($sql);
	$obj = $stmt->fetchALL(PDO::FETCH_COLUMN|PDO::FETCH_GROUP, 2);
	var_dump($obj);
?>