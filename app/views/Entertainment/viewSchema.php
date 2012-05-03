<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

foreach($list as $tableName){
	
	$attributes=$finder->getPersistentAttributesForTable($core,$tableName);

	echo $tableName."<br />";

	$columns=array();
	$this->printArrayAsTable($attributes,$columns);
	echo "<br />";
}

?>
