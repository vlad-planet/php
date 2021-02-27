<?
# Использование сокетов

// Создание сокета
$socket = fsockopen("mysite.local", 80, $errno, $errmsg, 30);

if(!$socket){
	echo "$errno : $errmsg";
}else{
	
	// Поготовка запроса
	$output = "HEAD /server.php HTTP/1.1\r\n";
	$output .= "Host: mysite.local\r\n";
	$output .= "Connection: close\r\n\r\n";
 
	// Посылаем запрос
	fwrite($socket, $output);
 
	// Читаем ответ
	while( !$feof($socket) ){
		echo $fgets($socket);
	}
	
	// Закрываем сокет
	$fclose($socket);
}


## Сетевые функции

// Получаем имя хоста по ip-адресу
$host_name = getHostByAddr("127.0.0.0");

// Получаем ip-адрес по имени хоста
$ip_address = getHostByName("mysite.local");

// Получаем массив ip-адресов по имени хоста
$ip_addresses = getHostByNameL("mysite.local");

// Получаем номер порта по имени службы
$port = getServByName("http", "tcp");

// Получаем имя службы по номеру порта
$service = getServByPort(80, "tcp");

// Получаем DNS запись для указанного хоста
$dns_record = dns_get_record("mysite.local");

// Получаем MX запись для указанного хоста
$dns_record = getmxrr("mysite.local");

// Проверяем имя хоста на существование
$exists = checkdnsrr("mysite.local");
?>