<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $username = 'JohnDoe';
        $id = 1;

        $user = new User($username, $id);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($username, $user->getUsername());
    }

    public function testUsernameChange()
    {
        $username = 'JohnDoe';
        $id = 1;

        $user = new User($username, $id);
        $newUsername = 'JaneDoe';

        $user->setUsername($newUsername);

        $this->assertEquals($newUsername, $user->getUsername());
    }

    public function testUserToArray()
    {
        $username = 'JohnDoe';
        $id = 1;

        $user = new User($username, $id);
        $array = $user->toArray();

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('username', $array);

        $this->assertEquals($id, $array['id']);
        $this->assertEquals($username, $array['username']);
    }
}
