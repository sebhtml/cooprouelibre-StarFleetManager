<?php

// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


$this->printRowAsTable($item);

if($allowed){

	$core->makeButton("?controller=UserManagement&action=edit&id={$item->getId()}","changer son profil");
}

?>

<h2>Droits</h2>

<ul>

<?php

if($item->isAdministrator()){

echo "<li>".$item->getAttribute("username")." est un administrateur du système.</li>";

}

$strings=array(
RIGHT_MANAGER => "Gestionnaire",
RIGHT_MECHANIC => "Mécanicien",
RIGHT_LOAN_OPERATOR => "Prêteur",
RIGHT_VIEWER => "Observateur"
);



foreach($rights as $i){
	$place=$i->getPlace();
	$right=$i->getAttribute("rightNumber");
	
	$role=$strings[$right];

	echo "<li>".$item->getAttribute("username")." est un $role au point de service {$place->getName()}";

	if($isAdministrator){

		$core->makeButton("?controller=RightManagement&action=remove&id={$i->getId()}","supprimer");
	}

	echo "</li>";
}

?>

<br /><br />

<?php

if($isAdministrator){

	$core->makeButton("?controller=RightManagement&action=add&userIdentifier={$item->getId()}","ajouter un droit");
}


?>


