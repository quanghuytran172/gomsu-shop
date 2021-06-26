<?php
require_once('controllers/BaseController.php');

class AdminAccountsController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin_accounts';
    }
    public function index($name = 'page', $page = 1)
    {
        if ($name == 'page') {
            $this->loadModel('AdminAccountsModel');
            $accountsModel = new AdminAccountsModel;
            $data = $accountsModel->getAllAccounts($page);
            $this->render(
                'index',
                $data
            );
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }

    public function add()
    {

        if (isset($_POST['submit'])) {
            $this->loadModel('AdminAccountsModel');
            $accountsModel = new AdminAccountsModel;
            $username = $this->validate_input($_POST['username']);
            $password = $this->validate_input($_POST['password']);
            $name = $this->validate_input($_POST['name']);
            $email = $this->validate_input($_POST['email']);
            $avatar = $_FILES['avatar_img']['name'];
            $avatar_temp = $_FILES['avatar_img']['tmp_name'];

            if (empty($username) || empty($password) || empty($name) || empty($email)) {
                $this->render('add', ['error' => 'Yêu cầu nhập đầy đủ thông tin']);
            } else if (!$accountsModel->checkUsername($username)) // Check có tài khoản đã có người sử dụng chưa
            {
                $this->render('add', ['error' => 'Tên tài khoản đã có người sử dụng']);
            } else {
                move_uploaded_file($avatar_temp, "upload/images/admin/$avatar");
                $accountsModel->addAccount([
                    'username' => $username,
                    'password' => md5($password),
                    'name' => $name,
                    'email' => $email,
                    'avatar_img' => $avatar,
                ]);

                header('Location: ../adminaccounts/index');
            }
        }
        $this->render('add');
    }
    public function delete($admin_id = '')
    {
        if (!empty($admin_id)) {
            session_start();
            $this->loadModel('AdminAccountsModel');
            $admin_id = $this->validate_input($admin_id);
            $accountModel = new AdminAccountsModel;
            $accountModel->deleteAccountById($admin_id);
            if ($admin_id == $_SESSION['admin_id']) {
                session_destroy();
            }
            echo "Xóa thành công";
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }
}