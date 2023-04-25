<?php

class User
{
    private $id;
    private $username;

    public function __construct($username, $id)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
        ];
    }
}
