<?php

class ORM
{
    private $users;
    private $rooms;
    private $messages;
    public $response = ['success' => false, 'data' => null];

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
            $response['data'] = $user->toArray();
            $response['success'] = true;
            return $response;
        }, $this->users);
    }

    public function getUserById($id)
    {
        foreach ($this->users as $user) {
            if ($user->getId() == $id) {
                $response['data'] = $user->toArray();
                $response['success'] = true;
                return $response;
            }
        }
        $response['data'] = "User not found";
        $response['success'] = false;
        return $response;
    }

    public function addUser($user)
    {
        foreach ($this->users as $baseuser) {
            if ($baseuser->getUsername() == $user->getUsername()) {
                $response['data'] = "Username already exist";
                $response['success'] = false;
                return $response;
            }
        }
        $this->users[] = $user;
        $response['data'] = $user->toArray();
        $response['success'] = true;
        return $response;
    }

    // Room-related methods
    public function getRooms()
    {
        return array_map(function ($room) {
            $response['data'] = $room->toArray();
            $response['success'] = true;
            return $response;
        }, $this->rooms);
    }

    public function getRoomByName($name)
    {
        foreach ($this->rooms as $room) {
            if ($room->getName() == $name) {
                $response['data'] = $room->toArray();
                $response['success'] = true;
                return $response;
            }
        }
        $response['data'] = "Room not found";
        $response['success'] = false;
        return $response;
    }

    public function addRoom(Room $room)
    {
        if ($this->getRoomByName($room->getName())['success'] == true) {
            $response['data'] = "A room with the same name already exists.";
            $response['success'] = false;
            return $response;
        }
        $this->rooms[] = $room;
        $response['data'] = $room->toArray();
        $response['success'] = true;
        return $response;
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

        $response['data'] = $room_messages;
        $response['success'] = true;
        return $response;
    }


    public function addMessage(Message $message)
    {
        $lastMessage = end($this->messages);
        if ($this->getUserById($message->getUserId())['success'] == false) {
            return $this->getUserById($message->getUserId());
        }
        if ($lastMessage && $lastMessage->getUserId() === $message->getUserId()) {
            $interval = $lastMessage->getTimestamp()->diff($message->getTimestamp());
            if ($interval->days == 0 && $interval->h == 0 && $interval->i < 24) {
                $response['data'] = "You cannot post two consecutive messages within 24 hours.";
                $response['success'] = false;
                return $response;
            }
        }
        $this->messages[] = $message;
        $response['data'] = $message->toArray();
        $response['success'] = true;
        return $response;
    }

    public function getLastMessageByUserId($user_id)
    {
        $last_message = null;
        if ($this->getUserById($user_id)['success'] == false) {
            return $this->getUserById($user_id->getUserId());
        }
        foreach ($this->messages as $message) {
            if ($message->getUserId() == $user_id) {
                if ($last_message === null || $message->getTimestamp() > $last_message->getTimestamp()) {
                    $last_message = $message;
                }
            }
        }
        $response['data'] = $last_message->toArray();
        $response['success'] = true;
        return $response;
    }
}
