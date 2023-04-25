<?php

use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    public function testRoomCreation()
    {
        $name = 'General';
        $room = new Room($name);

        $this->assertEquals($name, $room->getName());
    }

    public function testRoomNameUpdate()
    {
        $name1 = 'General';
        $name2 = 'Random';
        $room = new Room($name1);
        $room->setName($name2);

        $this->assertEquals($name2, $room->getName());
    }
}
