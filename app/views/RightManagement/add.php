<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if(count($places)==0){

	echo "Vous devez ajouter un point de service en premier.<br />";
}else{

$this->startForm("?controller=RightManagement&action=addSave");

$this->renderHiddenFieldWithValue("userIdentifier","Utilisateur",$user->getName(),$user->getId());

$placeList=array();

foreach($places as $i){
	$placeList[$i->getId()]=$i->getName();
}

$this->renderSelector("placeIdentifier","Point de service",$placeList);

$rights=array(
RIGHT_MANAGER => "Gestionnaire",
RIGHT_MECHANIC => "Mécanicien",
RIGHT_LOAN_OPERATOR => "Prêteur",
RIGHT_VIEWER => "Observateur"
);

$this->renderSelector("rightNumber","Droit",$rights);

$this->endForm();

}

?>
