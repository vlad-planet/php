#### Самые популярные PHP функции
https://hotexamples.com/ru/site/trends?type=php%7Cf&pageNum=0

# Декларация и вызов функции

#### Декларация функции

```php
function sayHello()
{
	echo "<h1>Hello, world!</h1>";
}
```

#### Вызов функции

```php
sayHello();
```

# Аргументы функции

```php
function sayHello($name)
{
	echo "<h1>Hello, $name!</h1>";
}
```
#### Передаём литерал

```php
sayHello("John"); // Hello, John!
```

#### Передаём значение переменной

```php
$name = "Mike";
sayHello($name); // Hello, Mike!
```

#### Обращение к функции через переменную

```php
$func = "sayHello";
$func("Guest"); // Hello, Guest!
```

#### Аргументы по-умолчанию

```php
function sayHello($name="Guest")
{
	echo "<h1>Hello, $name!</h1>";
}
sayHello("John"); // Hello, John!
sayHello(); // Hello, Guest!
```
