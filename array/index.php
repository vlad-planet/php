<?
# Массивы

#### Простой массив

$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// Начиная с PHP 5.4
$array = [
    "foo" => "bar",
    "bar" => "foo",
];

#### Индексированные массивы без ключа

$array = array("foo", "bar", "hello", "world");
var_dump($array);

array(4) {
  [0]=>
  string(3) "foo"
  [1]=>
  string(3) "bar"
  [2]=>
  string(5) "hello"
  [3]=>
  string(5) "world"
}


#### Ассоциативный массив

$user = [
	"name"=>"John",
	"login"=>"root",
	"password"=>"1234",
	"age"=>25,
	true
];


#### Многомерный массив

$users[0] = [
];


#### Рекурсивные и многомерные массивы

$fruits = array ( "фрукты"  => array ( "a" => "апельсин",
                                       "b" => "банан",
                                       "c" => "яблоко"
                                     ),
                  "числа"   => array ( 1,
                                       2,
                                       3,
                                       4,
                                       5,
                                       6
                                     ),
                  "дырки"   => array (      "первая",
                                       5 => "вторая",
                                            "третья"
                                     )
                );
?>