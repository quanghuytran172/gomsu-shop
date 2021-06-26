<?php
class DB
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'gomsu-dtb';
    private $connect;
    public function connect()
    {
        $this->connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);
        mysqli_set_charset($this->connect, "utf8");
        if (mysqli_connect_errno() === 0) {
            return $this->connect;
        }
        return false;
    }
    public function real_escape($str)
    {
        return $this->connect()->real_escape_string($str);
    }
}