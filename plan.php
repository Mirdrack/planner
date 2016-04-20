<?php 
require_once __DIR__.'/vendor/autoload.php';

use Planner\Room;


if(!isset($_POST['number']))
	die('<h1>Something fails = [ </h1>');
else
	$number = $_POST['number'];	

$room = new Room($number);

?>

<!DOCTYPE html>
<html>
<head>
	<title>::Planner::</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
</head>
<body>
	<div class="container">
		<h1>Planner</h1>
		<?php 
		echo 'Numero de asistentes: ' . $room->getAttendeesNumber()."<br>";
		echo 'Numero de mesas: ' . $room->getTableNumber()."<br><br>";
		?>
		<?php
		while (!$room->checkDistribution()) 
		{
			$room->fillTables();
		}
		$room->cleanTables();
		$room->freeAttendees();
		

		$myCont = 1;
		while (!$room->checkDistribution()) 
		{
			$room->fillTables();
			$myCont++;
		}
		$room->cleanTables();
		$room->freeAttendees();


		$myCont = 1;
		while (!$room->checkDistribution()) 
		{
			$room->fillTables($myCont);
			$myCont++;
			if($myCont == 10)
				break;
		}

		echo '<div>';
		$room->printAttendeesHTML();
		echo '<hr>';
		$room->printUnassignedAttendeesHTML();
		echo '</div>';
		?>
	<div>
</body>
</html>