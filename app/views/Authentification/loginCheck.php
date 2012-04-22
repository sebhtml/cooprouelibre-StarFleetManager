<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

if($connected){
?>


Vous êtes connecté.

<a href="index.php?controller=Dashboard&action=view">Vous pouvez procéder.</a>

<?php
}else{
?>

	La combinaison est invalide. 

Vous pouvez <a href="index.php?controller=Authentification&action=login">ré-essayer</a>.


<?php

//echo "username= $username password= $password";
}

?>

