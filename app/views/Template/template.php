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
<link rel="stylesheet" type="text/css" href="<?php echo $CONFIG_style;?>" media="all" />
	</head>
<?php
?>
<body>

<div class="container1">
<div class="container2">
	<div class="logo">
		<img src="<?php echo $CONFIG_logo; ?>" />
	</div>

	<div class="topPanel">
<div class="text">

<?php
if($username!=NULL){

	$core->makeButton("?controller=UserManagement&action=view&id=$identifier",$username);
	$core->makeButton("?controller=Authentification&action=logout","se déconnecter");

}else{

	$core->makeButton("?controller=Authentification&action=login","Se connecter");
}

	$core->makeButton("?controller=Dashboard&action=help","aide");


if($isViewer){
	$core->makeButton("?controller=Statistics&action=list","statistiques");
}

if($isAdministrator){
	$core->makeButton("?controller=UserManagement&action=list","administration");
}

	echo "<br />";
?>

&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;

<?php

if($isLoaner || $isManager){

$core->makeButton("?controller=PlaceManagement&action=list","points de service");
$core->makeButton("?controller=MemberManagement&action=list","membres");

}

if($isManager || $isMechanic){
$core->makeButton("?controller=BikeManagement&action=list","vélos");
}

if($isMechanic){
	$core->makeButton("?controller=RepairManagement&action=list","réparations");
}

if($isManager){
	$core->makeButton("?controller=LoanManagement&action=list","prêts");
}


//$core->makeButton("?controller=Entertainment&action=viewSchema","entrailles");


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
<small>
<?php echo $softwareName." ".$softwareVersion ; ?> 
© 2012 <a href="http://cooprouelibre.com">Coop Roue-Libre</a>.<br />
Ce <a href="https://github.com/sebhtml/cooprouelibre-StarFleetManager">logiciel libre</a> est distribué sous la 
<a href="http://www.gnu.org/licenses/gpl-3.0.html">Licence publique générale GNU, version 3</a>.
</small>
</div>
<div>
</div>
</div>
</div>



	</div>


</div>
</div>


</body>

</html>
