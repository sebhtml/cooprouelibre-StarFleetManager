<?php
// Author: Sébastien Boisvert
// Client: Coop Roue-Libre de l'Université Laval
// License: GPLv3

error_reporting(E_ALL);

include("app/Driver.php");
include("app/Core.php");
include("app/Model.php");
include("app/Controller.php");
include("app/configuration.php");
include("app/controllers/Dashboard.php");
include("app/controllers/Authentification.php");
include("app/models/Person.php");

session_start();

$core= new Core($CONFIG_DATABASE_SOFTWARE,$CONFIG_DATABASE_HOSTNAME,
	$CONFIG_DATABASE_NAME,$CONFIG_DATABASE_USERNAME,$CONFIG_DATABASE_PASSWORD,$CONFIG_DATABASE_TABLE_PREFIX);

$core->registerController("Dashboard",new DashBoard());
$core->registerController("Authentification",new Authentification());

$core->call($_GET,$_POST,$_SESSION);

?>
