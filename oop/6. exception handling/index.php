<?
# Обработка исключений

function test($var = false){
	try {
		echo "Start\n";
		throw new Exception('$var is false!');
	echo "Continue\n";
		if(!$var)
	}catch(Exception $e){
		echo "Exception: " . $e->getMessage() . "\n";
		echo "in file: " . $e->getFile() . "\n";
		echo "on line: " . $e->getLine() . "\n";
	}
		echo "The end\n";
}

var_dump(test(), test(1));

// Надо получить ответ от последней функции в цепочке в случае ошибки
// foo() -> bar() -> … -> baz()
// foo() <- bar() <- … <- baz()

function foo(){
	$x = bar();
if(!$x)
	echo "Плохо";
else
	echo "Хорошо";
}

function bar(){
	return baz();
}

// ...
function baz(){
	// Что-то делаем
	if(!$param)
		return false;
	return true;
}

// Проброс исключения
function foo(){
	try {
		bar();
		echo "Хорошо";
	}catch(Exception $e){
		echo $e->getMessage();
	}
}


function bar(){
	baz();
}

// ...
function baz(){
	// Что-то делаем
	if(!$param)
		throw new Exception("Плохо!");
}

// Создание пользовательских исключений
class MathException extends Exception{
	
	function __construct($msg){
		parent::__construct($msg);
	}

	function someMethod(){
		return __CLASS__;
	}
}

try {
	$x = rand(5, 15);
	$y = rand(0, 1);

	if($y == 0) // Генерируем собственное исключение
		throw new MathException("На 0 делить нельзя!");
	if($y < 0) // Генерируем встроенное исключение
		throw new Exception("Что-то случилось!");
	echo $x / $y;
}catch(MathException $e){
	echo $e->someMethod() . ":" . $e->getMessage();
}catch(Exception $e){
	echo $e->getMessage();
}

// Внимание!
try {
	$x = rand(5, 15);
	$y = rand(0, 1);

	if($y == 0) // Генерируем собственное исключение
		throw new MathException("На 0 делить нельзя!");
	if($y < 0) // Генерируем встроенное исключение
		throw new Exception("Что-то случилось!");
	echo $x / $y;
}catch(Exception $e){
	echo $e->getMessage(); // Попадём сюда!
}catch(MathException $e){
	echo $e->someMethod() . ":" . $e->getMessage();
	echo $e->someMethod() . ":" . $e->getMessage();
}

// Финализация
function test($var = false){
	 try {
	 echo "TRY\n";
	if(!$var)
		throw new Exception("Error");
	}catch(Exception $e){
		echo "CATCH\n";
	}finally{
		echo "FINALLY\n";
	}
}
var_dump(test(), test(1));

// Возвращаем значения
function test($var = false){
 try {
 echo "TRY\n";
	if(!$var)
		throw new Exception("Error");
		return 1;
	}catch(Exception $e){
		echo "CATCH\n";
		return 2;
	}finally{
		echo "FINALLY\n";
	return 3; // Можно закомментировать эту строку
	}
}
var_dump(test(), test(1));
?>