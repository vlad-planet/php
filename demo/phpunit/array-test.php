<?php
// ������������ ���������� �������

$arr = array();
// $arr - ������ ���� ������ ������.

$arr[] = 'element';
// $arr - �������� ���� �������.
?>

<?php
// ������������� ������ �� ����� ��� �������� ���������� �������

$arr = array();
print count($arr) . "\n";

$arr[] = 'element';
print count($arr) . "\n";
?>

<?php
//������������ ���������� �������, ��������� ���������� ���������� � ������������ ��������
$arr = array();
print count($arr) == 0 ? "ok\n" : "not ok\n";

$arr[] = 'element';
print count($arr) == 1 ? "ok\n" : "not ok\n";
?>

<?php
// ������������� ������� ����������� ��� ������������ ���������� �������

function assertTrue($condition){
	if(!$condition) {
		throw new Exception('Assertion failed.');
	}
}
$arr = array();
assertTrue(count($arr) == 0);

$arr[] = 'element';
assertTrue(count($arr) == 1);
?>