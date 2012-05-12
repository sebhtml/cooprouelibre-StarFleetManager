<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

?>

<h1>État de la réparation</h1>

<?php

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

$bike=$item->getBike();
$places=$bike->getBikePlaces();

if(count($places)==0){
	echo "Le vélo est à aucun point de service.<br />";
}else{
	echo "Le vélo est au point de service ".$bike->getCurrentPlace()->getAttribute("name")."<br />";
}


?>

<h1>Informations sur la réparation</h1>

<?php

$this->printRowAsTable($item);

$id=$item->getId();

?>

<h1>Pièces remplacées</h1>

<?php

if(count($repairParts)==0){
	echo "Aucune.";
}


$total=0;

foreach($repairParts  as $i){

	$part=$i->getPart();
	$value=$part->getAttribute("value");
	echo "<a href=\"?controller=PartManagement&action=view&id={$part->getId()}\">{$part->getName()}</a> (".$value." $)<br />";

	$total+=$value;
}

echo "Prix de la réparation: $total $";

echo "<br /><br />";

if($item->isActive() && $isMechanic){

	$core->makeButton("?controller=RepairManagement&action=addPart&id=$id","Remplacer une pièce du vélo");

}







if($item->isActive() && $isMechanic){

?>
<h1>Complétion</h1>

<?php

	$core->makeButton("?controller=RepairManagement&action=complete_validate&id=$id","Compléter la réparation");
}

?>


