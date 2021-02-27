<?php
foreach(get_class_methods(new ArrayObject()) as $key=>$method){
	echo $key.' -> '.$method.'<br />';
}
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');

// create the array object
$arrayObj = new ArrayObject($array);

for($iterator = $arrayObj->getIterator();$iterator->valid();$iterator->next()){
    echo $iterator->key() . ' => ' . $iterator->current() . '<br />';
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');
$arrayObj = new ArrayObject($array);

//��������� ����� ��������
$arrayObj->append('���');

for($iterator = $arrayObj->getIterator();$iterator->valid();$iterator->next()){
	echo $iterator->key() . ' -> ' . $iterator->current() . '<br />';
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');
$arrayObj = new ArrayObject($array);

//��������� �� ��������
$arrayObj->natcasesort();

for($iterator = $arrayObj->getIterator();$iterator->valid();$iterator->next()){
	echo $iterator->key() . ' -> ' . $iterator->current() . '<br />';
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');
$arrayObj = new ArrayObject($array);

//�������� ���������� ��������� �������
echo $arrayObj->count();
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');
$arrayObj = new ArrayObject($array);

//������� ����� ������� �������
$arrayObj->offsetUnset(4);

for($iterator = $arrayObj->getIterator();$iterator->valid();$iterator->next()){
	echo $iterator->key() . ' -> ' . $iterator->current() . '<br />';
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');
$arrayObj = new ArrayObject($array);

if ($arrayObj->offsetExists(4)){
	//���������, ���������� �� ����� ������� �������
	echo 'Offset Exists</br />';
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');

try {
	$arrayObj = new ArrayObject($array);

	//������ �������� ������ �������� �������
	$arrayObj->offsetSet(5, "�����");

	for($iterator = $arrayObj->getIterator();$iterator->valid();$iterator->next()){
		echo $iterator->key() . ' -> ' . $iterator->current() . '<br />';
	}

}catch (Exception $e){
	echo $e->getMessage();
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');

try {
	$arrayObj = new ArrayObject($array);

	//�������� �������� ������ ������� �������
	echo $arrayObj->offsetGet(4);
}catch(Exception $e){
	echo $e->getMessage();
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');

try {
	$arrayObj = new ArrayObject($array);

	//�������� ����� �������
	$arrayObjCopy = $arrayObj->getArrayCopy();

	for($iterator = $arrayObjCopy->getIterator();$iterator->valid();$iterator->next()){
		echo $iterator->key() . ' => ' . $iterator->current() . '<br />';
	}
}catch (Exception $e){
	echo $e->getMessage();
}
*/
?>

<?php
/*
$array = array('����', '����', '����', '����', '����', '����', '������', '�����');

try {
	$arrayObj = new ArrayObject($array);

	//������ ����� ������
	$arrayObjCopy = new ArrayObject($arrayObj->getArrayCopy());

	for($iterator = $arrayObjCopy->getIterator();$iterator->valid();$iterator->next()){
		echo $iterator->key() . ' => ' . $iterator->current() . '<br />';
	}
}catch (Exception $e){
	echo $e->getMessage();
}
*/
?>