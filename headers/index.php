<?
# Переадресация и перезапрос ресурса

#### Переадресация со статусом 302

header("Location: http://mysite.local");

#### Переадресация со статусом 301

header("HTTP/1.1 301 Moved Permanently");
header("Location: http://mysite.local");

#### Или

header("Location: http://mysite.local", true, 301);

#### Перезапрос ресурса

header("Refresh: 3");
header("Refresh: 3; url=http://mysite.local");

#Установка типа содержимого

#### Принудительная установка типа передаваемого ресурса

header("Content-Type: text/xml");

#### Принудительная установка кодировки передаваемого ресурса

header("Content-Type: text/html; charset=utf-8");

#### Перенаправление вывода передаваемых данных

header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=\"myfile.txt\"");

#Управление кэшированием

#### Запрет кэширования

header("Cache-Control: no-cache, max-age=0");

#### Полный запрет кэширования

header("Cache-Control: no-store");

#### Разрешение кэширования на один час относительно времени запроса

header("Cache-Control: max-age=3600");

#### Разрешение кэширования на один час

header("Expires: " . date("r", time() + 3600);

?>