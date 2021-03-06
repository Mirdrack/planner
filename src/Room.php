<?php
namespace Planner;

use \Faker\Factory as FakerFactory;

class Room
{
	public $attendees;
	public $tables;
	private $faker;

	function __construct($number)
	{
		$this->faker = FakerFactory::create('es_ES');

		for($cont = 0; $cont < $number; $cont++)
		{
			$fakeName = $this->faker->name;
			$this->attendees[] = new Attendee($cont + 1 , 'Invitado '.($cont + 1));
		}

		$tableNumber = ceil($number / 4);
		for ($cont =0; $cont < $tableNumber; $cont++)
		{ 
			$this->tables[] = new Table($cont + 1, 'Mesa '.($cont + 1));
		}

	}

	public function fillTables($stop = 0)
	{
		$tableCont = 0;

		for($cont = 0; $cont < count($this->attendees); $cont++)
		{
			if($this->attendees[$cont]->assigned == false)
			{
				if($this->tables[$tableCont]->isFull())
				{
					if($tableCont < (count($this->tables) - 1))
					{
						$tableCont++;
						$wasAssigned = $this->tables[$tableCont]->addMember($this->attendees[$cont]);
						if($wasAssigned)
						{
							$this->attendees[$cont]->assigned = true;

							$this->attendees[$cont]->addTable($this->tables[$tableCont]);
						}
						else
							$cont = 0;
					}
				}
				else
				{
					$wasAssigned = $this->tables[$tableCont]->addMember($this->attendees[$cont]);
					if($wasAssigned)
					{
						$this->attendees[$cont]->assigned = true;
						$this->attendees[$cont]->addTable($this->tables[$tableCont]);
					}
				}
			}
			if($cont >= count($this->attendees) && !$this->checkDistribution())
				$cont = 0;

		}
	}

	public function cleanTables()
	{
		foreach ($this->tables as $table)
		{
			$table->clean();
		}
	}

	public function freeAttendees()
	{
		for ($cont = 0; $cont < count($this->attendees); $cont++)
		{ 
			$this->attendees[$cont]->assigned = false;
		}
	}

	public function printTables()
	{
		foreach ($this->tables as $table)
		{
			echo $table->name.' ('.$table->check().")\n";
			foreach ($table->getMembers() as $member)
			{
				echo $member->getName()."\t";
			}
			echo "\n\n";
		}
	}


	public function printAttendee($index)
	{
		print_r($this->attendees[$index]);
	}

	public function printAttendees()
	{
		foreach ($this->attendees as $attendee)
		{
			echo $attendee->getName()."\t Mesas: ";
			echo $attendee->getTables();
			echo "\n\n";
		}
	}

	public function printAttendeesHTML()
	{
		foreach ($this->attendees as $attendee)
		{
			echo '<div class="row">';
			echo '	<div class="col s3">';
			echo 		$attendee->getName();
			echo '	</div>';
			echo 	$attendee->getTablesHTML();
			echo '</div>';
		}
	}

	public function printUnassignedAttendees()
	{
		echo "NO SE PUDO COMPLETAR LA DISTRIBUCIÓN\n";
		echo "INVITADOS NO ASIGNADOS\n";
		foreach ($this->attendees as $attendee)
		{
			if(!$attendee->assigned)
				echo $attendee->getName()."\n";
		}	
	}

	public function printUnassignedAttendeesHTML()
	{
		if(!$this->checkDistribution())
		{
			echo "<h5>NO SE PUDO COMPLETAR LA DISTRIBUCI&OacuteN</h5>";
			echo "<h5>Invitados no asignados para la 3ra ronda</h5>";
		}
		foreach ($this->attendees as $attendee)
		{
			if(!$attendee->assigned)
				echo $attendee->getName()."<br>";
		}	
	}

	public function getAttendeesNumber()
	{
		return count($this->attendees);
	}

	public function checkDistribution()
	{
		$shuffleDone = false;
		$attendeesReady = 0;
		foreach ($this->tables as $table)
		{
			$attendeesReady += count($table->getMembers());
		}
		if($attendeesReady >= count($this->attendees))
			return true;
		else
			return false;
	}

	public function getTableNumber()
	{
		return count($this->tables);
	}
}