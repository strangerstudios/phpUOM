<?php
	class UOM
	{
		function UOM($str = NULL, $size = NULL, $uom = NULL, $display_uom = NULL)
		{	
			$this->str = $str;
			$this->volume = $volume;
			$this->size = $size;
			$this->uom = $uom;
			$this->display_uom = $display_uom;
			
			//should we build from a string?
			if($this->str && !$this->uom)
			{
				return $this->setUOMFromString($this->str);
			}
			else
				return true;
		}
		
		function setUOMFromString($str)
		{
			include 'array.measures.php';
			$this->str = strtolower($str);	
			
			//Number part of metric
			$this->numpart = ereg_replace("[a-z]", "", $this->str);
			if (!is_numeric($this->numpart)) {
				die("Invalid number");
			}
			
			//String part of metric
			$this->strpart = ereg_replace("[^a-z]", "", $this->str);
			
			//Make sure uom is valid
			if (!array_key_exists($this->strpart, $uom_measure_arr)) {
				die("Invalid unit of measure");
			}
			
			//store the appropriate values
			$this->size = ($uom_measure_arr[$this->strpart][2] * $this->numpart);
			$this->uom = $uom_measure_arr[$this->strpart][1];
			$this->display_uom = $uom_measure_arr[$this->strpart][0];
			return $this->uom;
		}
			
		function inMeasure($measure) {
			include 'array.measures.php';
			$measure = strtolower($measure);
			if (!array_key_exists($measure, $uom_measure_arr))
				die("Invalid unit of measure");
			elseif ($uom_measure_arr[$measure][1] <> $uom_measure_arr[$this->strpart][1])
				die("Cannot convert between these two metrics");
			
			return $this->size / $uom_measure_arr[strtolower($measure)][2];
		}
	}
?>