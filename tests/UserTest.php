<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $username = 'JohnDoe';
        $user = new User($username);

        $this->assertEquals($username, $user->getUsername());
    }

    public function testUsernameUpdate()
    {
        $username1 = 'JohnDoe';
        $username2 = 'JaneDoe';
        $user = new User($username1);
        $user->setUsername($username2);

        $this->assertEquals($username2, $user->getUsername());
    }
}
