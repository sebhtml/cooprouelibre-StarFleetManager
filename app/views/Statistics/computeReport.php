<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3


?>

Ce rapport contient
<ul>

<li>Vélos avec au moins un prêt pour la période</li>
<li>Membres avec au moins un prêt pour la période</li>
<li>Prêts de vélos</li>
<li>Réparations</li>

</ul>

<h1>Vélos avec au moins un prêt pour la période</h1>

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

<h1>Membres avec au moins un prêt pour la période</h1>

<small>Ces données sont probablement distribuées selon une loi de puissance.</small>
<br />
<br />

<?php

echo "<table>";
echo "<tr><th class=\"tableHeaderCell\">Membre</th><th class=\"tableHeaderCell\">Prêts</th></tr>";

foreach($members as $item){

	$loans=$place->getLoansForMemberAndPeriod($item,$start,$end);

	echo "<tr><td class=\"tableContentCell\">".$item->getName()."</td><td class=\"tableContentCell\">".count($loans)."</td></tr>";
}

echo "</table>";

?>



<h1>Prêts de vélos</h1>

Nombre de prêts: <?php echo count($loanList); ?><br />

<?php

echo "<table>";
echo "<tr><th class=\"tableHeaderCell\">Début</th><th class=\"tableHeaderCell\">Fin</th><th class=\"tableHeaderCell\">Membre</th><th class=\"tableHeaderCell\">Vélo</th></tr>";

foreach($loanList as $item){

	echo "<tr>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("startingDate")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getAttributeValue("actualEndingDate")."</td>";
	echo "<td class=\"tableContentCell\">".$item->getMember()->getName()."</td>";
	echo "<td class=\"tableContentCell\">".$item->getBike()->getName()."</td></tr>";
}

echo "</table>";

?>



<h1>Réparations</h1>

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
