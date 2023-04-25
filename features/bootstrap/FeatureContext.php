<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class FeatureContext implements Context
{
    private $users = [];
    private $rooms = [];

    /**
     * @When I create a user with the username :username
     */
    public function iCreateAUserWithTheUsername($username)
    {
        $user = new User($username);
        $this->users[] = $user;
    }

    /**
     * @Then there should be :count user
     */
    public function thereShouldBeUser($count)
    {
        $actualCount = count($this->users);
        if ($actualCount != $count) {
            throw new \Exception("Expected $count users, but got $actualCount");
        }
    }

    /**
     * @When I create a room with the name :roomName
     */
    public function iCreateARoomWithTheName($roomName)
    {
        $room = new Room($roomName);
        $this->rooms[] = $room;
    }

    /**
     * @Then there should be :count room
     */
    public function thereShouldBeRoom($count)
    {
        $actualCount = count($this->rooms);
        if ($actualCount != $count) {
            throw new \Exception("Expected $count rooms, but got $actualCount");
        }
    }

    /**
     * @Given there is a user with the username :username
     */
    public function thereIsAUserWithTheUsername($username)
    {
        $user = new User($username);
        $this->users[] = $user;
    }

    /**
     * @Given there is a room with the name :roomName
     */
    public function thereIsARoomWithTheName($roomName)
    {
        $room = new Room($roomName);
        $this->rooms[] = $room;
    }

    /**
     * @When the user :username posts a message :content in the room :roomName
     */
    public function theUserPostsAMessageInTheRoom($username, $content, $roomName)
    {
        $user = $this->getUserByUsername($username);
        $room = $this->getRoomByName($roomName);

        if (!$user || !$room) {
            throw new \Exception("User or room not found");
        }

        $message = new Message($user,$room, $content);
        $room->addMessage($message);
    }

    /**
     * @Then the room :roomName should have :count message
     */
    public function theRoomShouldHaveMessage($roomName, $count)
    {
        $room = $this->getRoomByName($roomName);

        if (!$room) {
            throw new \Exception("Room not found");
        }

        $actualCount = count($room->getMessages());
        if ($actualCount != $count) {
            throw new \Exception("Expected $count messages
            , but got $actualCount");
        }
    }

    private function getUserByUsername($username)
    {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }

        return null;
    }

    private function getRoomByName($roomName)
    {
        foreach ($this->rooms as $room) {
            if ($room->getName() === $roomName) {
                return $room;
            }
        }

        return null;
    }
}
