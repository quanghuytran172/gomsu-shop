<?php
require_once 'BaseModel.php';

class AuthModel extends BaseModel
{
    const TABLE = 'admin';

    function login($username)
    {
        return $this->find(SELF::TABLE, 'username', $username);
    }
}