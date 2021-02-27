<?
# Объявление пространства имён

#### Объявление

namespace MyModule; // самая первая строка!
const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */ }


#### Иерархия пространств имён

namespace MyModule\Sub\Level;
const CONNECT_OK = 1;
class Connection { /* ... */ }
function connect() { /* ... */ }


#### Объявления в одном файле (не рекомендуется)

namespace MyModule{
	const CONNECT_OK = 1;
	class Connection { /* ... */ }
	function connect() { /* ... */ }
}

/* Никакого пространства между блоками! */
namespace AnotherModule{
	const CONNECT_OK = 1;
	class Connection { /* ... */ }
	function connect() { /* ... */ }
}


#### Лучше, но не надо

namespace MyModule{
	const CONNECT_OK = 1;
	class Connection { /* ... */ }
	function connect() { /* ... */ }
}
namespace{
	/*
	Глобальное пространство имён
	Здесь основной код
	*/
}

## Надо так

##### Файл MyModule.php

namespace MyModule;
/* ... */

####  Файл AnotherModule.php

namespace AnotherModule;
/* ... */

#### Файл index.php

require_once "MyModule.php";
require_once "AnotherModule.php";

/*
А это глобальное пространство имён
Здесь наш код
*/


## Объединение пространств имён

#### Файл MyModule.php

namespace MyModule;
/* ... */

#### Файл AnotherModule.php

namespace AnotherModule;
require_once "MyModule.php";
/* ... */


## Правила доступа

#### Unqualified name

require_once "MyModule.php";
echo MyModule\E_ALL; // Константа из MyModule
echo \E_ALL; // Глобальная константа

#### Qualified name

require_once "MyModule.php";
echo \MyModule\E_ALL; // Константа из MyModule
echo \E_ALL; // Глобальная константа

## Импорт и псевдонимы

namespace Foo;

// Здесь подключаются все необходимые файлы
class Bar { /*...*/ }
use My\Full\Classname as Bar;
use My\Full\NSname; // My\Full\NSname as NSname
use \ArrayObject; // импорт глобального класса

$obj = new Bar; // объект класса My\Full\Classname
$obj = new namespace\Bar; // объект класса Foo\Bar

NSname\subns\func(); // функция My\Full\NSname\subns\func

$obj = new ArrayObject(array(1)); // глобальный ArrayObject
?>