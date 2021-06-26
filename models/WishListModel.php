<?php
require_once 'BaseModel.php';

class WishListModel extends BaseModel
{
    function __construct()
    {
    }
    public static function addProduct($productCode)
    {
        $productsInWishList = [];

        if (isset($_SESSION['wishlist'])) {
            $productsInWishList = $_SESSION['wishlist'];
        }
        if (!in_array($productCode, $productsInWishList)) {
            array_push($productsInWishList, $productCode);
        }
        $_SESSION['wishlist'] = $productsInWishList;
        return self::countItems();
    }
    public static function countItems()
    {
        if (isset($_SESSION['wishlist'])) {
            return count($_SESSION['wishlist']);
        }
        return 0;
    }
    public static function getProducts()
    {
        if (isset($_SESSION['wishlist'])) {
            return $_SESSION['wishlist'];
        }
        return false;
    }

    public static function deleteProductById($productCode)
    {
        if (isset($_SESSION['wishlist'])) {
            $productsInWishList = $_SESSION['wishlist'];

            if (in_array($productCode, $productsInWishList)) {
                if (($key = array_search($productCode, $productsInWishList)) !== false) {
                    unset($productsInWishList[$key]);
                    var_dump($productsInWishList);
                }
            }
            $_SESSION['wishlist'] = $productsInWishList;
        }
    }
}