<HTML>
<HEAD>
<TITLE>fputs</TITLE>
</HEAD>
<BODY>
<?
	$myFile = fopen("data.txt", "a+") or die("Не могу открыть файл");
		fputs($myFile, "\nLine six");
	}
	fclose($myFile);

	
	file_put_contents('data.txt', "\nLine six"); // fopen с режимом W
	file_put_contents('data.txt', "\nLine six", FILE_APPEND); // fopen с режимом A
?>
</BODY>
</HTML>