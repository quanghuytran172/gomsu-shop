<?php
require_once('controllers/BaseController.php');
require_once('controllers/AuthController.php');
class AdminController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin';
    }

    public function index()
    {
        $this->loadModel('OrderModel');
        $orderModel = new OrderModel;
        $totalOrder = OrderModel::totalRecords();
        $totalRevenue = $orderModel->totalRevenue();
        $totalRevenueThisDay = $orderModel->totalRevenueThisDay();
        $this->render('index', [
            'totalOrder' => $totalOrder,
            'totalRevenue' => $totalRevenue,
            'totalRevenueThisDay' => $totalRevenueThisDay,

        ]);
    }
    public function logOut()
    {
        AuthController::logOut();
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/auth/login");
    }
}