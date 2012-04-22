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

	<div class="topPanel"></div>

	<div class="contentPanel">


<?php

if($username!=NULL){
	echo $username." ";
	echo "(<a href=\"index.php?controller=Authentification&action=logout\">se déconnecter</a>) ";
	echo "(<a href=\"index.php?controller=User&action=selfEdit\">changer son profil</a>) ";
	echo "<br /><br />";
}

echo $pageContent ;
?>

	</div>


	<div class="footer">
	Coop Roue-Libre

</div>

	<div class="bottomPanel"></div>
</div>
</div>


</body>

</html>
