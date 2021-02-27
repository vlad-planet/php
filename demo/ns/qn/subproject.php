<?
namespace Project\Sub;

class Connection{
	function __construct(){
		echo __CLASS__.'<br>';
	}
}
echo 'Пространство PROJECT\SUB:<br>';
$obj = new Connection;
?>