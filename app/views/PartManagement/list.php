<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($isMechanic){
$core->makeButton("?controller=PartManagement&action=add","Ajouter une pièce");
}

echo "<br /><br />";
foreach($parts as $i){

	echo "<a href=\"?controller=PartManagement&action=view&id={$i->getId()}\">{$i->getName()}</a> (quantité: {$i->getBalance()})<br />";
}

?>


