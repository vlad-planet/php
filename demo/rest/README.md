# Representational State Transfe

#### Микро-фреймворк Slim
```php
//http://slimframework.com

// Автозагрузчик
\Slim\Slim::registerAutoloader();

// Создание экземпляра класса
$app = new \Slim\Slim();

// Запуск приложения
$app -> run();

// Роутинг и базовые операции
$app->get('/', function(){
	echo 'Привет, гость!';
});

$app->post('/:id', function($id) use ($app){
	// Получаем значение параметра name
	$name = $app->request()->post('name');
	
	// Получаем массив всех параметров
	$params = $app->request()->post();
	
	// Посылаем ответ
	$res = $app->response();
	
	// Посылаем HTTP заголовок с нужным значением
	$res['Content-Type'] = 'text/xml';
});
```

#### Библиотека NotORM

```php
//http://www.notorm.com

//Инициализация
$pdo = new PDO('sqlite:db');
$db = new NotORM($pdo);

// Выборка всех записей
foreach($db->users() as $user){}

// Выборка с условием
$user = $db->users()->where('id', $id);
$row = $user->fetch();

// Изменение записи
$user->update($array);

// Вставка записи
$db->users()->insert($array);
```
