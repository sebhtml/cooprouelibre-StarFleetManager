<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3



?>




<h1>Jours de la semaine</h1>

<?php

	$id=$item->getId();

	$core->makeButton("?controller=Scheduling&action=edit&id=$id","Éditer");
?>

<br /><br />

<table  ><tbody>
<tr><th  class="tableContentCell">Jour</th><th class="tableContentCell">Ouvert</th><th class="tableContentCell">Ouverture</th><th class="tableContentCell">Retour des prêts de soir</th><th class="tableContentCell">Début des prêts de soir</th><th class="tableContentCell">Fermeture</th><th class="tableContentCell">Durée d'un prêt</th></tr>

<?php

$map=array();

foreach($days as $day){
	$map[$day->getAttribute("dayOfWeek")]=$day;

}

for($i=0;$i<7;$i++){

	if(count($days)==0){
		break;
	}

	$day="Lundi";
	if($i==0){
		$day="Lundi";
	}elseif($i==1){
		$day="Mardi";
	}elseif($i==2){
		$day="Mercredi";
	}elseif($i==3){
		$day="Jeudi";
	}elseif($i==4){
		$day="Vendredi";
	}elseif($i==5){
		$day="Samedi";
	}elseif($i==6){
		$day="Dimanche";
	}

	echo "<tr><td  class=\"tableContentCell\">";

	echo $day;

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	if($map[$i]->getAttribute("opened")){
		echo "oui";
	}else{
		echo "non";
	}

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	echo $map[$i]->getAttribute("openingTime");

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	echo $map[$i]->getAttribute("returnTime");

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	echo $map[$i]->getAttribute("eveningTime");

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	echo $map[$i]->getAttribute("closingTime");

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	echo $map[$i]->getAttribute("loanLength");

	echo "</td>";


	echo "</tr>";
}

?>


</tbody></table>


