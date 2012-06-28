<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3



?>

<?php


if($isViewer){

$core->makeButton("?controller=PlaceManagement&action=list","points de service");
$core->makeButton("?controller=MemberManagement&action=list","membres");

}

if($isViewer){
$core->makeButton("?controller=BikeManagement&action=list","vélos");
}

if($isViewer){
	$core->makeButton("?controller=RepairManagement&action=list","réparations");
}

if($isViewer){
	$core->makeButton("?controller=LoanManagement&action=list","prêts");
}


?>

<br />

<?php

if($isViewer){
	$core->makeButton("?controller=Statistics&action=report","rapport");
}

?>


