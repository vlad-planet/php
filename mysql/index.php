<?
# Алгоритм работы с СУБД MySQL

#### Соединение с сервером баз данных

//  Соединение и выбор базы данных
$link = mysqli_connect('localhost', 'root', '', 'web');

// Отслеживаем ошибки при соединении
if( !$link ){
	echo 'Ошибка: '
	. mysqli_connect_errno()
	. ':'
	. mysqli_connect_error();
}

// Можно выбрать другую базу данных для работы
mysqli_select_db($link, 'test');

// Закрываем соединение
mysqli_close($link);


#### Основные манипуляции с сервером баз данных

// Соединение и выбор базы данных
$link = mysqli_connect('localhost', 'root', '', 'web');

// Посылаем простой запрос. Результат: true или false
$result = mysqli_query($link, "SET NAMES 'utf8'");

// Отслеживаем ошибки при исполнении запроса
if( !$result ){
	echo 'Ошибка: '
	. mysqli_errno($link)
	. ':'
	. mysqli_error($link);
}

// Посылаем запрос на выборку. Результат: object или false
$result = mysqli_query($link, 'SELECT * FROM teachers');

// Можно закрыть соединение
mysqli_close($link);

// Обрабатываем результат
$row = mysqli_fetch_array($result);


// Варианты обрабатки результата

// По-умолчанию
$row = mysqli_fetch_array($result);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);

// Индексированный массив
$row = mysqli_fetch_row($result);

$row = mysqli_fetch_array($result, MYSQLI_NUM);

// Ассоциативный массив
$row = mysqli_fetch_assoc($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Полная выборка: массив массивов
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);


#### Полезные функции

$link = mysqli_connect('localhost', 'root', '', 'web');

// Экранируем строки!
$name = mysqli_real_escape_string($link, "John O'Brian");
$sql = "INSERT INTO teachers(name, email) VALUES('$name', 'johnh@gmail.com')";
mysqli_query($link, $sql);

// Получаем первичный ключ новой записи
$id = mysqli_insert_id($link);
$sql = "DELETE FROM lessons WHERE room = 'БК-1'";
mysqli_query($link, $sql);

// Сколько записей изменено?
$count = mysqli_affected_rows($link);
$sql = "SELECT * FROM courses";
$result = mysqli_query($link, $sql);

// Сколько записей вернулось?
$row_count = mysqli_num_rows($result);

// Сколько полей в вернувшихся записях?
$fields_count = mysqli_num_fields($result);


#### Подготовленные запросы

$sql = "INSERT INTO users(name, email, age) VALUES(?, ?, ?)";

// Уважаемый сервер, вот запрос - разбери его
$stmt = mysqli_prepare($link, $sql);

// Уважаемый сервер, вот параметры для запроса
mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $age);

// А теперь, исполни подготовленный запрос с переданными параметрами
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
?>