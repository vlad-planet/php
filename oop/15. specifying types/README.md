
# Уточнение типа

```php
// Базовое использование
class MyClass{}
$my = new MyClass();
$std = new stdClass();

// Ожидается передача объекта, экземпляра класса MyClass
function foo(MyClass $obj){}

	foo($my); // Отработает успешно
	foo($std); // Ошибка!
	
class MyClass{
	function func(){
		return __METHOD__;
	}

	static function staticFunc(){
		return __METHOD__;
	}

	 function __invoke(){
		return __METHOD__;
	}
}
$obj = new MyClass();

// Ожидается то, что можно вызвать
function foo(callable $x){
	if(func_num_args() == 2){
		$m = func_get_arg(1);
		return $x->$m();
	}elseif(is_array($x)){
		return $x[0]::$m[1]();
	}else{
		return $x();
	}
}

echo foo($obj, "func"); // MyClass::func
echo foo(["MyClass", "staticFunc"]); // MyClass::staticFunc
echo foo($obj); // MyClass::__invoke
```