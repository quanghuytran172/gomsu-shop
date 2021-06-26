<?php
require_once('controllers/BaseController.php');

class WishListController extends BaseController
{
    function __construct()
    {
        $this->folder = 'wishlist';
    }

    public function index()
    {
        $this->loadModel('WishListModel');
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $productsInWishList = WishListModel::getProducts();
        if ($productsInWishList) {
            $products = $productModel->getAllProductByCode($productsInWishList);
            $this->render('index', ['products' => $products,  'productsInWishList' => $productsInWishList]);
        }
        $this->render('index');
    }
    public function add($productCode = '')
    {
        $this->loadModel('WishListModel');
        if (!empty($productCode)) {
            WishListModel::addProduct($productCode);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/wishlist");
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }
    public function addAjax()
    {
        $this->loadModel('WishListModel');
        $productCode = $_POST['productCode'];
        if (!empty($productCode)) {
            echo WishListModel::addProduct($productCode);
            return true;
        }
    }
    public function deleteAjax()
    {
        $this->loadModel('WishListModel');
        $productCode = $_POST['productCode'];
        if (!empty($productCode)) {
            WishListModel::deleteProductById($productCode);
            echo 1;
            return true;
        }
    }
}