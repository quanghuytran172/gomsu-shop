<?php
require_once 'BaseModel.php';
require_once './core/Database.php';
class AdminModel extends BaseModel
{
    function __construct()
    {
        $this->conn = $this->conn;
    }
    public static function getDataAdmin($adminId)
    {
        $db = new DB;
        $conn = $db->connect();
        $sql = "select name,email,avatar_img from admin where admin_id = '${adminId}'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_array($result);
    }
}