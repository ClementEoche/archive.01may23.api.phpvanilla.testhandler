<?php

class ORM
{
    private $users;
    private $rooms;
    private $messages;

    public function __construct()
    {
        $this->users = [];
        $this->rooms = [];
        $this->messages = [];
    }

    // User-related methods
    public function getUsers()
    {
        return array_map(function ($user) {
            return $user->toArray();
        }, $this->users);
    }

    public function getUserById($id)
    {
        foreach ($this->users as $user) {
            if ($user->getId() == $id) {
                return $user->toArray();
            }
        }

        return null;
    }

    public function addUser($user)
    {
        $this->users[] = $user;
        return $user->toArray();
    }

    // Room-related methods
    public function getRooms()
    {
        return array_map(function ($room) {
            return $room->toArray();
        }, $this->rooms);
    }

    public function getRoomByName($name)
    {
        foreach ($this->rooms as $room) {
            if ($room->getName() == $name) {
                return $room->toArray();
            }
        }

        return null;
    }

    public function addRoom(Room $room)
    {
        if ($this->getRoomByName($room->getName())) {
            throw new \Exception("A room with the same name already exists.");
        }

        $this->rooms[] = $room;
        return $room->toArray();
    }

    // Message-related methods
    public function getMessagesByRoomId($room_id)
    {
        $room_messages = [];
        foreach ($this->messages as $message) {
            if ($message->getRoomId() == $room_id) {
                $room_messages[] = $message->toArray();
            }
        }
        
        usort($room_messages, function ($a, $b) {
            return $a['timestamp'] <=> $b['timestamp'];
        });

        return $room_messages;
    }


    public function addMessage(Message $message)
    {
        $lastMessage = end($this->messages);
        if ($lastMessage && $lastMessage->getUserId() === $message->getUserId()) {
            $interval = $lastMessage->getTimestamp()->diff($message->getTimestamp());
            if ($interval->days == 0 && $interval->h == 0 && $interval->i < 24) {
                return ("You cannot post two consecutive messages within 24 hours.");
            }
        }

        $this->messages[] = $message;
        return $message->toArray();
    }

    public function getLastMessageByUserId($user_id)
    {
        $last_message = null;
        foreach ($this->messages as $message) {
            if ($message->getUserId() == $user_id) {
                if ($last_message === null || $message->getTimestamp() > $last_message->getTimestamp()) {
                    $last_message = $message;
                }
            }
        }

        return $last_message->toArray();
    }
}
