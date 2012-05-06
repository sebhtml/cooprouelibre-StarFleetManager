<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($item);




?>

<br />
<br />

<?php


$core->makeButton("?controller=ClosedDayManagement&action=remove&id={$item->getId()}","supprimer");

?>


