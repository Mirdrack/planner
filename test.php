<?php

$attendeeNumber = 25;
$tableNumber = ceil($attendeeNumber / 4);

for ($contOut = 1; $contOut <= $attendeeNumber; $contOut++)
{ 
	for($conIn = 1; $contIn < 4; $contIn++)
	echo $contOut.' ';
	if(($contOut % 4) == 0)
		echo "\n";
}