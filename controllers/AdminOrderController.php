<?php
require_once('controllers/BaseController.php');

class AdminOrderController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin_order';
    }
    public function index($name = 'page', $page = 1)
    {
        if ($name == 'page') {
            $this->loadModel('OrderModel');
            $orderModel = new OrderModel;
            $data = $orderModel->getAllMainOrder($page, 5);
            $this->render(
                'index',
                $data
            );
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }
    public function changeStatusOrder($orderId, $status = 1)
    {

        $this->loadModel('OrderModel');
        $orderModel = new OrderModel;
        $orderModel->updateStatusOrder($orderId, $status);
        echo "Thành công";
    }
    public function view()
    {
        if (isset($_POST['orderId'])) {
            $this->loadModel('OrderModel');
            $orderModel = new OrderModel;
            $dataHtml = $orderModel->getOrderDetailsAdmin($_POST['orderId']);
            echo $dataHtml;
        }
    }

    public function search()
    {
        if (isset($_POST['query'])) {
            $this->loadModel('OrderModel');
            $orderModel = new OrderModel;
            $dataHtml = $orderModel->search($_POST['query']);
            echo $dataHtml;
        }
    }
}