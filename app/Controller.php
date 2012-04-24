<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

class Controller{
	public function getView($controller,$action){
		$action=str_replace("$controller::call_","",$action);

		return "app/views/$controller/$action.php";
	}

	public function printArrayAsTable($rows,$columnNames){

		if(count($rows)==0){
			return;
		}

		$keys=array_keys($rows[0]);


		echo "<table><caption></caption><tbody>";
	
		echo "<tr>";
		foreach($keys as $i){
			echo "<th class=\"tableHeaderCell\">";
			$name=$i;
			if(array_key_exists($i,$columnNames)){
				$name=$columnNames[$i];
			}

			echo $name;
			echo "</th>";
		}
		echo "</tr>";

		foreach($rows as $row){
	
			echo "<tr>";
			foreach($keys as $key){
				$value=$row[$key];
				
				echo "<td class=\"tableContentCell\">$value</td>";
			}
			echo "</tr>";
		}

		echo "</tbody></table>";
	}
}

?>
