<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

$id=$item->getId();
$this->startForm("?controller=Scheduling&action=edit_save&id=$id");

?>

</tbody></table>

<h1>Informations générales</h1>

<table><tbody>

<?php

echo "<tr><td class=\"tableContentCell\">Point de service</td><td class=\"tableContentCellFilled\">".$placeName;
echo "<input type=\"hidden\" name=\"placeIdentifier\" value=\"".$placeIdentifier."\" />";
echo "</td></tr>";


$this->addTextFieldWithValue("Date de début (aaaa-mm-jj)","startingDate",$item->getAttribute("startingDate"));
$this->addTextFieldWithValue("Date de début (aaaa-mm-jj)","endingDate",$item->getAttribute("endingDate"));
$this->renderHiddenFieldWithValue("userIdentifier","Créateur",$currentUser->getName(),$currentUser->getId());

?>

</tbody></table>

<h1>Jours de la semaine</h1>

<table  ><tbody>
<tr><th  class="tableContentCell">Jour</th><th class="tableContentCell">Ouvert</th><th class="tableContentCell">Ouverture</th><th class="tableContentCell">Retour des prêts de soir</th><th class="tableContentCell">Début des prêts de soir</th><th class="tableContentCell">Fermeture</th><th class="tableContentCell">Durée d'un prêt</th></tr>

<?php

$map=array();

foreach($days as $day){
	$map[$day->getAttribute("dayOfWeek")]=$day;

}

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

	$this->renderYesNoSelectorWithValue("opened$i",$map[$i]->getAttribute("opened"));

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelectorWithValue("openingTime$i",0,24,$map[$i]->getAttribute("openingTime"));

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelectorWithValue("returnTime$i",0,24,$map[$i]->getAttribute("returnTime"));

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelectorWithValue("eveningTime$i",0,24,$map[$i]->getAttribute("eveningTime"));

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelectorWithValue("closingTime$i",0,24,$map[$i]->getAttribute("closingTime"));

	echo "</td>";
	echo "<td class=\"tableContentCell\">";

	$this->renderTimeSelectorWithValue("loanLength$i",0,24,$map[$i]->getAttribute("loanLength"));

	echo "</td>";


	echo "</tr>";
}

?>


</tbody></table>


<table><tbody>


<?php

$this->endForm();


?>


