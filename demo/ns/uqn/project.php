<?
namespace Project;

class Connection{
	function __construct(){
		echo __CLASS__.'<br>';
	}
}
echo 'Пространство PROJECT:<br>';
$obj = new Connection;
?>