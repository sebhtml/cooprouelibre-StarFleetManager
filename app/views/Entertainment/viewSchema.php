<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

foreach($list as $tableName){
	

	$attributes=$finder->getPersistentAttributes($core,$tableName);

	echo $tableName."<br />";

	$columns=array();
	$this->printArrayAsTable($attributes,$columns);
	echo "<br />";
}

?>
