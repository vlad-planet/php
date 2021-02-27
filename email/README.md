# Отправляем email

#### Директивы PHP.INI

```php
ini_set("SMTP", "localhost");
ini_set("smtp_port", "25");
ini_set("sendmail_from", "");

$to = "vasya@mail.ru";
$subject = "Проба пера";
$body = "Отправляю письмо Васе";

if( mail($to, $subject, $body) )
	echo "Письмо отправить не удалось";
else
	echo "Письмо отправлено";
```

#### Используем дополнительные заголовки

```php
$headers = "Content-Type: text/html;charset=utf-8\r\n";
$headers .= "To: Петя <petya@mail.ru>\r\n";
$headers .= "Cc: lena@mail.ru\r\n";
$headers .= "Bcc: sveta@mail.ru\r\n";
$headers .= "From: Федя <fedya@mail.ru>\r\n";

$body = "<h1>Отправляю письмо Васе и Пете</h1>";

mail($to, $subject, $body, $headers);
```