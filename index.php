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

include("app/models/Right.php");
include("app/models/Part.php");
include("app/models/RepairPart.php");
include("app/models/Member.php");
include("app/models/Loan.php");
include("app/models/Repair.php");
include("app/models/RepairType.php");
include("app/models/User.php");
include("app/models/Bike.php");
include("app/models/Place.php");
include("app/models/Schedule.php");
include("app/models/ScheduledDay.php");
include("app/models/ClosedDay.php");
include("app/models/MemberLock.php");
include("app/models/BikePlace.php");


include("app/controllers/Dashboard.php");
include("app/controllers/BikeManagement.php");
include("app/controllers/LoanManagement.php");
include("app/controllers/RepairManagement.php");
include("app/controllers/PartManagement.php");
include("app/controllers/MemberManagement.php");
include("app/controllers/PlaceManagement.php");
include("app/controllers/UserManagement.php");
include("app/controllers/RightManagement.php");
include("app/controllers/Authentification.php");
include("app/controllers/Entertainment.php");
include("app/controllers/Scheduling.php");
include("app/controllers/ClosedDayManagement.php");
include("app/controllers/BikePlaceManagement.php");


session_start();

$core= new Core($CONFIG_DATABASE_SOFTWARE,$CONFIG_DATABASE_HOSTNAME,
	$CONFIG_DATABASE_NAME,$CONFIG_DATABASE_USERNAME,$CONFIG_DATABASE_PASSWORD,$CONFIG_DATABASE_TABLE_PREFIX,
$CONFIG_logo,$CONFIG_style);

$core->registerController(new DashBoard());
$core->registerController(new Authentification());
$core->registerController(new BikeManagement());
$core->registerController(new MemberManagement());
$core->registerController(new UserManagement());
$core->registerController(new RepairManagement());
$core->registerController(new LoanManagement());
$core->registerController(new RightManagement());
$core->registerController(new Scheduling());
$core->registerController(new Entertainment());
$core->registerController(new PlaceManagement());
$core->registerController(new PartManagement());
$core->registerController(new ClosedDayManagement());
$core->registerController(new BikePlaceManagement());

$core->setSessionData($_SESSION);
$core->setGetData($_GET);
$core->setPostData($_POST);
$core->call();

?>
