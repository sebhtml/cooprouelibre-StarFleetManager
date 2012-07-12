<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>

<b><a name="contents"></a>Navigation</b><br />

<ul>
<li><a href="#metrics">Indicateurs</a></li>
<li><a href="#loanFrequenciecs">Distribution des fréquences de prêts par membre</a></li>
<li><a href="#loansPerDay">Nombre de prêts par jour</a></li>
<li><a href="#bikes">Vélos avec au moins un prêt pour la période</a></li>
<li><a href="#members">Membres avec au moins un prêt pour la période</a></li>
<li><a href="#loans">Prêts de vélos</a></li>
<li><a href="#repairs">Réparations</a></li>

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
<tr><td class="tableContentCell">Pourcentage de femmes</td><td class="tableContentCell"><?php echo $womenRatio; ?></td></tr>
<tr><td class="tableContentCell">Pourcentage d'hommes</td><td class="tableContentCell"><?php echo $menRatio; ?></td></tr>
<tr><td class="tableContentCell">Nombre le plus élevé de prêts pour une journée</td><td class="tableContentCell"><?php echo $maximumLoansForADay; ?></td></tr>
<tr><td class="tableContentCell">Nombre le plus élevé de prêts pour un membre</td><td class="tableContentCell"><?php echo $maximumLoansForAMember; ?></td></tr>
<tr><td class="tableContentCell">Nombre total de vélo-heures consommés par les membres</td><td class="tableContentCell"><?php echo $bikeHours; ?></td></tr>
</tbody>
</table>

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

<h1><a name="loans"></a>Prêts de vélos</h1>
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



<h1><a name="repairs"></a>Réparations</h1>
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
