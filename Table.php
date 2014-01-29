<?php

	class Table {
		public $rows = null;
		public $cols =null;
		private $res = null;
		// inital x direction
		private $xDirection;
		// initial y direction(to left)
		private $yDirection;

		function __construct($rows, $cols) {
			$this->rows = $rows;
			$this->cols = $cols;
			$this->xDirection = 0;
			$this->yDirection = -1;
		}

		private function goLeft() {
			$this->xDirection = 0;
    		$this->yDirection = -1;
		}

		private function goUp() {
			$this->xDirection = -1;
    		$this->yDirection = 0;
		}

		private function goRight() {
			$this->xDirection = 0;
    		$this->yDirection = 1;
		}

		private function goDown() {
			$this->xDirection = 1;
    		$this->yDirection = 0;
		}

		private $directions = array(
		  	"left" => "goLeft",
   			'up' => "goUp",
   			'right' => "goRight",
   			'down' => "goDown"
		);

		public function changeDirection($index) {
			$keys = array_keys($this->directions);
			call_user_func(array($this, $this->directions[$keys[$index]]));
		}

		public function generateArray() { 
			$this->res = array();
			$counter = 1;
			$directionCounter = 1;

		   	$px = $this->rows - 1;
		   	$py = $this->cols - 1;

		   	while ($counter <= ($this->rows * $this->cols)){
		   		$this->res[$px][$py] = $counter;

		   		$next_px = $px + $this->xDirection;
		   		$next_py = $py + $this->yDirection;

		   		if ($next_px < 0 || $next_px >= $this->rows || $next_py < 0 || $next_py >= $this->cols || $this->res[$next_px][$next_py] != null) {
		   			$this->changeDirection($directionCounter % 4);
		   			$directionCounter += 1;
		   		}

		   		$px += $this->xDirection;
		   		$py += $this->yDirection;

		   		$counter++;

		   	}
		}

		public function generateHtmlTable() {
			$result = "";
			$result .= '<table border="1"><tbody>';
			for ($i = 0; $i < $this->rows; $i++) {
				$result .= '<tr>';
				for ($j = 0; $j < $this->cols; $j++) {
					$result .= '<td class="pulse-shrink">' . $this->res[$i][$j] . "</td>";
				}
				$result .= '</tr>';
			}
			$result .= '</tbody></table>';

			return $result;
		}
	}

	/*
	$t = new Table(2, 2);
	echo $t->generateArray();
	echo $t->generateHtmlTable();
	
	$t = new Table(4, 4);
	echo $t->generateArray();
	echo $t->generateHtmlTable();

	
	$t = new Table(4, 5);
	echo $t->generateArray();
	echo $t->generateHtmlTable();

	$t = new Table(0, 0);
	echo $t->generateArray();
	echo $t->generateHtmlTable();

	$t = new Table(0, 5);
	echo $t->generateArray();
	echo $t->generateHtmlTable();

	$t = new Table(5, 0);
	echo $t->generateArray();
	echo $t->generateHtmlTable();

	$t = new Table(1, 5);
	echo $t->generateArray();
	echo $t->generateHtmlTable();

	$t = new Table(5, 1);
	echo $t->generateArray();
	echo $t->generateHtmlTable();
	*/
?>