<?php
$xmlstring = <<<XML
<?xml version = "1.0" encoding="windows-1251"?>
<person>
	<name>����</name>
	<name>����</name>
	<name>����</name>
	<name>����</name>
	<name>����</name>
	<name>����</name>
	<name>����</name>
	<name>����</name>
</person>
XML;

$offset = 3;
$limit = 2;


$it = new LimitIterator(new SimpleXMLIterator($xmlstring), $offset, $limit);

foreach($it as $r){
	echo $it->key().' -- '.$it->current().'<br />';
}
?>