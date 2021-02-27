<?php
# Конструкция elseif/else if

if ($a > $b) {
    echo "a больше, чем b";
} elseif ($a == $b) {
    echo "a равен b";
} else {
    echo "a меньше, чем b";
}

#### Второй вариант синтаксиса

if($a > $b):
    echo $a." больше, чем ".$b;
elseif($a == $b):
    echo $a." равно ".$b;
else:
    echo "a меньше, чем b";
endif;
?>
