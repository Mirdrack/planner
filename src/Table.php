<?php
namespace Planner;

class Table
{
	private $id;
	public $members;
	private $isFull;
	
	function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
		$this->isFull = false;
		$this->members = array();
	}

	public function addMember($attende)
	{
		if(!$this->isFull)
		{
			if(count($this->members) == 0)
			{
				$this->members[] = $attende;
				return true;
			}

			//Checking if can be added
			$canBeAdded = false;
			foreach ($this->members as $member)
			{
				$canBeAdded = $member->checkHistory($attende);
				if(!$canBeAdded)
					return false;
			}
			if($canBeAdded && !$attende->assigned)
			{
				$this->members[] = $attende;

				foreach($this->members as $member)
				{
					$member->addToHistory($attende);
					$attende->addToHistory($member);
				}
				// Checking table
				if(count($this->members) == 4)
					$this->isFull = true;
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}

	public function clean()
	{
		$this->members = array();
		$this->isFull = false;
	}

	public function isFull()
	{
		if(count($this->members) < 4)
			return false;
		else
			return true;
	}

	public function getMembers()
	{
		return $this->members;
	}

	public function check()
	{
		if($this->isFull)
			return 'Full';
		else
			return 'No Full';
	}

	public function printMembers()
	{
		foreach ($this->members as $member)
		{
			echo $member->getName()."\t";
		}
		echo "\n";;
	}

	public function getId()
	{
		return $this->id;
	}
}