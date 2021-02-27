<?php
class Users implements IteratorAggregate{

	const DB_NAME = 'users.db';
	protected $_db;
	/* СОЗДАЕМ ТАБЛИЦИ БД ЕСЛИ НЕТУ для теста BEGIN*/
	function __construct(){
		if(is_file(self::DB_NAME)){
			$this->_db = new PDO('sqlite:'.self::DB_NAME);
		}else{
			$this->_db = new PDO('sqlite:'.self::DB_NAME);
			$sql = "CREATE TABLE users(
									id INTEGER PRIMARY KEY AUTOINCREMENT,
									name TEXT,
									age DATE
								)";
			$this->_db->exec($sql) or $this->_db->errorCode();
			$sql = "CREATE TABLE journal(
									id INTEGER PRIMARY KEY AUTOINCREMENT,
									uid INTEGER,
									jid INTEGER
								)";
			$this->_db->exec($sql) or $this->_db->errorCode();
		}
		$this->getUsers();
	}
	/* СОЗДАЕМ ТАБЛИЦИ БД ЕСЛИ НЕТУ для теста END */
	
	function getIterator(){
		return new ArrayIterator($this->_items);
	}
	

	/* ВЫБИРАЕМ ПРОИЗВОЛЬНУЮ ЗАПИСЬ О ПОДПИСЧИКЕ ИЗ БД BEGIN*/
	function getRand(){
		$nRows = $this->_db->query('SELECT count(*) FROM users')->fetchColumn();  
		$rand = rand(1, $nRows);
		$sql = "SELECT id, name, age FROM users LIMIT $rand, 1";
		$result = $this->_db->query($sql);
		$this->_items = $result->fetch(PDO::FETCH_ASSOC);
		return $this->_items;
	}
	/* ВЫБИРАЕМ ПРОИЗВОЛЬНУЮ ЗАПИСЬ О ПОДПИСЧИКЕ ИЗ БД END*/
	
	
	/* ВЫБИРАЕМ ВСЕХ ПОДПИСЧИКОВ BEGIN*/
	function getUsers(){
		$sql = "SELECT id, name, age FROM users";
		$result = $this->_db->query($sql);
		$this->_items = $result->fetchALL(PDO::FETCH_ASSOC);
	}
	/* ВЫБИРАЕМ ВСЕХ ПОДПИСЧИКОВ END*/
	
	/* ВЫБИРАЕМ ВСЕХ ПОДПИСЧИКОВ ПО ПАРАМЕТРАМ BEGIN*/
	function getAge($journal,$jage){
		$sql = "SELECT users.id as id, name, age 
				FROM users,journal 
				WHERE users.id = journal.uid AND journal.jid = $journal AND users.age <= '$jage'";
		$result = $this->_db->query($sql);
		$this->_items = $result->fetchALL(PDO::FETCH_ASSOC);
		return $this->_items;
	}
	/* ВЫБИРАЕМ ВСЕХ ПОДПИСЧИКОВ ПО ПАРАМЕТРАМ END*/
	
	/* ДОБАВЛЯЕМ ПОДПИСЧИКОВ BEGIN*/
	function saveUsers($name,$age,$jid){
		$sql = "INSERT INTO users(name, age) VALUES ('$name','$age')";
		$this->_db->exec($sql) or $this->_db->errorCode();
			$uid = $this->_db->lastInsertId();
			foreach($jid as $jid){
				$sql = "INSERT INTO journal(uid, jid) VALUES ($uid,$jid)";
				$this->_db->exec($sql) or $this->_db->errorCode();
			}
	}
	/* ДОБАВЛЯЕМ ПОДПИСЧИКОВ END*/
	
	function __destruct(){
		unset($this->_db);
	}
}

$users = new Users();

/* ЗАПРОС С ФОРМЫ НА ДОБАВЛЕНИЕ ПОДПИСЧИКОВ BEGIN*/
if(isset($_POST['add'])){
	$jid = $_POST['jid'];
	$name = $_POST['name'];
	$age =  $_POST['age'];
	
if(empty($name) or empty($age)){
		$errMsg = 'Заполните обязательные поля!';
	}else{
		$users->saveUsers($name,$age,$jid);
	}
}
/* ЗАПРОС С ФОРМЫ НА ДОБАВЛЕНИЕ ПОДПИСЧИКОВ END*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Способ доставки</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<h1>Все подписчики</h1>

<?
/* ПРИВОДИМ ДАТУ РОЖДЕНИЯ К ВОЗРОСТУ ПО ГОДАМ ВСЕХ ПОДПИСЧИКОВ BEGIN */
function calculate_age($birthday) {
	$birthday_timestamp = strtotime($birthday);
	$age = date('Y') - date('Y', $birthday_timestamp);
	if (date('md', $birthday_timestamp) > date('md')) {
		$age--;
	}
return $age;
}
//echo calculate_age('1990-01-01');

$users = new Users();
foreach($users as $item){
	echo "Имя: {$item[name]} | Возраст: ".calculate_age($item[age])." | ($item[age])<br>" ;
}
/* ПРИВОДИМ ДАТУ РОЖДЕНИЯ К ВОЗРОСТУ ПО ГОДАМ ВСЕХ ПОДПИСЧИКОВ END */


	$menu = array(
		array('id' => 1, 'title' => 'Мурзилка'),
		array('id' => 2, 'title' => 'Крокодил'),
		array('id' => 3, 'title' => 'Максим'),
	);
?>

<br>
<br>
<br>
<hr>
<? echo "<h1>Подписка на журнал:</h1>" ?>
<? echo "<h3>{$errMsg}</h3>" ?>
<form action="" method="post">
Имя: <input type="text" name="name">
Возраст: <input type="date" name="age">
<input type="hidden" name="add">
<br>
<? 
foreach($menu as $item){
	echo "<input type='checkbox' name='jid[]' value='{$item[id]}' checked>{$item[title]}<br>";
} 
?>
<input type="submit" value="Подписаться!" />
</form>


<br>
<br>
<hr>

<h1>Вывести подписчиков по категории</h1>
<form action="" method="post">
<select name="journal">

<?
	foreach($menu as $item){
		$selected=''; if($_POST['journal'] == $item['id']){$selected='selected';}
		echo "<option {$selected} value='{$item[id]}'>{$item[title]}</option>";
	}
?>
</select>
возраст старше<input type="number" name="jage" value="<? echo $_POST['jage'] ?>">лет
<input type="submit" value="Выбрать по параметрам!" />
</form>
<?
/* ЗАПРОС С ФОРМЫ НА ВЫВОД ПОДПИСЧИКОВ ПО ПАРАМЕТРАМ BEGIN*/
if(isset($_POST['journal'])){
	$journal = $_POST['journal'];
	$jage = $_POST['jage'];
	if(empty($jage)){
		echo '<h3>Укажите возраст!</h3>';
	}else{
		$date = new DateTime();
		$date->modify('-'.$jage.' year');
		$jage = $date->format('Y-m-d');
		$result = $users->getAge($journal,$jage);
		foreach($result as $result){
			echo "Имя: {$result[name]} | Возраст: {$result[age]}<br>" ;
		}
	}
}
/* ЗАПРОС С ФОРМЫ НА ВЫВОД ПОДПИСЧИКОВ ПО ПАРАМЕТРАМ END*/
?>
<br>
<br>
<br>
<hr>

<?
$ugr = $users->getRand();
echo "<h3>Наш любимый читатель: {$ugr[name]} | Дата рождения: {$ugr[age]} | Возраст: ".calculate_age($ugr[age])."</h3>";

?>

</body>
</html>