<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>���� � �����</title>
</head>

<body>
<h1>
	<a href="http://ru.php.net/manual/ru/ref.datetime.php">
		���� � �����
	</a>
</h1>
UNIX timestamp: <?=time()?><br>
�������: <?=date("d.m.Y H:i:s")?><br>
����� 100 ����: <?=date("d.m.Y", time() + 100*24*60*60)?><br>
Swatch Internet: <?=date("B")?><br>
���� � ������� RFC2822: <?=date("r")?><br>
1 ������ 2006 ���� � ������: <?=mktime(0,0,0,1,1,2006)?><br>
����� UNIX �������������: <?=date("d.m.Y H:i:s", 0x7FFFFFFF)?><br>
<hr>
<a href="http://ru.php.net/manual/ru/function.date.php">date()</a><br>
<a href="http://ru.php.net/manual/ru/function.mktime.php">mktime()</a><br>
</body>
</html>
