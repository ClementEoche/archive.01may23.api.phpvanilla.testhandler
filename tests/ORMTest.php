<?php

use PHPUnit\Framework\TestCase;

class ORMTest extends TestCase
{
    private $orm;

    protected function setUp(): void
    {
        $this->orm = new ORM();
    }

    public function testUserManagement()
    {
        $user = new User('JohnDoe', 1);
        $response = $this->orm->addUser($user);
        $this->assertTrue($response['success']);

        $retrievedUser = $this->orm->getUserById(1);
        $this->assertTrue($retrievedUser['success']);
        $this->assertEquals('JohnDoe', $retrievedUser['data']['username']);

        $users = $this->orm->getUsers();
        $this->assertCount(1, $users);
    }

    public function testRoomManagement()
    {
        $room = new Room('General', 1);
        $response = $this->orm->addRoom($room);
        $this->assertTrue($response['success']);

        $retrievedRoom = $this->orm->getRoomByName('General');
        $this->assertTrue($retrievedRoom['success']);
        $this->assertEquals('General', $retrievedRoom['data']['name']);

        $rooms = $this->orm->getRooms();
        $this->assertCount(1, $rooms);
    }

    public function testMessageManagement()
    {
        $user = new User('JohnDoe', 1);
        $this->orm->addUser($user);

        $room = new Room('General', 1);
        $this->orm->addRoom($room);

        $message = new Message(1, 1, 'Hello, world!', 1);
        $response = $this->orm->addMessage($message);
        $this->assertTrue($response['success']);

        $retrievedMessages = $this->orm->getMessagesByRoomId(1);
        $this->assertTrue($retrievedMessages['success']);
        $this->assertCount(1, $retrievedMessages['data']);

        $lastMessage = $this->orm->getLastMessageByUserId(1);
        $this->assertInstanceOf(Message::class, $lastMessage);
        $this->assertEquals('Hello, world!', $lastMessage->getContent());
    }
}
