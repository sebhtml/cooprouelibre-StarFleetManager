<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3


$this->startForm("index.php?controller=Scheduling&action=add_save");

?>

</tbody></table>

<h1>Informations générales</h1>

<table><tbody>

<?php

echo "<tr><td class=\"tableContentCell\">Point de service</td><td class=\"tableContentCellFilled\">".$placeName;
echo "<input type=\"hidden\" name=\"placeIdentifier\" value=\"".$placeIdentifier."\" />";
echo "</td></tr>";


$this->addTextField("Date de début (aaaa-mm-jj)","startingDate");
$this->addTextField("Date de début (aaaa-mm-jj)","endingDate");

?>

</tbody></table>

<h1>Jours de la semaine</h1>

<table  ><tbody>
<tr><th  class="tableContentCell">Jour</th><th class="tableContentCell">Ouvert</th><th class="tableContentCell">Ouverture</th><th class="tableContentCell">Retour des prêts de soir</th><th class="tableContentCell">Début des prêts de soir</th><th class="tableContentCell">Fermeture</th><th class="tableContentCell">Durée d'un prêt</th></tr>

<?php

for($i=0;$i<7;$i++){

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

	$this->renderYesNoSelector("opened$i");

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelector("openingTime$i",0,24);

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelector("returnTime$i",0,24);

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelector("eveningTime$i",0,24);

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelector("closingTime$i",0,24);

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelector("loanLength$i",0,4);

	echo "</td>";


	echo "</tr>";
}

?>


</tbody></table>


<table><tbody>


<?php

$this->endForm();


?>


