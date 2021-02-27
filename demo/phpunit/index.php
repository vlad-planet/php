<?
# Тестирование кода

#### Использование phpUnit

// Использование утверждений
class MyClassTest extends PHPUnit_Framework_TestCase{
	public function testMyFunction(){
		echo $this->assertEquals(10, 10); // true
		echo $this->assertEquals(10, 9); // false
		echo $this->assertTrue(1); // true
		echo $this->assertTrue(0); // false
		echo $this->assertFalse(1); // false
		echo $this->assertFalse(0); // true
	}
}

// Использование зависимостей
class MyClassTest extends PHPUnit_Framework_TestCase{
	public function testOne(){
		return 1;
	}
	/**
	* @depends testOne
	*/
	public function testTwo($num){
		echo $this->assertEquals($num, 1);
	}
}

// Использование источников данных
class MyClassTest extends PHPUnit_Framework_TestCase{
	/**
	* @dataProvider provider
	*/
	public function testTwo($num1, $num2){
		echo $this->assertEquals($num, $num2);
	}
	public function provider(){
		return [[1, 1], [2, 2], [3, 4], [4, 4]];
	}
}

// Тестовые окружения
class MyClassTest extends PHPUnit_Framework_TestCase{
	public static function setUpBeforeClass(){
		echo "Start\n";
	}
	protected function setUp(){
		echo "Test start\n";
	}
	protected function assertPreConditions(){
		echo "Assertion start\n";
	}
	public function testOne(){
		echo $this->assertTrue(true);
	}
	protected function assertPostConditions(){
		echo "Assertion finish\n";
	}
	protected function tearDown(){
		echo "Test finish\n";
	}
	public static function tearDownAfterClass(){
		echo "Finish\n";
	}
}


#### Использование покрытия

// phpunit --coverage-html "куда" "файл с тестами"
?>