<?php
namespace Planner;

class Room
{
	public $attendees;
	public $tables;

	function __construct($number)
	{
		for($cont = 0; $cont < $number; $cont++)
		{
			$this->attendees[] = new Attendee($cont + 1 , 'Attendee '.($cont + 1));
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
			if($cont == 0 && $stop != 0) {
						var_dump($tableCont);
						var_dump(!$this->checkDistribution());
						var_dump((count($this->tables) - 1));
						var_dump($this->attendees[$cont]); 
						die();
					}
			if($this->attendees[$cont]->assigned == false)
			{
				if($this->tables[$tableCont]->isFull())
				{
					$tableCont++;
					if($tableCont < (count($this->tables) - 1) || !$this->checkDistribution())
					{
						$wasAssigned = $this->tables[$tableCont]->addMember($this->attendees[$cont]);
						$this->attendees[$cont]->assigned = true;
					}
				}
				else
				{
					$wasAssigned = $this->tables[$tableCont]->addMember($this->attendees[$cont]);
					$this->attendees[$cont]->assigned = true;
				}
			}
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
			print_r($attendee);
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