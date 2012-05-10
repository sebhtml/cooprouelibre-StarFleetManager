<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);

?>

<br />
<br />
<br />

<?php

if($item->isLate()){

	echo "Le prêt a un retard de {$item->getLateHours()} heures.<br />";

	echo "Le membre est bloqué du ".$memberLock->getAttribute("startingDate")." au ".$memberLock->getAttribute("endingDate").".<br />";

}else{
	echo "Le prêt s'est terminé à l'heure prévu.";
}

?>


