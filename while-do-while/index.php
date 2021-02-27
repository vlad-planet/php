<?
# Циклы while / do-while

#### while

$i = 1;

while ($i <= 10) {
	echo $i++;
}

#### do-while

$i = 100;

do {
	echo $i++;
} while ($i <= 10);

#### Прерывание цикла
$i = 1;

while ($i <= 10) {
	echo $i++;
	if($i == 5)
		break;
}

#### Продолжение цикла

$i = 0;

while ($i < 9) {
	$i++;
	if($i == 5)
		continue;
	echo $i;
}

#### Управление вложенными циклами

$i = 1; $j = 1;

while ($j <= 10) {
	while ($i <= 10) {
		echo $i++;
		if($i == 5)
			break 2;
	}
	$j++;
}

?>