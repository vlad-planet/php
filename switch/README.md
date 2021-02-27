# Конструкция Switch

```php
$i = 1;
switch ($i) {
 case 0:
 echo "Результат: 0";
 case 1:
 echo "Результат: 1";
 case 2:
 echo "Результат: 2";
 case 3:
 echo "Результат: 3";
 case 4:
 echo "Результат: 4";
}
```
#### Прерывание "break"

```php
switch ($i) {
 case 0:
 echo "Результат: 0"; break;
 case 1:
 echo "Результат: 1"; break;
 case 2:
 echo "Результат: 2"; break;
 case 3:
 echo "Результат: 3"; break;
 case 4:
 echo "Результат: 4"; break;
}
```
#### Значение по умолчанию "default"

```php
$i = 20;
switch ($i) {
 case 0:
 echo "Результат: 0"; break;
 case 1:
 echo "Результат: 1"; break;
 case 2:
 echo "Результат: 2"; break;
 case 3:
 echo "Результат: 3"; break;
 case 4:
 echo "Результат: 4"; break;
 default:
 echo "Результат: много";
}
```