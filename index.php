<?php
// Author: Sébastien Boisvert
// Member: Coop Roue-Libre de l'Université Laval
// License: GPLv3

error_reporting(E_ALL);

include("app/Driver.php");
include("app/Core.php");
include("app/Model.php");
include("app/Controller.php");
include("app/configuration.php");

include("app/models/Member.php");
include("app/models/Loan.php");
include("app/models/Repair.php");
include("app/models/User.php");
include("app/models/Bike.php");


include("app/controllers/Dashboard.php");
include("app/controllers/BikeManagement.php");
include("app/controllers/LoanManagement.php");
include("app/controllers/RepairManagement.php");
include("app/controllers/MemberManagement.php");
include("app/controllers/UserManagement.php");
include("app/controllers/Authentification.php");
include("app/controllers/Entertainment.php");


session_start();

$core= new Core($CONFIG_DATABASE_SOFTWARE,$CONFIG_DATABASE_HOSTNAME,
	$CONFIG_DATABASE_NAME,$CONFIG_DATABASE_USERNAME,$CONFIG_DATABASE_PASSWORD,$CONFIG_DATABASE_TABLE_PREFIX);

$core->registerController(new DashBoard());
$core->registerController(new Authentification());
$core->registerController(new BikeManagement());
$core->registerController(new MemberManagement());
$core->registerController(new UserManagement());
$core->registerController(new RepairManagement());
$core->registerController(new LoanManagement());
$core->registerController(new Entertainment());

$core->setSessionData($_SESSION);
$core->setGetData($_GET);
$core->setPostData($_POST);
$core->call();

?>
