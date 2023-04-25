<?php

use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    public function testRoomCreation()
    {
        $name = 'General';
        $id = 1;

        $room = new Room($name, $id);

        $this->assertEquals($id, $room->getId());
        $this->assertEquals($name, $room->getName());
    }

    public function testRoomNameChange()
    {
        $name = 'General';
        $id = 1;

        $room = new Room($name, $id);
        $newName = 'Updated room';

        $room->setName($newName);

        $this->assertEquals($newName, $room->getName());
    }

    public function testRoomToArray()
    {
        $name = 'General';
        $id = 1;

        $room = new Room($name, $id);
        $array = $room->toArray();

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('name', $array);

        $this->assertEquals($id, $array['id']);
        $this->assertEquals($name, $array['name']);
    }
}
