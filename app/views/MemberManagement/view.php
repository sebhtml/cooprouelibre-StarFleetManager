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

<h1>Bloquages</h1>



<?php

if($isManager){

	$core->makeButton("?controller=MemberManagement&action=addLock&id=$memberIdentifier","bloquer le membre");

	echo "<br /><br />";
}


foreach($memberLocks as $i){
	echo $i->getAttribute("startingDate")." au ".$i->getAttribute("endingDate");

	if($i->getAttribute("lifted")){
		echo " annulé par ".$i->getUser()->getName().", raison: ".$i->getAttribute("explanation");

	}elseif($isManager){

		$core->makeButton("?controller=MemberManagement&action=cancelLock&id={$i->getId()}","annuler");
	}

	echo "<br />";
}

?>
