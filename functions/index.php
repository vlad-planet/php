<?
# Декларация и вызов функции

#### Декларация функции

function sayHello()
{
	echo "<h1>Hello, world!</h1>";
}

#### Вызов функции

sayHello();

# Аргументы функции

function sayHello($name)
{
	echo "<h1>Hello, $name!</h1>";
}
#### Передаём литерал

sayHello("John"); // Hello, John!

#### Передаём значение переменной

$name = "Mike";
sayHello($name); // Hello, Mike!

#### Обращение к функции через переменную

$func = "sayHello";
$func("Guest"); // Hello, Guest!

#### Аргументы по-умолчанию

function sayHello($name="Guest")
{
	echo "<h1>Hello, $name!</h1>";
}
sayHello("John"); // Hello, John!
sayHello(); // Hello, Guest!
?>