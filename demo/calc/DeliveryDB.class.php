<?
include "IDeliveryDB.class.php";
class DeliveryDB implements IDeliveryDB, IteratorAggregate{
	const DB_NAME = 'delivery.db';
	protected $_db;
	function __construct(){
		if(is_file(self::DB_NAME)){
			$this->_db = new PDO('sqlite:'.self::DB_NAME);
		}else{
			$this->_db = new PDO('sqlite:'.self::DB_NAME);
			$sql = "CREATE TABLE msgs(
									id INTEGER PRIMARY KEY AUTOINCREMENT,
									name TEXT,
									price INTEGER,
									more INTEGER DEFAULT NULL,
									more_price INTEGER DEFAULT NULL
								)";
			$this->_db->exec($sql) or $this->_db->errorCode();
			$sql = "INSERT INTO msgs(name, price, more, more_price) VALUES ('Почта России',100,10,1000)";
			$this->_db->exec($sql) or $this->_db->errorCode();	
			$sql = "INSERT INTO msgs(name, price, more, more_price) VALUES ('DHT',100,'','')";
			$this->_db->exec($sql) or $this->_db->errorCode();				
		}
		$this->getDelivery();
	}
	function getIterator(){
		return new ArrayIterator($this->_items);
	}
	function getDelivery(){
		$sql = "SELECT id, name, price, more, more_price FROM msgs";
		$result = $this->_db->query($sql);
		$this->_items = $result->fetchALL(PDO::FETCH_ASSOC);
		return $this->_items;
	}
	function __destruct(){
		unset($this->_db);
	}
	function saveDelivery($name, $price, $more, $more_price){
		$sql = "INSERT INTO msgs(name, price, more, more_price)	VALUES ('$name', '$price', '$more', '$more_price')";
		$ret = $this->_db->exec($sql);
		if(!$ret)
			return false;
		return true;	
	}	
	public function deleteDelivery($id){
		try{
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM msgs WHERE id = $id";
			$result = $this->_db->exec($sql);
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			echo $e->getFile();
			echo $e->getLine();
			return false;
		}
	}
	function clearStr($data){
		return trim(strip_tags($data));
	}
	function clearInt($data){
		return abs((int)$data);
	}	
}

?>