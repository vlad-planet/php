<?php
$os = new SplObjectStorage();

$person = new stdClass();// ����������� ������
$person->name = "John";
$person->age = "25";

$os->attach($person); //��������� ������ � storage

foreach ($os as $object){
	print_r($object);
	echo "<br>";
}

$person->name = "Mike"; //������ ���
echo str_repeat("-",30)."<br>"; //������ �����

foreach ($os as $object){
	print_r($object);
	echo "<br>";
}

$person2 = new stdClass();
$person2->name = "Vasya";
$person2->age = "18";

$os->attach($person2);

echo str_repeat("-",30)."<br>";

foreach ($os as $object){
	print_r($object);
	echo "<br>";
}

if($os->contains($person))
	echo "� ��� ������� ������ person";
else
	echo "� ��� ��� ������� person";

$os->rewind();
echo "<br>" . $os->current()->name;

$os->detach($person); //������� ������ �� ���������

echo "<br>".str_repeat("-",30)."<br>";
foreach ($os as $object){
	print_r($object);
	echo "<br>";
}
?>
<?php
/*
foreach(get_class_methods(SplObjectStorage) as $key=>$method){
	echo $key.' -> '.$method.'<br />';
}
*/
?>