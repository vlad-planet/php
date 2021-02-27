<?php
$xmlstring = <<<XML
<?xml version = "1.0" encoding="windows-1251"?>
<catalog xmlns:my="http://mysuperpupermegasite.ru/catalog">
	<book>
		<category id="26">
			<author>����� �����</author>
			<my:title>����� �����</my:title>
			<title>XML � IE5</title>
			<price>200</price>
		</category>
		<category id="27">
			<author>������� �������</author>
			<my:title>˸��</my:title>
			<title>���������� XSLT</title>
			<price>150</price>
		</category>
		<category id="28">
			<author>������ �. ����</author>
			<my:title>������ ������</my:title>
			<title>XML. ����������</title>
			<price>100</price>
		</category>
	</book>
</catalog>
XML;
?>

<?php
/*
$sxi =new SimpleXMLIterator($xmlstring);

$foo = $sxi->xpath('/catalog/book/category/title');

foreach ($foo as $k=>$v){
	echo $v.'<br />';
}
*/
?>

<?php

$sxi =new SimpleXMLIterator($xmlstring);

//$sxi-> registerXPathNamespace('my', 'http://mysuperpupermegasite.ru/catalog');

$result = $sxi->xpath('//my:title');

foreach($sxi->getDocNamespaces('book') as $ns){
	echo $ns.'<br>';
}

foreach ($result as $k=>$v){
	echo $v.'<br>';
}

?>