<?php
require_once('controllers/BaseController.php');

class ProductController extends BaseController
{
    function __construct()
    {
        $this->folder = 'product';
    }

    public function view($productCode = '')
    {
        if (empty($productCode)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $data = $productModel->getProductByCode($productCode);
        $this->render('view', $data);
    }
}