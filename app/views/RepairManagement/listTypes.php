<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($isMechanic){
$core->makeButton("?controller=RepairManagement&action=addType","Ajouter un type de réparation");
}

echo "<br /><br />";
foreach($items as $i){

	echo $i->getName()."<br />";
}

?>


