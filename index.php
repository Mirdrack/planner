<?php 
require_once __DIR__.'/vendor/autoload.php';

use Planner\Room;

$room = new Room(28);

echo 'Numero de asistentes: ' . $room->getAttendeesNumber()."\n";
echo 'Numero de mesas: ' . $room->getTableNumber()."\n\n";
echo "===============================First Round==============================\n";
while (!$room->checkDistribution()) 
{
	$room->fillTables();
}
$room->printTables();
$room->cleanTables();
$room->freeAttendees();

echo "==============================Second Round==============================\n";
$myCont = 1;
while (!$room->checkDistribution()) 
{
	$room->fillTables();
	$myCont++;
}
$room->printTables();
$room->cleanTables();
$room->freeAttendees();

echo "==============================Third Round==============================\n";
$myCont = 1;
while (!$room->checkDistribution()) 
{
	$room->fillTables($myCont);
	$myCont++;
	if($myCont == 10)
		break;
}
$room->printTables();
echo "\n\n";

echo "=======================Distribución por invitado=======================\n";
$room->printAttendees();
$room->printUnassignedAttendees();