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

?>

<br /><br />

<?php

if($item->isActive() && $isMechanic){

	$core->makeButton("?controller=RepairManagement&action=complete_validate&id=$id","Compléter la réparation");
}

?>
