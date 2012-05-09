<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


if($user->isAdministrator()){
	$core->makeButton("?controller=PlaceManagement&action=add","Ajouter un point de service");
}




?>


<br />
<br />

<h2>Utilisateurs</h2>

<?php

echo "Nombre d'utilisateurs: ".count($list);

?>


<br />
<br />

<?php

foreach($list as $i){
	$id=$i->getId();
	$name=$i->getName();

	echo "<a href=\"?controller=UserManagement&action=view&id=$id\">$name</a><br />";
}

echo "<br />";
echo "<br />";

if($isAdministrator){
	$core->makeButton("?controller=UserManagement&action=add","Ajouter un utilisateur");

}



?>
