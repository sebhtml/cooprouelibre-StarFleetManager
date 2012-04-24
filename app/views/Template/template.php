<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

?>
<!doctype html><html itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
echo($pageTitle);
?>
</title>
<link rel="stylesheet" type="text/css" href="sheet.css" media="all" />
	</head>
<?php
?>
<body>

<div class="container1">
<div class="container2">
	<div class="logo">
		<img src="logo.jpg" />
	</div>

	<div class="topPanel">
<div class="text">

<?php
if($username!=NULL){

	$core->makeButton("index.php?controller=UserManagement&action=view&username=$username",$username);
	$core->makeButton("index.php?controller=Authentification&action=logout","se déconnecter");
	$core->makeButton("index.php?controller=UserManagement&action=selfEdit","changer son profil");
	echo "<br />";

}

?>

&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;

<?php

if($username!=NULL){

$core->makeButton("index.php?controller=ClientManagement&action=list","clients");
$core->makeButton("index.php?controller=BikeManagement&action=list","vélos");
$core->makeButton("index.php?controller=RepairManagement&action=list","réparations");
$core->makeButton("index.php?controller=LoanManagement&action=list","prêts");
$core->makeButton("index.php?controller=UserManagement&action=list","comptes");
$core->makeButton("index.php?controller=Entertainment&action=viewSchema","entrailles");

}

?>


</div>
</div>

	<div class="contentPanel">


<?php

echo "<h2>".$pageTitle."</h2>";

echo $pageContent ;
?>

	<div class="bottomPanel">

<div class="text">
© 2012 <a href="http://cooprouelibre.org">Coop Roue-Libre</a>. Tous droits réservés.<br />
<small>Le <a href="https://github.com/sebhtml/cooprouelibre-StarFleetManager">code source de ce logiciel</a> est distribué sous la 
<a href="http://www.gnu.org/licenses/gpl-3.0.html">Licence publique générale GNU, version 3</a>.
</small>
</div>

</div>



	</div>


</div>
</div>


</body>

</html>
