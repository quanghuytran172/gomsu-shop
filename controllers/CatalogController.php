<?php
require_once('controllers/BaseController.php');

class CatalogController extends BaseController
{
    function __construct()
    {
        $this->folder = 'catalog';
    }

    public function index($catId = '')
    {

        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $catModel = new CategoryModel;
        $productModel = new ProductModel;
        $data = [];
        if (empty($catId)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/shop");
        } else {
            $getProduct = $productModel->getProductByCategory($catId);
            $data['currentCat'] = $catModel->getCategoryName($catId);
            if (empty($data['currentCat'])) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
            }
        }
        $data['category_list'] = $catModel->getAllCategory();
        $data['sanpham'] = $getProduct;
        $data['totalProduct'] = $productModel->totalProductByCategory($catId);
        $this->render('index', $data);
    }

    public function getProduct()
    {
        $nextPage = $_POST['nextPage'];
        $catId = $_POST['catId'];
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $data = $productModel->getNextProducts($nextPage, $catId);
        echo $data;
    }
}