<?
include 'project.php';

class Connection{
	function __construct(){
		echo __CLASS__.'<br>';
	}
}
echo 'Пространство GLOBAL:<br>';
$obj = new Connection;
?>