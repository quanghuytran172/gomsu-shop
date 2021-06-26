<?php
require_once('controllers/BaseController.php');

class SiteController extends BaseController
{
    function __construct()
    {
        $this->folder = 'site';
    }

    public function index()
    {
        $this->loadModel('CategoryModel');
        $this->loadModel('ProductModel');
        $categoryModel = new CategoryModel;
        $productModel = new ProductModel;
        $doThoCung = $productModel->getFeaturedProducts(54);
        $loHoaDep = $productModel->getFeaturedProducts(55);
        $amChenDep = $productModel->getFeaturedProducts(82);
        $tranhGom = $productModel->getFeaturedProducts(86);
        $this->render('index', [
            'category' => $categoryModel->getAllCategory(),
            'dothocung' => $doThoCung,
            'loahoadep' => $loHoaDep,
            'amchendep' => $amChenDep,
            'tranhgom' => $tranhGom
        ]);
    }
    public function contact()
    {
        $this->render('contact');
    }
    public function about_us()
    {
        $this->render('about_us');
    }
}