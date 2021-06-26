<?php
require_once 'BaseModel.php';

class AdminAccountsModel extends BaseModel
{
    const TABLE = 'admin';

    public function getAllAccounts($page, $limit = 5)
    {
        $start_from = ($page - 1) * $limit;
        $sqlLimit = $start_from . ',' . $limit;
        return $this->all(self::TABLE, ['*'], [], $sqlLimit);
    }
    public function checkUsername($username)
    {
        $sql = "select * from admin where username = '${username}'";
        $result = $this->_query($sql);
        if (mysqli_num_rows($result) > 0) {
            return false;
        }
        return true;
    }
    public static function totalRecords()
    {
        $db = new DB;
        $conn = $db->connect();
        $sql = "SELECT COUNT(*) FROM " . self::TABLE;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    public function addAccount($acountData)
    {
        return $this->create(self::TABLE, $acountData);
    }
    public function findAccountById($admin_id)
    {
        return $this->find(self::TABLE, "admin_id", $admin_id);
    }
    public function deleteAccountById($admin_id)
    {
        $accountData = $this->findAccountById($admin_id);
        $filePath = ROOT . '/upload/images/admin/' . $accountData['avatar_img'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        return $this->delete(self::TABLE, 'admin_id', $admin_id);
    }
}