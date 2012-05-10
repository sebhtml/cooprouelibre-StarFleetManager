<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($item->isActive()){

$toSkip=array("actualEndingDate"=>"","returnUserIdentifier"=>"")
?>

Le prêt est en cours.<br />

<?php

if($item->isLate()){

	echo "Le prêt est en retard.<br />";
}

}else{

$toSkip=array();

?>

Le prêt est terminé.<br />

<?php

if($item->isLate()){
	echo "Le prêt s'est terminé avec un retard.<br />";
}else{

	echo "Le prêt s'est terminé à l'heure prévu.";
}

}


echo "<br />";
echo "<br />";

$this->printRowAsTableWithSkipping($item,$toSkip);

$id=$item->getAttributeValue("id");

?>

<br /><br />

<?php

if($item->isActive() && $isLoaner){
	$core->makeButton("?controller=LoanManagement&action=return_validate&id=$id","Terminer le prêt");
}



?>
