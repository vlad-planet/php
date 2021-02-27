
# Simple API for XML (SAX)

```php
// Использование SAX
// Создание парсера
$sax = xml_parser_create("utf-8");

// Декларация функций обработки событий
function onStart($parser, $tag, $attributes){}
function onEnd($parser, $tag){}
function onText($parser, $text){}

// Регистрация функций как обработчиков событий
xml_set_element_handler($sax, "onStart", "onEnd");
xml_set_character_data_handler($sax, "onText");

// Запуск парсера
xml_parse($sax, "XML строка!");

// Обработка ошибок
echo xml_error_string( xml_get_error_code($sax) );
```

## Document Object Model (DOM)

```php
// Чтение XML-документа

// Создание объекта, экземпляра класса DomDocument
$dom = new DomDocument();

// Загрузка документа
$dom->load("catalog.xml");

// Получение коневого элемента
$root = $dom->documentElement;

// Получение типа узла
echo $root->nodeType; // 1

// Получение коллекции дочерних узлов (экземпляр класса DomNodeList)
$children = $root->childNodes;

// Получение текстового содержимого узла
$content = $root->textContent;

// Получение коллекции элементов с определённым именем
$books = $dom->getElementsByTagName("book");

// Создание/изменение XML-документа

// Создание объекта, экземпляра класса DomDocument
$dom = new DomDocument("1.0", "utf-8");

// Получение коневого элемента
$root = $dom->documentElement;

// Создание новых элементов
$book = $dom->createElement("book");
$title = $dom->createElement("title");

// Создание текстового узла
$text = $dom->createTextNode("Название книги");

// Добавление узлов к узлам
$title->appendChild($text);
$book->appendChild($title);
$root->appendChild($book);

// Другой вариант создания нового элемента
$author = $dom->createElement("author", "Автор книги");
 
// Добавляем узел к узлу перед другим узлом
$book->insertBefore($author, $title);

// Создаём секцию CDATA
$description = $dom->createElement("description");
$cdata = $dom->createCDATASection("...описание книги...");
$description->appendChild($cdata);
$book->appendChild($description);

// Сохраняем документ
$dom->save("catalog.xml");
```

## Использование SimpleXML

```php
// Загружаем документ и преобразуем его в объект
$sxml = simplexml_load_file("catalog.xml");

// Загружаем XML-строку и преобразуем его в объект
$sxml = simplexml_load_string("XML строка");

// Получение текста нужного элемента (название второй книги)
echo $sxml->book[1]->title;

// Получение атрибута элемента
echo $sxml->book[1]->title["lang"];

// Изменение текста нужного элемента (название первой книги)
$sxml->book[0]->title = "Новое название";

// Преобразование объекта в строку
$xml = $sxml->asXML();

// Запись строки в файл
file_put_contents("catalog.xml", $xml);
```

## Преобразование XML c XSL/T

```php
// Загрузка исходного XML-документа
$xml = new DomDocument();
$xml->load("catalog.xml");

// Загрузка таблицы стилей XSL
$xsl = new DomDocument();
$xsl->load("catalog.xsl");

// Создание XSLT процессора
$processor = new XSLTProcessor();

// Загрузка XSL в процессор
$processor->importStylesheet($xsl);

// Выполнение преобразования
echo $processor->transformToXML($xml);
```