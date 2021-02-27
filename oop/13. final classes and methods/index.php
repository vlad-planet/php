<?
# Финальные классы и методы

// Финальный класс
final class Breakfast{
	function eatFood($food){
		echo "Съели $food";
	}
}

class McBreakfast extends Breakfast{}
$obj = new McBreakfast(); // Ошибка!

class Math{
	// Финальный метод
	final function sum($num1, $num2){
		echo 'Сумма: ' . $num1 + $num2;
	}
}

class Algebra extends Math{
	function sum($num1, $num2){
		$result = $num1 + $num2;
		echo "Сумма: $num1 и $num2 = $result";
	}
}

$obj = new Algebra(); // Ошибка!
?>