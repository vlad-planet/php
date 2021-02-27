# Классы и объекты

```php
// Описание класса
class Pet{
	// тело класса
}

// Создание объекта, экземпляра класса
$cat = new Pet();
$dog = new Pet;

// Проверим
echo gettype($cat); // object
echo is_object($dog); // 1
```