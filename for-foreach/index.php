<?
# Цыклы for / foreach

#### for
for ($i = 1; $i <= 10; $i++) {
	echo $i;
}

for ($i = 1; $i <= 10; print $i++);

#### foreach

$arr = ['a'=>'one', 'b'=>'two', 'c'=>'three'];

foreach ($arr as $val) {
	echo "$val\n";
}


foreach ($arr as $key => $val) {
	echo "$key : $val\n";
}

foreach ($arr as &$val) {
	$val *= 10;
}
?>