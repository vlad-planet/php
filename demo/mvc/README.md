
# Шаблон проектирования MVC

```php
<html>
	<head>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
	
	session_start();
	
	if (!isset($_SESSION['username'])) {
		echo "Вы не авторизованы на сайте";
	} else {
		echo "Добро пожаловать, " .
		$_SESSION['username'];
	}
	$pdo = n
	ew PDO('sqlite:site.db');
	
	$stmt = $pdo->prepare("SELECT * FROM products");
	$stmt->execute();
	
	$dbresult = $stmt->	fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($dbresult as $record) {
		foreach ($record as $k => $v) {
			echo $k . ": " . $v . "<br>";
		}
	}
	</body>
</html>
```

# Model-View-Controller

#### View

```php
include 'controller.php'; 

<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
	<body>
	
	<?php
		echo $output;
		
		if(is_string($dbresult)){
			echo $dbresult;
		}else{
			foreach ($dbresult as $record) {
				foreach ($record as $k => $v) {
					echo $k . ": " . $v . "<br>";
					}
				}
		}
	?>
	
	</body>
</html>
```

#### Controller

```php
include 'model.php';

session_start();

if (isset($_SESSION['username'])) {
	$output = "Добро пожаловать, ".
	$_SESSION['username'];
} else {
	$output = "Вы не авторизованы не сайте";
}
$dbresult = fetchAllProducts();
```

#### Model

```php
function getDBConnection() {
	try{
		$pdo = new PDO('sqlite:site.db');
		return $pdo;
	}catch(PDOException $e) {
		return "Извините, " . $e->getMessage());
	}
}

function fetchAllProducts() {
	$pdo = getDBConnection();
	
	if(!is_object($pdo))
		return $pdo;
	try{
		$stmt = $pdo->prepare("SELECT * FROM products");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}catch(Exception $e) {
		return "Извините, " . $e->getMessage());
	}
}
```

# MVC приложение

#### Маршрутизация

```php
 /controller/action[/key 1][/key 2]...
 /controller/action[/key 1][/value 1]... 
```

#### Примеры:

```php
	 /
	 /book/show
	 /book/show/id/25
	 /book/show/category/php/year/2012
	 /book/get/format/xml
 mod_rewrite => bootstrap file (index.php)
```

#### Структура

```php
○ application
	□ contrlollers
	□ models
	□ views
○ images
○ styles
○ index.php (bootstrap)
○ .htaccess
	□ RewriteCond %{REQUEST_FILENAME} !-f
	□ RewriteRule !\.(js|gif|jpg|png|css)$index.php
```