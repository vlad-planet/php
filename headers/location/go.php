<?
$url = strip_tags($_GET["url"]);
if ($url) {
	header("Location: $url");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>���� ����������</title>
</head>

<body>
<form action="<?=$_SERVER["PHP_SELF"]?>">
	���� ����������:
	<select name="url" size="1">
		<option value="http://www.google.ru">����</option>
		<option value="http://www.yandex.ru">������</option>
		<option value="http://www.rambler.ru">�������</option>
	</select>
	<input type="submit" value="GO!">
</form>

</body>
</html>
