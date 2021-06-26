<?php
require_once('controllers/BaseController.php');

class CheckOrderController extends BaseController
{
    function __construct()
    {
        $this->folder = 'status_order';
    }

    public function index()
    {
        if (isset($_POST['submit'])) {
            $inputOrderId =  $this->validate_input($_POST['search_order']);
            $this->loadModel('OrderModel');
            $orderModel = new OrderModel;
            $mainInforOrder = $orderModel->getMainOrderById($inputOrderId);
            $orderDetails = $orderModel->getOrderDetailsById($inputOrderId);
            $alert = '';
            if (empty($mainInforOrder)) {
                $alert = 'Không tìm thấy đơn hàng';
            }
            $this->render('index', [
                'mainInfor' => $mainInforOrder,
                'orderDetails' => $orderDetails,
                'alert' => $alert
            ]);
        }
        $this->render('index');
    }
}