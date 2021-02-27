<?
# Соединение с базой данных

// MySQL
$pdo = new PDO('mysql:host=host;dbname=db', $user, $pass);

// PostgreSQL
$pdo = new PDO('pgsql:host=host;dbname=db', $user, $pass);

// SQLite
$pdo = new PDO('sqlite:db');

// Постоянное соединение
$pdo = new PDO('mysql:host=host;dbname=test', $user, $pass, [PDO::ATTR_PERSISTENT => true]);


#### Строки для соединения с базами данных

/*
MySQL 
("mysql:host=hostname;dbname=mysql", "username","password")

SQLite
("sqlite:/path/to/database.db") или ("sqlite::memory:")

PostgreSQL
("pgsql:dbname=pdo;host=hostname", "username", "password" )

Oracle
("OCI:dbname=mydatabase;charset=UTF-8", "username","password")

ODBC
("odbc:Driver={Microsoft Access Driver(*.mdb)};Dbq=C:\database.mdb;Uid=Admin")

Firebird
("firebird:dbname=hostname:C:\path\to\database.fdb","username", "password")

Informix
("informix:DSN=InformixDB", "username", "password")

DBLIB
("dblib:host=hostname:port;dbname=mydb","username","password")
*/

#### Выполнение запроса без выборки

$sql = "INSERT INTO users(name, email)VALUES('john', 'john@smith.com')";
$result = $pdo->exec($sql);

// Проверка ошибок
if($result === false)
echo "Ошибка в запросе";

#### Экранирование строки

$name = $pdo->quote($name);
$sql = "INSERT INTO users(name) VALUES($name)";


#### Выборка данных

$sql = "SELECT id, name FROM users";

$stmt = $pdo->query($sql);

// Обработка ошибок
$pdo->query($sql) or die('Ошибка в запросе!');

// Обработка результата
$row = $stmt->fetch(); // PDO::FETCH_BOTH
$row = $stmt->fetch(PDO::FETCH_NUM);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

#### Обработка ошибок

$pdo = new PDO("sqlite: test.db");

// Используем исключения
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
	// Что-то произошло
}catch(PDOException $e){
	$e -> getCode() . ":" . $e -> getMessage();
}

// Используем предупреждения
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// Не выводить никаких сообщений
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
echo $pdo -> errorCode();
print_r( $pdo -> errorInfo() );


#### Результат в виде объекта

$sql = "SELECT id, name, email FROM users";
$pdo = new PDO("sqlite: users.db");

// Приведение результата к объекту
$stmt = $pdo->query($sql);
$obj = $stmt->fetch(PDO::FETCH_OBJ);

echo $obj -> id . "\n";
echo $obj -> name . "\n";
echo $obj -> email . "\n";

// Ленивое приведение
$stmt = $pdo->query($sql);
$obj = $stmt->fetch(PDO::FETCH_LAZY);

echo $obj[0] . "\n";
echo $obj['name'] . "\n";
echo $obj -> email . "\n";


#### Использование класса

/*
Таблица users c полями: id, name, email
1, First, first@email.ru
2, Second, second@email.ru
*/

// Поиск названия класса в значении первого поля в выборке
$sql = "SELECT id, name, email FROM users";
$stmt = $pdo->query($sql);
$obj = $stmt->fetch( PDO::FETCH_CLASS|PDO::FETCH_CLASSTYPE );

/*
Результат:
stdClass Object ( [name] => First [email] => first@email.ru )
stdClass Object ( [name] => First [email] => second@email.ru )
*/

class First {
public $id, $name, $email;
}
$sql = "SELECT name, email FROM users";
$stmt = $pdo->query($sql);
$obj = $stmt->fetch( PDO::FETCH_CLASS|PDO::FETCH_CLASSTYPE );

/*
Результат:
First Object ( [id] =>NULL [name] => NULL [email] =>
first@email.ru )
stdClass Object ( [email] => second@email.ru )
*/

class Second {
public $id, $name, $email;
}
$sql = "SELECT name, email, id FROM users";
$stmt = $pdo->query($sql);
$obj = $stmt->fetch( PDO::FETCH_CLASS|PDO::FETCH_CLASSTYPE );

/*
Результат:
First Object ( [id] =>1 [name] => NULL [email] => first@email.ru )
Second Object ( [id] =>2 [name] => NULL [email] => second@email.ru )
*/


// Явное указание названия класса для создания объекта

// По-умолчанию stdClass
$sql = "SELECT id, name, email FROM users";
$stmt = $pdo->query($sql);
$obj = $stmt->fetchObject();

/*
Результат:
stdClass Object ( [id] =>1 [name] => First [email] =>
first@email.ru )
stdClass Object ( [id] =>2 [name] => Second [email] =>
second@email.ru )
*/

// Явное указание названия класса User для создания объекта
class User{
public id, name, email;
}
$sql = "SELECT id, name, email FROM users";
$stmt = $pdo->query($sql);
$obj = $stmt->fetchObject("User");

/*
Результат:
User Object ( [id] =>1 [name] => First [email] => first@email.ru )
User Object ( [id] =>2 [name] => Second [email] => second@email.ru )
*/

/* Установка режимов выборки */

// Явное указание имеющегося объекта
$user = new User();
$stmt->setFetchMode(PDO::FETCH_INTO, $user);
$obj = $stmt->fetch(PDO::FETCH_ASSOC);

/*
Результат используется один и тот же объект!
После извлечения последней записи в объекте будет:
 User Object ( [id] =>2 [name] => Second [email] => second@email.ru )
*/

// Явное указание класса User для создания объекта
$stmt -> setFetchMode(PDO::FETCH_CLASS, "User");

// Явное указание класса User для создания объекта

// Cвойства заполняются значениями после отработки конструктора
$stmt -> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");

#### Полная выборка

$sql = "SELECT id, name, email FROM users";
$stmt = $pdo->query($sql);

// Получаем массив массивов
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC); // поумолчанию PDO::FETCH_BOTH
class User {
	public $id, $name, $email;
}
// Получаем массив объектов класса User
$arr = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
$sql = "SELECT city, name FROM users";
$stmt = $pdo->query($sql);

// Выбираем данные только из первого поля
$arr = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

// Группируем значения второго поля по значению первого поля
$arr = $stmt->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);

// Выбираем уникальные значения из первого поля
$arr = $stmt->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_UNIQUE);

// Используем функцию обратного вызова
function foo($name, $email){
	return $name . ': '. $email . "\n");
}
$arr = $stmt->fetchAll(PDO::FETCH_FUNC, 'foo');


#### Подготовленные запросы

// Именованные псевдопеременные

$sql = 'SELECT email FROM users WHERE id = :id AND name = :name';
$stmt = $pdo -> prepare($sql);
$stmt -> execute( [':id' => 5, ':name' => 'John'] );
$john = $stmt->fetchAll();
$stmt -> execute( ['id' => 6, 'name' => 'Mike'] );
$mike = $stmt->fetchAll();

// Неименованные псевдопеременные
$sql = 'SELECT email FROM users WHERE id = ? AND name = ?';
$stmt = $pdo -> prepare($sql);
$stmt -> execute( [5, 'John'] );
$john = $stmt->fetchAll();
$stmt -> execute( [6, 'Mike'] );
$mike = $stmt->fetchAll();

/* Привязка параметров */
$id = 5;
$name = 'John';

// Для именованные псевдопеременныx
$sql = 'SELECT email FROM users WHERE id = :id AND name = :name';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(':id', $id, PDO::PARAM_INT);
$stmt -> bindParam(':name', $name, PDO::PARAM_STR);
$stmt -> execute();

// Для неименованные псевдопеременныx
$sql = 'SELECT email FROM users WHERE id = ? AND name = ?';
$stmt = $pdo -> prepare($sql);
$stmt -> bindParam(1, $id, PDO::PARAM_INT);
$stmt -> bindParam(2, $name, PDO::PARAM_STR);
$stmt -> execute();

/* Привязка значений */
$id = 5;
$name = 'John';

// Для именованные псевдопеременныx
$sql = 'SELECT email FROM users WHERE id = :id AND name = :name';
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':id', $id, PDO::PARAM_INT);
$stmt -> bindValue(':name', $name, PDO::PARAM_STR);
$stmt -> execute();

// Для неименованные псевдопеременныx
$sql = 'SELECT email FROM users WHERE id = ? AND name = ?';
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(1, $id, PDO::PARAM_INT);
$stmt -> bindValue(2, $name, PDO::PARAM_STR);
$stmt -> execute();

/* Привязка возвращаемых полей к именам переменных */
$sql = 'SELECT id, name, email FROM users';
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
$stmt -> bindColumn(1, $id);
$stmt -> bindColumn(2, $name);
$stmt -> bindColumn('email', $email);

// имя поля регистрозависимо!
while($stmt -> fetch(PDO::FETCH_BOUND))
echo "$id : $name : $email\n";


##### Использование хранимых процедур

$id = 5;
$name = 'John';
$stmt = $db -> prepare('CALL getEmail(?, ?, ?)');

// Параметр IN
$stmt -> bindParam(1, $id, PDO::PARAM_INT);

// Параметр INOUT
$stmt -> bindParam(2, $name, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT);

// Параметр OUT
$stmt -> bindParam(3, $email, PDO::PARAM_STR);
$stmt -> execute();


#### Использование транзакций

try {
	$pdo -> beginTransaction();
	
	// Исполняем много запросов
	// Если все запросы исполнены успешно, то фиксируем это
	$pdo->commit();
}catch (PDOException $e) {
	
	// Если хотя бы в одном запросе произошла ошибка, откатываем всё назад
	$pdo -> rollBack();
}
?>