<?php
namespace Planner;

class Attendee
{
	private $id;
	private $name;
	private $history;
	public $assigned;

	private $tables;
	
	function __construct($id, $name)
	{
		$this->id = $id;
		$this->name = $name;
		$this->assigned = false;
		$this->tables = array();
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

	public function addTable($table)
	{
		$this->tables[] = $table->getId();
	}

	public function getTables()
	{
		$output = '';
		foreach ($this->tables as $table)
		{
			$output .= $table."\t";
		}
		return $output;
	}

	public function getTablesHTML()
	{
		$output = '';
		foreach ($this->tables as $table)
		{
			$output .= '<div class="col s2">Mesa '.$table."</div>";
		}
		return $output;
	}
}