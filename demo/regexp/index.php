<?
# Регулярные выражения

#### Базовое использование

// . Любой символом, кроме символа перевода строки.
preg_match('/./', 'PHP 7', $matches);
echo $matches[0]; // Р

preg_match('/PHP.7/', 'PHP 7', $matches);
echo $matches[0]; // РHP 7

preg_match('/PHP.7/', 'PHP-7', $matches);
echo $matches[0]; // РHP-7

preg_match('/PHP.7/', 'PHP7', $matches);
echo $matches[0]; //

// \ Экранирование метасимволов и разделителей
preg_match('/.com/', 'site.com', $matches);
echo $matches[0]; // .com

preg_match('/.com/', 'site-com', $matches);
echo $matches[0]; // -com

preg_match('/\.com/', 'site-com', $matches);
echo $matches[0]; //

preg_match('/\.com/', 'site.com', $matches);
echo $matches[0]; // .com

#### Повторения

/*
{m} точное вхождение
{m,n} минимум и максимум
{m,} минимум
*/

preg_match('/tre{1,2}f/', 'trf', $matches);
echo $matches[0]; //

preg_match('/trе{1,2}f/', 'tref', $matches);
echo $matches[0]; // tref

preg_match('/trе{1,2}f/', 'treef', $matches);
echo $matches[0]; // treef

preg_match('/trе{1,2}f/', 'treeef', $matches);
echo $matches[0]; //

preg_match('/fo{2,}ba{2}r/', 'foobaar', $matches);
echo $matches[0]; // foobaar

preg_match('/fo{2,}ba{2}r/', 'fooooooobaar', $matches);
echo $matches[0]; // fooooooobaar

preg_match('/fo{2,}ba{2}r/', 'fobaar', $matches);
echo $matches[0]; //

/* Квантификаторы
? что и {0,1}
+ что и {1,}
* что и {0,}
*/

preg_match('/PHP.?5/', 'PHP 5', $matches);
echo $matches[0]; // PHP 5

preg_match('/PHP.?5/', 'PHP5', $matches);
echo $matches[0]; // PHP5

preg_match('/a+b/', 'caaabc', $matches);
echo $matches[0]; // aaab

preg_match('/a+b/', 'cabc', $matches);
echo $matches[0]; // ab

preg_match('/a+b/', 'cbc', $matches);
echo $matches[0]; //

preg_match('/a*b/', 'caaaabc', $matches);
echo $matches[0]; // aaaab

preg_match('/a*b/', 'cbc', $matches);
echo $matches[0]; // b

#### Метасимволы

// ^ Ограничение начала строки
preg_match('/^abc/', 'abcd', $matches);
echo $matches[0]; // abc

preg_match('/^abc/', 'xabcd', $matches);
echo $matches[0]; //

// $ Ограничение конца строки
preg_match('/xyz$/', 'abcdxyz', $matches);
echo $matches[0]; // xyz

preg_match('/xyz$/', 'xyza', $matches);
echo $matches[0]; //

// [...] Kласс искомых символов.
preg_match('/[0-9]+/', 'PHP is released in 1995',
$matches);
echo $matches[0]; // 1995

preg_match('/[^0-9]+/', 'PHP is released in 1995',
$matches);
echo $matches[0]; // PHP is released in

preg_match('/[a-zA-Z ]+/', 'PHP is released in 1995',
$matches);
echo $matches[0]; // PHP is released in

preg_match('/[^a-zA-Z ]+/', 'PHP is released in 1995',
$matches);
echo $matches[0]; // 1995

// (...) Группировка элементов.
$subject = 'PHP is released in 1995';
$pattern = '/PHP [a-zA-Z ]+([12][0-9])([0-9]{2})/';
preg_match($pattern, $subject, $matches);
print_r($matches);

// [0]=>PHP is released in 1995, [1]=>19, [2]=>05


#### Специальные последовательности

// \? \+ \* \[ \] \{ \} \\ Экранирование
$subject = '4**';
$pattern_in_apos = '/^4\*\*$/';
$pattern_in_quot = "/^4\\*\\*$/";
$subject = 'РНР\5';
$pattern_in_apos = '/^PHP\\\5$/';
$pattern_in_quot = "/^РНР\\\\5$/";

/*
\t \n \f \r (ASCII 9, 10, 12, 13)
\d ( [0-9] )
\D ( [^0-9] )
\s ( [\t\n\f\r ] )
\S ( [^\t\n\f\r ] )
\w ( Любая буква, цифра, символ подчеркивания )
\W ( Противоположность \w )
*/

// \b ( Позиция между соседними символами \w и \W )
$string = "##Testing123##";
preg_match('/\b.+\b/', $string, $matches);
echo $matches[0]; // Testing123

//\B ( Противоположность \b )

// Жадные квантификаторы: * и +
$subject = '<b>I am bold.</b> <i>I am italic.</i> <b>I
am also bold.</b>';
preg_match('#<b>(.+)</b>#', $subject, $matches);
echo $matches[1];

// I am bold.</b> <i>I am italic.</i> <b>I am alsobold.

// Таблетка от жадности: ?
preg_match('#<b>(.+?)</b>#', $subject, $matches);
echo $matches[1]; // I am bold.

#### Модификаторы

// i ( [a-zA-Z] )

// m Многострочный поиск
$subject = "ABC\nDEF\nGHI";
preg_match('/^DEF/', $subject, $matches);
echo $matches[0]; //
preg_match('/^DEF/m', $subject, $matches);
echo $matches[0]; // DEF

// S Однострочный поиск: "." = . + перевод строки
$subject = "ABC\nDEF\nGHI";
preg_match('/BC.DE/', $subject, $matches);
echo $matches[0]; //
preg_match('/BC.DE/S', $subject, $matches);
echo $matches[0]; // BC\nDE

// x Пропуск пробелов и комментариев(#) в тексте шаблона
$subject = "ABC\nDEF\nGHI";
preg_match('/A B C/', $subject, $matches);
echo $matches[0]; //
preg_match('/A B C/x', $subject, $matches);
echo $matches[0]; // ABC

// D Что и $, если строка не заканчивается \n
preg_match('/BC$/', 'ABC\n', $matches);
echo $matches[0]; // BC

preg_match('/BC$/D', 'ABC\n', $matches);
echo $matches[0]; //

// A Что и ^ (начало строки)
preg_match('/[a-c]{3}/i', '123ABC', $matches);

echo $matches[0]; // ABC
preg_match('/[a-c]{3}/iA', '123ABC', $matches);

echo $matches[0]; //

// U Ленивость по-умолчанию
$subject = '<b>I am bold.</b> <i>I am italic.</i> <b>I
am also bold.</b>';
preg_match('#<b>(.+)</b>#U', $subject, $matches);
echo $matches[1]; // I am bold.

#### Функции

// Функции поиска
$subject = '<b>I am bold.</b> <i>I am italic.</i>';
$pattern = '#<[^>]+>(.*)</[^>]+>#U';
preg_match($pattern, $subject, $matches);

print_r($matches); // [0]=><b>I am bold.</b>, [1]=>Iam bold.
preg_match_all($pattern, $subject, $matches,
PREG_PATTERN_ORDER);
print_r($matches);

// [0][0] => <b>I am bold.</b>, [0][1] => <i>I amitalic.</i>

// [1][0] => I am bold., [1][1] => I am italic.
preg_match_all($pattern, $subject, $matches,
PREG_SET_ORDER);
print_r($matches);

// [0][0] => <b>I am bold.</b>, [0][1] => I am bold.
// [1][0] => <i>I am italic.</i>, [1][1] => I am italic.

// Функция замены
$subject = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replace = '$2 $1, $3'; // "\$2 \$1, \$3"
echo preg_replace($pattern, $replace, $subject);

// Функция разделения
$subject = 'hypertext language, programming';
$pattern = '/[\s,]+/';
$words = preg_split($pattern, $subject);
print_r($words);

// [0]=>hypertext, [1]=>language, [2]=>programming

$chars = preg_split('//', 'PHP', 0,PREG_SPLIT_NO_EMPTY);
print_r($chars); // [0] => P, [1] => H, [2] => 
?>