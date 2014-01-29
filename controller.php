<?php
	
	include 'Table.php';

	if (isset($_POST['ok'])) {
        
        $rows = floor($_POST['rows']);
        $cols = floor($_POST['cols']);
	
		if (empty($rows) || empty($cols)) {
		    echo "Empty fields and zeros are not allowed.";
		} elseif ($rows < 0 || $cols < 0) {
			echo "Values must be greater than 0.";
		} else {
			$t = new Table($rows, $cols);
			$t->generateArray();
			echo $t->generateHtmlTable();
		}
	}

?>