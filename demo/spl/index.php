<?
# Встроенные классы и интерфейсы

## Класс Closure

// Обращение к функции через переменную
function Hello($name){
	echo "Привет, $name";
}
$func = "Hello";
$func("Мир!");

// Анонимная функция
$func = function($name){
	echo "Привет, $name\n";
};
$func("Мир!");

// Использование
$arr = [1, 2, 3, 4, 5];

// Стандартный вариант
function foo($v){
	return $v * 10;
}
$new_arr = array_map(foo, $arr);

// Хак
$new_arr = array_map(create_function('$v', '$v *10;'), $arr);

// Самый удобный вариант
$new_arr = array_map(function($v){
	return $v * 10;
}, $x);

// Closure (замыкание)
$string = "Hello, world!";
$closure = function() use ($string) { 
	echo $string
};
$closure();

// Переопределение значения внешней переменной
$x1 = 1;
$closure = function() use (&$x) {
	++$x;
};
echo $x; // 1
closure();
echo $x; // 2

// Использование
$mult = function($num){
	return function($x) use ($num){
		return $x * $num;
	};
};

$mult_by_2 = $mult(2);
$mult_by_3 = $mult(3);
echo $mult_by_2(2); // 4
echo $mult_by_2(5); // 10
echo $mult_by_3(2); // 6
echo $mult_by_3(5); // 15

// Использование в классах
class User{
	private $_name;
	public function __construct($n){ $this->_name = $n;}
	public function greet($greeting){
		return function() use ($greeting) {
			return "$greeting {$this->_name}!";
		};
	}
}
$user = new User("John");
$en = $user->greet("Hello");
echo $en();
$ru = $user->greet("Привет");
echo $ru();


#### Iterator extends Traversable

//mixed current ( void )
//scalar key ( void )
//void next ( void )
//void rewind ( void )
//boolean valid ( void )

//IteratorAggregate extends Traversable
//public Traversable getIterator ( void )


## Класс Generator

function numbers() {
	echo "START\n";
	for ($i = 0; $i < 5; ++$i) {
		yield $i;
	}
	echo "FINISH\n";
}
foreach (numbers() as $value){
	echo "VALUE: $value\n";
}

// Возврат ключей?
function gen() {
	yield 'a';
	yield 'b';
	yield 'name' => 'John';
	yield 'd';
	yield 10 => 'e';
	yield 'f';
}
foreach (gen() as $key => $value)
echo "$key : $value\n";

// Co-routines: принимаем значение!
function echoLogger() {
	while (true) {
		echo 'Log: ' . yield . "<br>";
	}
}

$logger = echoLogger();
$logger->send('Foo');
$logger->send('Bar');

// Комбинируем возврат и приём значений
function numbers() {
	$i = 0;
	while (true) {
		$cmd = (yield $i);
		++$i;
		if ($cmd == 'stop')
			return; // Выход из цикла
	}
}
$gen = numbers();
foreach ($gen as $v) {
	if ($v == 3)
		$gen->send('stop');
	echo $v;
}


## Рекурсивная итерация

//RecursiveArrayIterator extends ArrayIterator implements RecursiveIterator 
//RecursiveIteratorIterator implements OuterIterator,Traversable,Iterator

$arr = [1, [2, [3]], [4]];
$rit = new RecursiveArrayIterator($arr);
$rii = new RecursiveIteratorIterator($rit);
foreach ($rii as $key => $value) {
	$depth = $rit -> getDepth();
	echo "depth=$depth key=$key value=$value\n";
}
// depth=0 key=0 value=1
// depth=1 key=0 value=2
// depth=2 key=0 value=3
// depth=1 key=0 value=4



## Фильтрация элементов

//abstract FilterIterator extends IteratorIterator implements OuterIterator,Traversable,Iterator

class MyClass extends FilterIterator{
	public function accept() {
		return $this->getInnerIterator()->current() > 5;
	}
}
$arr = [5, 2, 7, 1, 9, 3, 6, 8];
$it = new ArrayIterator($arr);
$fit = new MyClass($it);
foreach ($fit as $value)
	echo $value . " ";
// 7 9 6 8


## Бесконечная итерация с объединением итераторов

//AppendIterator extends IteratorIterator implements OuterIterator,Traversable,Iterator


class MyObject {
	public function action() {
		// Что-то делаем
		return $boolean;
	}
}

$object1 = new MyObject();
$object2 = new MyObject();
$arrayIterator1 = new ArrayIterator( [$object1,$object2] );

$object3 = new MyObject();
$object4 = new MyObject();
$arrayIterator2 = new ArrayIterator( [$object3,$object4] );

// Объединение итераторов
$arrayIterator = new AppendIterator();
$arrayIterator->append($arrayIterator1);
$arrayIterator->append($arrayIterator2);


//InfiniteIterator extends IteratorIterator implements OuterIterator,Traversable,Iterator

// Бесконечная итерация
$it = new InfiniteIterator($arrayIterator);
foreach ($it as $object){
	$r = $object -> action();
	if(!$r) break;
}


# Массив как объект

//ArrayObject implements IteratorAggregate,ArrayAccess,Traversable,Iterator,Countable

$usersArr = [
'Вася', 'Петя', 'Иван', 'Маша', 'Джон','Майк', 'Даша', 'Наташа', 'Света'
];
$usersObj = new ArrayObject($usersArr);

// Добавляем новое значение
$usersObj->append('Ира');

//Получаем копию массива
$usersArrCopy = $usersObj->getArrayCopy();

// Проверяем, существует ли пятый элемент массива
if ($usersObj->offsetExists(4)){
	
	// Меняем значение пятого элемента массива
	$usersObj->offsetSet(4, "Игорь");
}

// Удаляем шестой элемент массива
$usersObj->offsetUnset(5);

// Получаем количество элементов массива
echo $usersObj->count();

// Сортируем по алфавиту
$usersObj->natcasesort();

// Выводим данные массива
for($it = $usersObj->getIterator(); $it->valid();

	$it->next()){
		echo $it->key() . ': ' . $it->current() . "\n";
	}
}

// Копия массива
$usersObjCopy = new ArrayObject($usersArrCopy);

// Выводим данные из копии массива
for($it = $usersObjCopy->getIterator(); $it->valid();

$it->next()){
	echo $it->key() . ': ' . $it->current() . "\n";
}

## Структуры данных: Очередь

//SplDoublyLinkedList implements Iterator, Countable, ArrayAccess 
//SplQueue extends SplDoublyLinkedList

class Work {
	public function __construct($title) {
		$this->title = $title;
	}
	public function doIt(){
		return $this->title;
	}
}
$work1 = new Work("Сходить в магазин");
$work2 = new Work("Прочитать книгу");
$work3 = new Work("Тупить в телевизор");

$queue = new SplQueue(); //$queue = new SplPriorityQueue();

$queue -> enqueue($work1); //$queue -> insert($work1, 1);
$queue -> enqueue($work2); //$queue -> insert($work2, 3);
$queue -> enqueue($work3); //$queue -> insert($work3, 2);

while ($queue -> count() > 0){
	echo $queue -> dequeue() -> doIt();
}

//foreach ($queue as $work){
//	echo $work -> doIt();
//}


## Структуры данных: Очередь с приоритетом

//SplPriorityQueue implements Iterator, Countable

class Work {
	public function __construct($title) {
		$this->title = $title;
	}
	public function doIt(){
		return $this->title;
	}
}

$work1 = new Work("Сходить в магазин");
$work2 = new Work("Прочитать книгу");
$work3 = new Work("Тупить в телевизор");
$queue = new SplPriorityQueue();

$queue -> insert($work1, 1);
$queue -> insert($work2, 3);
$queue -> insert($work3, 2);

foreach ($queue as $work){
	echo $work -> doIt();
}


## Структуры данных: Куча

//abstract SplHeap implements Iterator,Countable
//SplMinHeap extends SplHeap implements Iterator,Countable
//SplMaxHeap extends SplHeap implements Iterator,Countable

$minHeap = new SplMinHeap();

$minHeap -> insert(2);
$minHeap -> insert(3);
$minHeap -> insert(1);

foreach ($minHeap as $value)
	echo $value . " "; // 1 2 3
	
$maxHeap = new SplMaxHeap();
$maxHeap -> insert(2);
$maxHeap -> insert(3);
$maxHeap -> insert(1);

foreach ($maxHeap as $value)
	echo $value . " "; // 3 2 1


## Автозагрузка классов

function loadClass ($class_name) {
	require_once "classes/$class_name.class.php";
}
function loadInterface ($class_name) {
	require_once "classes/$class_name.interface.php";
}
function loadSomething ($class_name) {
	// ...
}
class Main{
	public static function autoload(){
		require_once "classes/$class_name.class.php";
	}
}

// Регистрация функций
spl_autoload_register('loadClass');
spl_autoload_register('loadSomething');
spl_autoload_register('loadInterface', true, 1);

// Список зарегистрированных функций
var_dump(spl_autoload_functions());

// Удаление функции из списка зарегистрированных
spl_autoload_unregister('loadSomething');

// Регистрация статического метода класса
spl_autoload_register(['Main', 'autoload']);
?>