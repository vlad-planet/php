# Создание, открытие и закрытие базы данных

```php
// Создаём или открываем базу данных test.db
$db = new SQLite3("test.db");
// Закрываем базу данных без удаления объекта
$db->close();
// Открываем другую базу данных для работы
$db->open("another.db");
// Удаляем объект
unset($db);
```

# Выполнение запроса

```php
// Экранирование строк
$name = $db->escapeString($name);
// Для запросов без выборки данных
$sql = "INSERT INTO users (name, age)
 VALUES ('$name', 25)";
// Возвращает значение булева типа
$result = $db->exec($sql);
// Количество изменённых записей
echo $db->changes();
// Отслеживание ошибок
echo $db->lastErrorCode();
echo $db->lastErrorMsg();
```

# Подготовленные запросы

```php
$sql = "INSERT INTO users (name, age)
 VALUES (:name, :age)";
// Готовим запрос
$stmt = $db->prepare($sql);
// Привязываем параметры
$stmt->bindParam(':name', $name);
$stmt->bindParam(':age', $age);
// Исполняем запрос
$result = $stmt->execute();
// Закрываем при необходимости
$stmt->close();
```

# Выборка данных

```php
$sql = "SELECT name, age FROM users";
// В случае неудачи возвращает false
$result = $db->querySingle($sql);
// В $result - значение первого поля первой записи
$result = $db->querySingle($sql, true);
// В $result - массив значений первой записи
// Стандартная выборка
$result = $db->query($sql);
// Обработка выборки
$row = $result->fetchArray(); // SQLITE3_BOTH
// Получаем ассоциативный массив
$row = $result->fetchArray(SQLITE3_ASSOC);
// Получаем индесированный массив
$row = $result->fetchArray(SQLITE3_NUM);
```