<?php

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testMessageCreation()
    {
        $user_id = 1;
        $room_id = 1;
        $content = 'Hello, World!';
        $message = new Message($user_id, $room_id, $content);

        $this->assertEquals($user_id, $message->getUserId());
        $this->assertEquals($room_id, $message->getRoomId());
        $this->assertEquals($content, $message->getContent());
    }
}