# Переадресация и перезапрос ресурса

#### Переадресация со статусом 302

```php
header("Location: http://mysite.local");
```

#### Переадресация со статусом 301

```php
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://mysite.local");
```

#### Или

```php
header("Location: http://mysite.local", true, 301);
```

#### Перезапрос ресурса

```php
header("Refresh: 3");
header("Refresh: 3; url=http://mysite.local");
```

#Установка типа содержимого

#### Принудительная установка типа передаваемого ресурса

```php
header("Content-Type: text/xml");
```

#### Принудительная установка кодировки передаваемого ресурса

```php
header("Content-Type: text/html; charset=utf-8");
```

#### Перенаправление вывода передаваемых данных

```php
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=\"myfile.txt\"");
```

#Управление кэшированием

#### Запрет кэширования

```php
header("Cache-Control: no-cache, max-age=0");
```

#### Полный запрет кэширования

```php
header("Cache-Control: no-store");
```

#### Разрешение кэширования на один час относительно времени запроса

```php
header("Cache-Control: max-age=3600");
```

#### Разрешение кэширования на один час

```php
header("Expires: " . date("r", time() + 3600);
```