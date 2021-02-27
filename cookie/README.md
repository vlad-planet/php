# Использование cookie

#### Создание временной cookie

```php
setcookie("name", "John");
```

####  Создание долговременной cookie на один час

```php
setcookie("name", "John", time()+3600);
```

####  Cookie доступны один час по пути /docs/

```php
setcookie("name", "John", time()+3600, "/docs/");
```

####  Cookie доступны один час по пути для всех поддоменов

```php
setcookie("name", "John", time()+3600, "/", ".example.com");
```

####  Сookie можно отдавать только при https

```php
setcookie("name", "John", time()+3600, "/", ".example.com", true);
```

####  Сookie можно отдавать только при http запросе

```php
setcookie("name", "John", time()+3600, "/", ".example.com", false, true);
```

####  Чтение cookie

```php
echo $_COOKIE["name"];
```

####  Удаление cookie

```php
setcookie("name", "John", time()-3600);
```

#### Массивы и cookie

```php
$user = [
	'name' => 'John',
	'login' => 'root',
	'password' => '1234'
];

$str = serialize($user);
setcookie("user", $str);

$user = unserialize($_COOKIE["user"]);
print_r($user);
```

#### Для сохранения целостности

```php
$str = base64_encode( serialize($user) );
setcookie("user", $str);

$user = unserialize( base64_decode($_COOKIE["user"]) );
print_r($user);
```
