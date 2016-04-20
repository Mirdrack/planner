<?php
namespace phpUnitTutorial\Test;

use \PHPUnit_Framework_TestCase as TestCase;
use \Planner\Room;

class PlannerTest extends TestCase
{
    public function testRoomCreation()
    {
    	//$attendee = new Room();
    	$room = new Room(20);
        $this->assertInstanceOf('Planner\Room', $room);
    }

    public function testRoomFill()
    {
    	$randomNumber = 20;
    	$room = new Room($randomNumber);
    	$this->assertCount($randomNumber, $room->attendees);
    	foreach ($room->attendees as $attendee)
    	{
    		$this->assertInstanceOf('Planner\Attendee', $attendee);
    	}
    }

    public function testTablesFill()
    {
    	//$table
    }


}
