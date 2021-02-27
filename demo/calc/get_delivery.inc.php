<?php
foreach($delivery as $item){
		echo <<<LABEL
		<hr>
			<p align="right">{$item['name']}
			<a href="index.php?del={$item['id']}">Удалить</a>
		</p>
LABEL;
}
?>