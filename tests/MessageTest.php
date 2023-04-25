<?php

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testMessageCreation()
    {
        $user_id = 1;
        $room_id = 1;
        $content = 'Hello, world!';
        $id = 1;

        $message = new Message($user_id, $room_id, $content, $id);

        $this->assertEquals($id, $message->getId());
        $this->assertEquals($user_id, $message->getUserId());
        $this->assertEquals($room_id, $message->getRoomId());
        $this->assertEquals($content, $message->getContent());
    }

    public function testMessageInvalidContentLength()
    {
        $this->expectException(\InvalidArgumentException::class);

        $user_id = 1;
        $room_id = 1;
        $content = 'H'; // Invalid content length (1 character)
        $id = 1;

        new Message($user_id, $room_id, $content, $id);
    }

    public function testMessageExceedsMaxLength()
    {
        $this->expectException(\InvalidArgumentException::class);

        $user_id = 1;
        $room_id = 1;
        $content = str_repeat('A', 2049); // Invalid content length (2049 characters)
        $id = 1;

        new Message($user_id, $room_id, $content, $id);
    }

    public function testMessageToArray()
    {
        $user_id = 1;
        $room_id = 1;
        $content = 'Hello, world!';
        $id = 1;

        $message = new Message($user_id, $room_id, $content, $id);
        $array = $message->toArray();

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('user_id', $array);
        $this->assertArrayHasKey('room_id', $array);
        $this->assertArrayHasKey('content', $array);
        $this->assertArrayHasKey('timestamp', $array);

        $this->assertEquals($id, $array['id']);
        $this->assertEquals($user_id, $array['user_id']);
        $this->assertEquals($room_id, $array['room_id']);
        $this->assertEquals($content, $array['content']);
    }
}
