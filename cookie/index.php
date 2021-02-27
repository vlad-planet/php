<?
# Использование cookie

#### Создание временной cookie

setcookie("name", "John");

####  Создание долговременной cookie на один час

setcookie("name", "John", time()+3600);

####  Cookie доступны один час по пути /docs/

setcookie("name", "John", time()+3600, "/docs/");

####  Cookie доступны один час по пути для всех поддоменов

setcookie("name", "John", time()+3600, "/", ".example.com");

####  Сookie можно отдавать только при https

setcookie("name", "John", time()+3600, "/", ".example.com", true);

####  Сookie можно отдавать только при http запросе

setcookie("name", "John", time()+3600, "/", ".example.com", false, true);

####  Чтение cookie

echo $_COOKIE["name"];

####  Удаление cookie

setcookie("name", "John", time()-3600);


#### Массивы и cookie

$user = [
	'name' => 'John',
	'login' => 'root',
	'password' => '1234'
];

$str = serialize($user);
setcookie("user", $str);

$user = unserialize($_COOKIE["user"]);
print_r($user);

#### Для сохранения целостности

$str = base64_encode( serialize($user) );
setcookie("user", $str);

$user = unserialize( base64_decode($_COOKIE["user"]) );
print_r($user);
?>