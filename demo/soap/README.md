# Simple Object Access Protocol

```php
//SOAP запрос

<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
	<soap:Body>
			<getStock xmlns="http://site.ru/ws">
				<num>12345</num>
			</getStock>
		</soap:Body>
</soap:Envelope>

//SOAP ответ
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
	<soap:Body>
		<getStockDetailsResponse xmlns="http://site.ru/ws">
			<getStockDetailsResult>
				<id>12345</id>
				<productName>Стакан граненый</productName>
				<description>Стакан граненый. 250 мл.</description>
				<price>9.95</price>
			</getStockDetailsResult>
		</getStockDetailsResponse>
	</soap:Body>
</soap:Envelope>
```

# Создание SOAP сервера

```php
// Описание службы - процедурный интерфейс
$stock = [
 "a"=>100,
 "b"=>200,
 "c"=>300,
 "d"=>400,
 "e"=>500
];

function getStock($code){
	global $stock;
	if (isset($stock[$code]))
		return $stock[$code];
	return 0;
}

// Создание сервера
$server = new SoapServer("stock.wsdl");

// Добавление функции, которая будет видна клиенту
$server->addFunction("getStock");

// Обработка SOAP-запроса (запуск сервера)
$server->handle();

// Если функций больше, чем одна, то
$funcs = ["getStock", "setStock"];
$server->addFunction($funcs);

// Служба является классом, то
$server->setClass("StockService");
```

# Создание SOAP клиента

```php
// Создание сервера
$client = new SoapClient("stock.wsdl");

// Вызов удалённой процедуры
$amount = $server->getStock("b");
echo "Товаров на полке: $amount";

// Посмотреть список доступных операций
print_r( $client->__getFunctions() );
```

#### Второй вариант синтаксиса

```php
const TWO_HUNDRED = 200; // PHP 5.3
const TWO_HUNDRED_TEN = TWO_HUNDRED + 10; // PHP 5.6
```
