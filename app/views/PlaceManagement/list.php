<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getName();

	echo "<a href=\"?controller=PlaceManagement&action=view&id=$id\">$name</a><br />";
}


?>
