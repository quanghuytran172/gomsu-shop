<?php
require_once('controllers/BaseController.php');

class CartController extends BaseController
{
    function __construct()
    {
        $this->folder = 'cart';
    }

    public function index()
    {
        $this->loadModel('CartModel');
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $productsInCart = CartModel::getProducts();
        if ($productsInCart) {
            $allProductsCodes = array_keys($productsInCart);
            $products = $productModel->getAllProductByCode($allProductsCodes);
            $totalPrice = CartModel::getTotalPrice($products);
            $this->render('index', ['products' => $products, 'totalPrice' => $totalPrice, 'productsInCart' => $productsInCart]);
        }
        $this->render('index');
    }
    public function add($productCode = '')
    {
        $this->loadModel('CartModel');
        if (!empty($productCode)) {
            CartModel::addProduct($productCode);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/cart");
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }
    public function addAjax()
    {
        $this->loadModel('CartModel');
        $productCode = $_POST['productCode'];
        if (!empty($productCode)) {
            echo CartModel::addProduct($productCode);
            return true;
        }
    }
    public function deleteAjax()
    {
        $this->loadModel('CartModel');
        $productCode = $_POST['productCode'];
        if (!empty($productCode)) {
            CartModel::deleteProductById($productCode);
            echo 1;
            return true;
        }
    }
    public function updateAjax()
    {
        $this->loadModel('CartModel');
        $productCode = $_POST['productCode'];
        $quantity = $_POST['quantity'];
        CartModel::updateProduct($productCode, $quantity);
        echo 1;
        return true;
    }
    public function checkOut()
    {
        $this->loadModel('CartModel');
        $this->loadModel('ProductModel');
        $productModel = new ProductModel;
        $productsInCart = CartModel::getProducts();

        $allProductsCodes = array_keys($productsInCart);
        $products = $productModel->getAllProductByCode($allProductsCodes);
        $totalPrice = CartModel::getTotalPrice($products);

        if (isset($_POST['submit'])) {
            $fullname = $this->validate_input($_POST['fullname']);
            $phone = $this->validate_input($_POST['phone']);
            $email = $this->validate_input($_POST['email']);
            $address = $this->validate_input($_POST['address']);
            if (empty($fullname) || empty($phone) || empty($email)  || empty($address)) {
                $this->render('checkout', ['alert' => 'Yêu cầu nhập đầy đủ thông tin', 'products' => $products, 'totalPrice' => $totalPrice, 'productsInCart' => $productsInCart]);
            } elseif (empty($productsInCart)) {
                $this->render('checkout', ['alert' => 'Bạn không có sản phẩm nào trong giỏ hàng']);
            } else {
                $this->loadModel("OrderModel");
                $orderModel = new OrderModel;
                $customerId = $orderModel->getNextCustomerId();
                $orderId = $orderModel->getNextOrderId();
                $orderModel->addCustomer([
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address,
                ]);

                $orderModel->addOrder([
                    'c_id' => $customerId,
                    'total_price' => $totalPrice,
                    'status' => 0,
                    'date_order' => date("Y/m/d")
                ]);

                foreach ($products as  $product) {
                    $orderModel->addOrderDetails([
                        'order_id' => $orderId,
                        'product_code' => $product['product_code'],
                        'quantity_order' => $productsInCart[$product['product_code']],
                        'price_order' => $product['price']
                    ]);
                }
                CartModel::clear();
                $this->render('payment_success', ['order_id' => $orderId]);
            }
        }

        if ($productsInCart) {
            $this->render('checkout', ['products' => $products, 'totalPrice' => $totalPrice, 'productsInCart' => $productsInCart]);
        }

        $this->render('checkout', ['alert' => 'Bạn không có sản phẩm nào trong giỏ hàng']);
    }
}