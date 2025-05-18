<?php

class User
{
    public int $id;
    public string $username;

    public function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
}