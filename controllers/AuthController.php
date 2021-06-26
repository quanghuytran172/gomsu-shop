<?php
require_once('controllers/BaseController.php');

class AuthController extends BaseController
{
    function __construct()
    {
        $this->folder = 'auth';
    }

    public function index()
    {
        $this->checkLogged();
    }
    public function login()
    {
        $this->checkLogged();
    }
    public function checkLogin()
    {
        $username = $_POST['name'];
        $password_input = $_POST['password'];
        $this->loadModel('AuthModel');
        $authModel = new AuthModel;
        $result = $authModel->login($username);
        if (!empty($result)) {
            $adminId = $result['admin_id'];
            $username = $result['username'];
            $password = $result['password'];

            if (md5($password_input) == $password) {
                $_SESSION['admin_id'] = $adminId;
                $_SESSION['username'] = $username;
                echo 'success';
            } else {
                echo 'unsuccess';
            }
        } else {
            echo 'unsuccess';
        }
    }
    public function checkLogged()
    {
        if (isset($_SESSION['username'])) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/admin/index");
        } else {
            $this->render('login');
        }
    }
    public static function logOut()
    {

        unset($_SESSION['admin_id']);
        unset($_SESSION['username']);
    }
}