# Цыклы for / foreach

#### for

```php
for ($i = 1; $i <= 10; $i++) {
	echo $i;
}

for ($i = 1; $i <= 10; print $i++);
```

#### foreach

```php
$arr = ['a'=>'one', 'b'=>'two', 'c'=>'three'];

foreach ($arr as $val) {
	echo "$val\n";
}
```

```php
foreach ($arr as $key => $val) {
	echo "$key : $val\n";
}
```

```php
foreach ($arr as &$val) {
 $val *= 10;
}
```