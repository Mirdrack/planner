<?php 
require_once __DIR__.'/vendor/autoload.php';

use Planner\Room;

$room = new Room(17);

echo 'Numero de asistentes: ' . $room->getAttendeesNumber()."\n";
echo 'Numero de mesas: ' . $room->getTableNumber()."\n\n";
echo "===============================First Round==============================\n";
/*$room->fillTables();
$room->printTables();
$room->cleanTables();
die();*/
while (!$room->checkDistribution()) 
{
	$room->fillTables();
}
$room->printTables();
$room->cleanTables();
$room->freeAttendees();

echo "==============================Second Round==============================\n";
while (!$room->checkDistribution()) 
{
	$room->fillTables(3465);
}
$room->printTables();
$room->cleanTables();
$room->freeAttendees();

/*echo "==============================Third Round==============================\n";
while (!$room->checkDistribution()) 
{
	$room->fillTables();
}
$room->printTables();*/