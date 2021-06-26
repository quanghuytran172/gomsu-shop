<?php
require_once 'BaseModel.php';

class CartModel extends BaseModel
{
    function __construct()
    {
    }
    public static function addProduct($productCode)
    {
        $productsInCart = [];

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($productCode, $productsInCart)) {
            $productsInCart[$productCode]++;
        } else {
            $productsInCart[$productCode] = 1;
        }

        $_SESSION['products'] = $productsInCart;
        return self::countItems();
    }
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        }
        return 0;
    }
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        if ($productsInCart) {
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['product_code']];
            }
            return $total;
        }
        return 0;
    }

    public static function deleteProductById($productCode)
    {
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];

            if (array_key_exists($productCode, $productsInCart)) {
                unset($productsInCart[$productCode]);
            }
            $_SESSION['products'] = $productsInCart;
        }
    }
    public static function updateProduct($productCode, $quantity)
    {
        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];

            if (array_key_exists($productCode, $productsInCart)) {
                $productsInCart[$productCode] = $quantity;
            }
            $_SESSION['products'] = $productsInCart;
        }
    }
}