<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($item->isActive()){

?>

La réparation doit être faite.
<br />
<br />
<?php

}else{

?>

La réparation a été faite.
<br />
<br />

<?php

}

$this->printRowAsTable($item);

$id=$item->getId();

echo "<br /><br />";

if($item->isActive() && $isMechanic){

	$core->makeButton("?controller=RepairManagement&action=complete_validate&id=$id","Compléter la réparation");
}

?>

<br /><br />

<h1>Pièces remplacées</h1>

<?php

if(count($repairParts)==0){
	echo "Aucune.";
}

echo "<br /><br />";

$total=0;

foreach($repairParts  as $i){

	$part=$i->getPart();
	$value=$part->getAttribute("value");
	echo "<a href=\"?controller=PartManagement&action=view&id={$part->getId()}\">{$part->getName()}</a> (".$value." $)<br />";

	$total+=$value;
}

echo "<br /><br />";
echo "Prix de la réparation: $total $";

echo "<br /><br />";

if($item->isActive() && $isMechanic){

	$core->makeButton("?controller=RepairManagement&action=addPart&id=$id","Remplacer une pièce du vélo");

}




?>
