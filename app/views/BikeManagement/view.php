<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);

$id=$item->getAttributeValue("id");

?>

<br />

<?php

if($isAdministrator){
	$core->makeButton("?controller=BikeManagement&action=edit&id={$item->getId()}","Éditer");
}

$core->makeButton("?controller=LoanManagement&action=list&bikeIdentifier=$id","Voir les prêts");

if(!$item->isLoaned()){
$core->makeButton("?controller=RepairManagement&action=add&bikeIdentifier=$id","Ajouter une réparation");
}

$core->makeButton("?controller=RepairManagement&action=list&bikeIdentifier=$id","Voir les réparations");

?>

<br />

<h2>Historique de l'endroit du vélo</h2>

<?php

if(count($places)==0){
	echo "Le vélo n'est à aucun point de service présentement.<br />";
}

foreach($places as $item2){

	$id=$item2->getId();
	$name=$item2->getName();

	echo $name."<br />";
}
?>

<br />

<?php

$id=$item->getAttributeValue("id");

if($item->canBeMoved()){
	if($isManager){
		$core->makeButton("?controller=BikePlaceManagement&action=add&bikeIdentifier=$id","déplacer un vélo");
	}
}


?>

<h1>État du vélo</h2>

<?php

if($item->isLoaned()){


echo "Le vélo est présentement emprunté.";

}elseif($item->hasRepairs()){

echo "Le vélo a des réparations à faire.";

}else{

echo "Le vélo est disponible.";

}


?>
