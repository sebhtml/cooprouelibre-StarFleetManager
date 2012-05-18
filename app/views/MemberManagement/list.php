<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($isLoaner||$isManager){
	$core->makeButton("?controller=MemberManagement&action=addFast","Ajouter un membre rapidement");
}

echo "<br />";

if($isLoaner||$isManager){
	$core->makeButton("?controller=MemberManagement&action=add","Ajouter un membre");
}

echo "<br />";
echo "<br />";
echo "Nombre de membres: ".count($list)."<br /><br />";

foreach($list as $i){
	$id=$i->getAttributeValue('id');
	$name=$i->getName()." ".$i->getAttribute("email");

	echo "<a href=\"?controller=MemberManagement&action=view&id=$id\">$name</a><br />";
}

?>
