# Reflection API: примеры

```php
// Получаем экземпляр класса ReflectionClass
$rc = new ReflectionClass('Имя_класса');

// Наследует ли класс тот или иной интерфейс?
$rc->implementsInterface('Имя_интерфейса');

// Имеет ли класс тот или иной метод?
$rc->hasMethod('Имя_метода');

// Получаем экземпляр класса ReflectionMethod
$rm = $rc->getMethod('Имя_метода');

// Является ли метод статическим?
$rm->isStatic();

// Выполнение статического метода
$result = $rm->invoke(null);

// Выполнение обычного метода
$instance = $rc->newInstance();
$result = $rm->invoke($instance);
```
