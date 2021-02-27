# Использование cURL

```php
// Создание
$ch = curl_init();

// Установка опций
curl_setopt($ch, CURLOPT_URL, "http://site.ru");

// Выполнение
curl_exec($ch);

// Закрытие
curl_close($ch);
```

#### Опции для функции curl_setopt

```php
○ CURLOPT_RETURNTRANSFER: boolean
○ CURLOPT_HEADER: boolean
○ CURLOPT_NOBODY: boolean
○ CURLOPT_FILE: stream resource
○ CURLOPT_WRITEHEADER: stream resource
○ CURLOPT_POST: boolean
○ CURLOPT_POSTFIELDS: mixed
○ CURLOPT_PUT: boolean
○ CURLOPT_INFILE: stream resource
○ CURLOPT_INFILESIZE: integer
○ CURLOPT_HEADERFUNCTION: string
○ CURLOPT_BINARYTRANSFER: boolean
```

#### Опции для заголовков

```php
CURLOPT_COOKIE: string
○ CURLOPT_ENCODING: string
○ CURLOPT_REFERER: string
○ CURLOPT_USERAGENT: string
○ CURLOPT_USERPWD: string
○ CURLOPT_HTTPHEADER: array
○ CURLOPT_HTTP200ALIASES: array
```

#### Получение информации

```php
○ mixed curl_getinfo ( resource $ch [, int $opt = 0 ] )
 CURLINFO_HTTP_CODE
 CURLINFO_FILETIME
 CURLINFO_PRIMARY_IP
 CURLINFO_LOCAL_IP
 CURLINFO_HEADER_SIZE
 CURLINFO_SIZE_DOWNLOAD
 CURLINFO_CONTENT_TYPE
 CURLINFO_CONTENT_LENGTH_DOWNLOAD
 ...
```
