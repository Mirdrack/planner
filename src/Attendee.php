<?php
namespace Planner;

class Attendee
{
	private $id;
	private $name;
	private $history;
	public $assigned;
	
	function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
		$this->assigned = false;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function checkHistory($attende)
	{
		if(isset($this->history))
			return !in_array($attende->getId(), $this->history);
		else
			return true;
	}

	public function addToHistory($attende)
	{
		if($this->id != $attende->getId())
			$this->history[] = $attende->getId();
	}
}