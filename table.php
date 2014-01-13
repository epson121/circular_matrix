<?php
	if (isset($_POST['ok'])) {
        
        $rows = floor($_POST['rows']);
        $cols = floor($_POST['cols']);
	
		if (empty($rows) || empty($cols)) {
		    echo "Empty fields and zeros are not allowed.";
		} elseif ($rows < 0 || $cols < 0) {
			echo "Values must be greater than 0.";
		} else {
			echo generate_table($rows, $cols);
		}
	}

	/**
	 * Generates HTML table consisting $rows x $cols
	 * @param int $rows - number of rows 
	 * @param int $cols - number of columns
	 * @return generated HTML
	 */
	function generate_table($rows, $cols) { 
		$res = array();
	    $i = 1;

	    // booleans for direction
	    $row = true;
	    $left = true;
	    $up = false;
	    
	    // current x position
	    $px = $rows - 1;
	    // current y position
	    $py = $cols - 1;
    	
    	while ($i <= $rows * $cols) {
    		// set the position
    		$res[$px][$py] = $i;
    		if ($row){
    			if ($left) {
    				if ($py - 1 >= 0) {
    					$py -= 1;
    				} else {
    					$px -= 1;
    				}
					if ($py == 0 || $res[$px][$py-1] != null) {
						$row = false;
						$up = true;
						$left = false;
					}
    			} else {
    				$py += 1;
					if ($py == $cols-1 || $res[$px][$py+1] != null) {
						$row = false;
						$up = false;
						$left = true;
					}
    			}
    		} else {
				if ($up) {
					$px -= 1;
					if ($px == 0 || $res[$px-1][$py] != null) {
						$row = true;
						$up = false;
						$left = false;
					}
				} else {
					$px += 1;
					if ($px == $rows-1 or $res[$px+1][$py] != null) {
						$row = true;
						$up = false;
						$left = true;
					}
				}
			}
			$i += 1;
    	}
    	
    	// build the table
    	$result = "";
    	$result .= '<table border="1"><tbody>';
    	for ($i = 0; $i < $rows; $i++) {
    		$result .= '<tr>';
    		for ($j = 0; $j < $cols; $j++) {
    			$result .= '<td>' . $res[$i][$j] . "</td>";
    		}
    		$result .= '</tr>';
    	}
    	$result .= '</tbody></table>';

    	return $result;
	} 
?>