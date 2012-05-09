<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$this->printRowAsTable($member);

$memberIdentifier=$member->getId();

?>

<br />

<?php

if($isAdministrator){
	$core->makeButton("?controller=MemberManagement&action=edit&id=$memberIdentifier","Éditer");
}

$core->makeButton("?controller=LoanManagement&action=list&memberIdentifier=$memberIdentifier","Voir les prêts");

?>



