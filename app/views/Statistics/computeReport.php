<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>

<b><a name="contents"></a>Navigation</b><br />

<ul>
<li><a href="#metrics">Indicateurs</a></li>
<li><a href="#loanFrequenciecs">Distribution des fréquences de prêts par membre</a></li>
<li><a href="#loansPerWeekDay">Nombre de prêts par jour de la semaine</a></li>
<li><a href="#metricsByLoanType">Métriques par type de prêts</a></li>
<li><a href="#loansPerDay">Nombre de prêts par jour</a></li>
<li><a href="#bikes">Vélos avec au moins un prêt pour la période</a></li>
<li><a href="#membersByAge">Nombre de membres par tranches d'âge</a></li>
<li><a href="#loansByAge">Nombre de prêts par tranches d'âge</a></li>
<li><a href="#members">Membres avec au moins un prêt pour la période</a></li>
<li><a href="#repairCosts">Coût des réparations par groupe</a></li>
<li><a href="#loans">Prêts de vélos (liste)</a></li>
<li><a href="#repairs">Réparations (liste)</a></li>

</ul>

<h1><a name="metrics">Indicateurs</a></h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<table><caption>Indicateurs</caption>
<tbody>
<tr><th class="tableHeaderCell">Nom de l'indicateur</th>
<th class="tableHeaderCell">Valeur de l'indicateur</th></tr>

<tr><td class="tableContentCell">Point de service</td><td class="tableContentCell"> <?php echo $place->getName(); ?></td></tr>
<tr><td class="tableContentCell">Début</td><td class="tableContentCell"><?php echo $start; ?></td></tr>
<tr><td class="tableContentCell">Fin</td><td class="tableContentCell"><?php echo $end; ?></td></tr>
<tr><td class="tableContentCell">Nombre de jours avec au moins un prêt</td><td class="tableContentCell"><?php echo $days; ?></td></tr>
<tr><td class="tableContentCell">Nombre de vélos avec au moins un prêt</td><td class="tableContentCell"><?php echo $numberOfBikes; ?></td></tr>
<tr><td class="tableContentCell">Nombre de prêts</td><td class="tableContentCell"><?php echo $numberOfLoans; ?></td></tr>
<tr><td class="tableContentCell">Nombre de membres avec au moins un prêt</td><td class="tableContentCell"><?php echo $numberOfMembers; ?></td></tr>
<tr><td class="tableContentCell">Durée moyenne d'un prêt (heures)</td><td class="tableContentCell"><?php echo $meanLoanLength; ?></td></tr>
<tr><td class="tableContentCell">Nombre moyen de prêts par jour</td><td class="tableContentCell"><?php echo $meanNumberOfLoansPerDay; ?></td></tr>
<tr><td class="tableContentCell">Nombre moyen de prêts par semaine</td><td class="tableContentCell"><?php echo $meanNumberOfLoansPerWeek; ?></td></tr>
<tr><td class="tableContentCell">Nombre moyen de prêts par vélo</td><td class="tableContentCell"><?php echo $meanNumberOfLoansPerBike; ?></td></tr>
<tr><td class="tableContentCell">Nombre moyen de prêts par membre</td><td class="tableContentCell"><?php echo $meanNumberOfLoansPerMember; ?></td></tr>
<tr><td class="tableContentCell">Pourcentage de femmes</td><td class="tableContentCell"><?php echo $womanRatio; ?>%</td></tr>
<tr><td class="tableContentCell">Pourcentage d'hommes</td><td class="tableContentCell"><?php echo $manRatio; ?>%</td></tr>
<tr><td class="tableContentCell">Pourcentage de prêts de femmes</td><td class="tableContentCell"><?php echo $womanLoanRatio; ?>%</td></tr>
<tr><td class="tableContentCell">Pourcentage de prêts d'hommes</td><td class="tableContentCell"><?php echo $manLoanRatio; ?>%</td></tr>
<tr><td class="tableContentCell">Nombre le plus élevé de prêts pour une journée</td><td class="tableContentCell"><?php echo $maximumLoansForADay; ?></td></tr>
<tr><td class="tableContentCell">Nombre le plus élevé de prêts pour un membre</td><td class="tableContentCell"><?php echo $maximumLoansForAMember; ?></td></tr>
<tr><td class="tableContentCell">Nombre total de vélo-heures consommés par les membres</td><td class="tableContentCell"><?php echo $bikeHours; ?></td></tr>
</tbody>
</table>

<h1><a name="loansPerWeekDay"></a>Nombre de prêts par jour de la semaine</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<table>
<caption></caption>
<tbody>
<tr>
<th class="tableHeaderCell">Jour de la semaine</th>
<th class="tableHeaderCell">Nombre de jours</th>
<th class="tableHeaderCell">Nombre total de prêts</th>
<th class="tableHeaderCell">Nombre moyen de prêts</th>
</tr>
<?php

$theKeys=(array_keys($loansPerDay));
sort($theKeys);

$table=array();
$table[1]="lundi";
$table[2]="mardi";
$table[3]="mercredi";
$table[4]="jeudi";
$table[5]="vendredi";
$table[6]="samedi";
$table[7]="dimanche";

$totalForWeekDays=array();
$totalForWeekDays[1]=0;
$totalForWeekDays[2]=0;
$totalForWeekDays[3]=0;
$totalForWeekDays[4]=0;
$totalForWeekDays[5]=0;
$totalForWeekDays[6]=0;
$totalForWeekDays[7]=0;

$countForWeekDays=array();
$countForWeekDays[1]=0;
$countForWeekDays[2]=0;
$countForWeekDays[3]=0;
$countForWeekDays[4]=0;
$countForWeekDays[5]=0;
$countForWeekDays[6]=0;
$countForWeekDays[7]=0;


foreach($theKeys as $object){


	$dayOfWeek=date("N",strtotime($object));

	$totalForWeekDays[$dayOfWeek]+=$loansPerDay[$object];
	$countForWeekDays[$dayOfWeek]++;

}

$i=1;
while($i<=7){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$table[$i]."</td>";
	echo "<td class=\"tableContentCell\">".$countForWeekDays[$i]."</td>";
	echo "<td class=\"tableContentCell\">".$totalForWeekDays[$i]."</td>";

	$average=$totalForWeekDays[$i];

	if($countForWeekDays[$i]!=0)
		$average/=$countForWeekDays[$i];

	$average=sprintf("%.0f",$average);

	echo "<td class=\"tableContentCell\">".$average."</td>";
	echo "</tr>";
	
	$i++;
}

?>

</tbody></table>

<h1><a name="metricsByLoanType"></a>Métriques par type de prêts</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<?php

$loanCountSameDayNotLate=0;
$loanSumSameDayNotLate=0;
$loanCountSameDay=0;
$loanSumSameDay=0;

$loanCountNextDayNotLate=0;
$loanSumNextDayNotLate=0;
$loanCountNextDay=0;
$loanSumNextDay=0;

$loanCountOtherDayNotLate=0;
$loanSumOtherDayNotLate=0;
$loanCountOtherDay=0;
$loanSumOtherDay=0;

foreach($loanList as $item){

	$loanLength=$item->getHours();
	
	if($item->isSameDayLoan()){
		$loanCountSameDay++;
		$loanSumSameDay+=$loanLength;
	}elseif($item->isNextDayLoan()){
		$loanCountNextDay++;
		$loanSumNextDay+=$loanLength;
	}elseif($item->isOtherDayLoan()){
		$loanCountOtherDay++;
		$loanSumOtherDay+=$loanLength;
	}


	if(!$item->isLate()){
		if($item->isSameDayLoan()){
			$loanCountSameDayNotLate++;
			$loanSumSameDayNotLate+=$loanLength;
		}elseif($item->isNextDayLoan()){
			$loanCountNextDayNotLate++;
			$loanSumNextDayNotLate+=$loanLength;
		}elseif($item->isOtherDayLoan()){
			$loanCountOtherDayNotLate++;
			$loanSumOtherDayNotLate+=$loanLength;
		}
	}
}

?>

<table>
<caption></caption>
<tbody>
<tr><th class="tableHeaderCell">Type de prêts</th><th class="tableHeaderCell">Nombre de prêts</th>
<th class="tableHeaderCell">Durée moyenne (heures)</th>
<th class="tableHeaderCell">Durée moyenne (heures; excluant les retards)</th>
</tr>

<tr>
	<td class="tableContentCell">Prêt de jour (termine la même journée)</td>
	<td class="tableContentCell"><?php echo $loanCountSameDay; ?></td>
	<td class="tableContentCell"><?php printf("%.2f",$loanSumSameDay/$loanCountSameDay); ?></td>
	<td class="tableContentCell"><?php printf("%.2f",$loanSumSameDayNotLate/$loanCountSameDayNotLate);?></td>
</tr>

<tr>
	<td class="tableContentCell">Prêt de soir (termine la journée suivante)</td>
	<td class="tableContentCell"><?php echo $loanCountNextDay; ?></td>
	<td class="tableContentCell"><?php printf("%.2f",$loanSumNextDay/$loanCountNextDay); ?></td>
	<td class="tableContentCell"><?php printf("%.2f",$loanSumNextDayNotLate/$loanCountNextDayNotLate);?></td>
</tr>

<tr>
	<td class="tableContentCell">Prêt de fin de semaine (termine au moins après la journée suivante)</td>
	<td class="tableContentCell"><?php echo $loanCountOtherDay; ?></td>
	<td class="tableContentCell"><?php printf("%.2f",$loanSumOtherDay/$loanCountOtherDay); ?></td>
	<td class="tableContentCell"><?php printf("%.2f",$loanSumOtherDayNotLate/$loanCountOtherDayNotLate);?></td>
</tr>


</tbody></table>





<h1><a name="loansPerDay"></a>Nombre de prêts par jour</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<table>
<caption></caption>
<tbody>
<tr><th class="tableHeaderCell">Date</th><th class="tableHeaderCell">Jour de la semaine</th><th class="tableHeaderCell">Nombre de prêts</th></tr>
<?php

$theKeys=(array_keys($loansPerDay));
sort($theKeys);

$table=array();
$table[1]="lundi";
$table[2]="mardi";
$table[3]="mercredi";
$table[4]="jeudi";
$table[5]="vendredi";
$table[6]="samedi";
$table[7]="dimanche";

foreach($theKeys as $object){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$object."</td>";

	$dayOfWeek=date("N",strtotime($object));

	$dayOfWeek=$table[$dayOfWeek];

	echo "<td class=\"tableContentCell\">".$dayOfWeek."</td>";
	echo "<td class=\"tableContentCell\">".$loansPerDay[$object]."</td>";
	echo "</tr>";
}
?>

</tbody></table>


<h1><a name="bikes"></a>Vélos avec au moins un prêt pour la période</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<small>Ces données sont probablement distribuées selon une loi de Poisson ou selon une loi normale.</small>
<br />
<br />

<?php

echo "<table>";
echo "<tr><th class=\"tableHeaderCell\">Vélo</th><th class=\"tableHeaderCell\">Prêts</th></tr>";

foreach($bikes as $item){

	$loans=$place->getLoansForBikeAndPeriod($item,$start,$end);

	echo "<tr><td class=\"tableContentCell\">".$item->getName()."</td><td class=\"tableContentCell\">".count($loans)."</td></tr>";
}

echo "</table>";

?>

<h1><a name="membersByAge"></a>Nombre de membres par tranches d'âge</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<?php

echo "<table><tbody>";
echo "<tr><th class=\"tableHeaderCell\">Âge minimal</th>";
echo "<th class=\"tableHeaderCell\">Âge maximal</th><th class=\"tableHeaderCell\">Nombre de membres</th></tr>";

$membersPerAge=array();

foreach($members as $item){

	$loans=$loansForMember[$item->getId()];

	foreach($loans as $loan){
		$start=$loan->getAttribute("startingDate");

		$age=$item->getAgeAtDate($start);

		if(!array_key_exists($age,$membersPerAge)){
			$membersPerAge[$age]=0;
		}

		$membersPerAge[$age]++;

// Only use the first loan to compute the age of the member

		break;
	}
}

$i=0;
$maximumAge=200;
$windowWidth=3;

while($i<=$maximumAge){

	$sum=0;
	$startingPoint=$i;
	$endingPoint=$i+$windowWidth-1;

	while($i<$endingPoint){
		if(!array_key_exists($i,$membersPerAge)){
			$i++;
			continue;
		}

		$frequency=$membersPerAge[$i];
		$sum+=$frequency;
		$i++;
	}

	if($sum==0)
		continue;

	echo "<tr><td class=\"tableContentCell\">".$startingPoint."</td>";
	echo "<td class=\"tableContentCell\">".$endingPoint."</td>";
	echo "<td class=\"tableContentCell\">".$sum."</td></tr>";

}

echo "</tbody></table>";

?>




<h1><a name="loansByAge"></a>Nombre de prêts par tranches d'âge</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<?php

echo "<table><tbody>";
echo "<tr><th class=\"tableHeaderCell\">Âge minimal</th>";
echo "<th class=\"tableHeaderCell\">Âge maximal</th><th class=\"tableHeaderCell\">Nombre de prêts</th></tr>";

$loansPerAge=array();

foreach($members as $item){

	$loans=$loansForMember[$item->getId()];

	foreach($loans as $loan){
		$start=$loan->getAttribute("startingDate");

		$age=$item->getAgeAtDate($start);

		if(!array_key_exists($age,$loansPerAge)){
			$loansPerAge[$age]=0;
		}

		$loansPerAge[$age]++;
	}
	
}

$i=0;
$maximumAge=200;
$windowWidth=3;

while($i<=$maximumAge){

	$sum=0;
	$startingPoint=$i;
	$endingPoint=$i+$windowWidth-1;

	while($i<$endingPoint){
		if(!array_key_exists($i,$loansPerAge)){
			$i++;
			continue;
		}

		$frequency=$loansPerAge[$i];
		$sum+=$frequency;
		$i++;
	}

	if($sum==0)
		continue;

	echo "<tr><td class=\"tableContentCell\">".$startingPoint."</td>";
	echo "<td class=\"tableContentCell\">".$endingPoint."</td>";
	echo "<td class=\"tableContentCell\">".$sum."</td></tr>";

}

echo "</tbody></table>";

?>




<h1><a name="members"></a>Membres avec au moins un prêt pour la période</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<small>Ces données sont probablement distribuées selon une loi de puissance.</small>
<br /><br />
<br />
<br />

<?php

echo "<table><tbody>";
echo "<tr><th class=\"tableHeaderCell\">Membre</th><th class=\"tableHeaderCell\">Prêts</th></tr>";

$loansPerMember=array();

foreach($members as $item){

	$loans=$loansForMember[$item->getId()];

	$count=count($loans);

	if(!array_key_exists($count,$loansPerMember)){
		$loansPerMember[$count]=0;
	}

	$loansPerMember[$count]++;

	echo "<tr><td class=\"tableContentCell\">".$item->getName()."</td><td class=\"tableContentCell\">".count($loans)."</td></tr>";
}

echo "</tbody></table>";

?>

<h1><a name="loanFrequenciecs"></a>Distribution des fréquences de prêts par membre</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<small>Ces données sont probablement distribuées selon une loi de puissance.</small>
<br /><br />
<?php

$theKeys=(array_keys($loansPerMember));
sort($theKeys);

echo "<table><tbody>";
echo "<tr><th class=\"tableHeaderCell\">Nombre de prêts</th><th class=\"tableHeaderCell\">Nombre de membres avec ce nombre de prêts</th></tr>";


foreach($theKeys as $object){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$object."</td>";
	echo "<td class=\"tableContentCell\">".$loansPerMember[$object]."</td>";
	echo "</tr>";
}

echo "</tbody></table>";



?>

<h1><a name="repairCosts"></a>Coût des réparations par groupe</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<?php

$repairCounts=array();
$repairCost=array();
$repairMinutes=array();

foreach($repairs as $item){

	$group=$item->getRepairType()->getName();
	$minutes=$item->getAttributeValue("minutes");

	$repairTotal=0;

	$replacedParts=$item->getRepairParts();

	$i=0;
	foreach($replacedParts as $object){

		$realItem=$object->getPart();
		$repairTotal+=$realItem->getAttributeValue("value");

		$i++;
	}

	if(!array_key_exists($group,$repairCounts)){
		$repairCounts[$group]=0;
		$repairCosts[$group]=0;
		$repairMinutes[$group]=0;
	}

	$repairCounts[$group]++;
	$repairCosts[$group]+=$repairTotal;
	$repairMinutes[$group]+=(int)$minutes;

}

?>

<table>
<caption></caption>
<tbody>
<tr>
<th class="tableHeaderCell">Type de réparations</th>
<th class="tableHeaderCell">Nombre de réparations</th>
<th class="tableHeaderCell">Coût total ($)</th>
<th class="tableHeaderCell">Temps total (minutes)</th>
</tr>

<?php

$theKeys=(array_keys($repairCounts));
sort($theKeys);

foreach($theKeys as $object){

	echo "<tr>";

	echo "<th class=\"tableHeaderCell\">$object</th>";
	echo "<th class=\"tableHeaderCell\">${repairCounts[$object]}</th>";
	echo "<th class=\"tableHeaderCell\">${repairCosts[$object]}</th>";
	echo "<th class=\"tableHeaderCell\">${repairMinutes[$object]}</th>";

	echo "</tr>";
}

?>

</tbody></table>



<h1><a name="loans"></a>Prêts de vélos (liste)</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

Nombre de prêts: <?php echo count($loanList); ?><br />

<?php

echo "<table>";
echo "<tr><th class=\"tableHeaderCell\">Début</th><th class=\"tableHeaderCell\">Fin</th><th class=\"tableHeaderCell\">Durée (heures)</th><th class=\"tableHeaderCell\">Membre</th><th class=\"tableHeaderCell\">Vélo</th></tr>";

foreach($loanList as $item){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("startingDate")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("actualEndingDate")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getHours()."</td>";
	echo "<td class=\"tableContentCell\">".$item->getMember()->getName()."</td>";
	echo "<td class=\"tableContentCell\">".$item->getBike()->getName()."</td></tr>";
}

echo "</table>";

?>



<h1><a name="repairs"></a>Réparations (liste)</h1>
retourner à la <a href="#contents">Navigation</a><br /><br />

<h2>Pièces de rechange</h2>

<?php

echo "<table>";
echo "<tr><th class=\"tableHeaderCell\">Pièce</th><th class=\"tableHeaderCell\">Coût ($)</th></tr>";





foreach($parts as $item){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("name")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("value")."</td>";
	echo "</tr>";
}

echo "</table>";

?>

<h2>Réparations</h2>

<b>Si un vélo a été déplacé entre les points de service pendant la période, alors ses réparations seront présentes
pour plusieurs points de service.</b><br /><br />

Nombre de réparations: <?php echo count($repairs); ?><br /><br />


<?php


echo "<table>";
echo "<tr>";
echo "<th class=\"tableHeaderCell\">Date</th><th class=\"tableHeaderCell\">Vélo</th>";
echo "<th class=\"tableHeaderCell\">Type</th><th class=\"tableHeaderCell\">Description</th>";
echo "<th class=\"tableHeaderCell\">Minutes</th>";
echo "<th class=\"tableHeaderCell\">Pièces</th>";
echo "<th class=\"tableHeaderCell\">Coût ($)</th>";
echo "</tr>";


$total=0;
$sumOfMinutes=0;


foreach($repairs as $item){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("creationDate")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getBike()->getName()."</td>";
	echo "<td class=\"tableContentCell\">".$item->getRepairType()->getName()."</td>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("description")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("minutes")."</td>";
	echo "<td class=\"tableContentCell\">";

	$repairTotal=0;

	$replacedParts=$item->getRepairParts();

	$i=0;
	foreach($replacedParts as $object){
		if($i!=0){
			echo "; ";
		}

		$realItem=$object->getPart();
		echo $realItem->getName();
		$repairTotal+=$realItem->getAttributeValue("value");

		$i++;
	}

	echo "</td>";
	echo "<td class=\"tableContentCell\">".$repairTotal."</td>";
	echo "</tr>";

	$total += $repairTotal;
	$sumOfMinutes+=$item->getAttributeValue("minutes");
}

echo "</table>";

echo "<br />";
echo "<br />";
echo "<br />";
echo "Coût total: ".$total." $<br />";
echo "Temps total: ".$sumOfMinutes." minutes<br />";


?>
