<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($item->isActive()){

$toSkip=array("actualEndingDate"=>"","returnUserIdentifier"=>"")
?>

<b>Le prêt est en cours.</b>

<?php
}else{

$toSkip=array();

?>

<b>Le prêt est terminé.</b>

<?php
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
