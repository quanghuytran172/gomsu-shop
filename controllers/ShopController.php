<?php
require_once('controllers/BaseController.php');

class ShopController extends BaseController
{
    function __construct()
    {
        $this->folder = 'shop';
    }

    public function index()
    {

        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $catModel = new CategoryModel;
        $productModel = new ProductModel;
        $getProduct = $productModel->getProductByPage(1);
        $this->render('index', [
            'category' => $catModel->getAllCategory(),
            'sanpham' => $getProduct,
            'totalProduct' => ProductModel::totalRecordsProduct()
        ]);
    }
    public function search($searchName = '')
    {
        $searchName = $_POST['searchName'];
        if (empty($searchName)) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/shop");
        }
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $catModel = new CategoryModel;
        $productModel = new ProductModel;
        $getProductSearch = $productModel->getProductFromSearch($searchName, 1);
        $this->render('search', [
            'category' => $catModel->getAllCategory(),
            'sanpham' => $getProductSearch,
            'totalProduct' => ProductModel::totalRecordsProductSearch($searchName),
            'searchName' => $searchName
        ]);
    }
    public function getProduct()
    {
        $nextPage = $_POST['nextPage'];
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $data = $productModel->getNextProducts($nextPage);
        echo $data;
    }
    public function getProductSearch()
    {
        $nextPage = $_POST['nextPage'];
        $searchName = $_POST['searchName'];
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $data = $productModel->getNextProductsFromSearch($searchName, $nextPage);
        echo $data;
    }
}