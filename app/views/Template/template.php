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

}

?>


</div>
</div>

	<div class="contentPanel">

<?php

echo "<h2>".$pageTitle."</h2>";

echo $pageContent ;
?>

	</div>


	<div class="bottomPanel">

<div class="text">
	Coop Roue-Libre
</div>

</div>

</div>
</div>


</body>

</html>
