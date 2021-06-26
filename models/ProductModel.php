<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel
{
    const TABLE = 'product';

    public function getFirstImagesById($productCode)
    {
        $sql = "SELECT * FROM product_images WHERE product_relation = '$productCode' ";
        $query = $this->_query($sql);
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            return $row;
        }
        return false;
    }
    public function getImagesById($productCode)
    {
        $sql = "SELECT * FROM product_images WHERE product_relation = '$productCode' ";
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getProductByCode($productCode)
    {
        $sql = "select * from product join product_category on product.cat_id = product_category.cat_id where product_code = '$productCode'";
        $result = $this->_query($sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data = $row;
            $dataImages = $this->getImagesById($productCode);
            if (!empty($dataImages)) {
                $data['images'] = $dataImages;
            }
            return $data;
        }
        return $data;
    }
    public function getAllProductByCode($productCodeArr)
    {
        $idsString = implode("','", $productCodeArr);
        $sql = "SELECT * FROM product WHERE product_code IN ('$idsString')";
        $result = $this->_query($sql);
        $i = 0;
        $products = array();
        while ($row = mysqli_fetch_array($result)) {
            $products[$i]['product_code'] = $row['product_code'];
            $products[$i]['product_name'] = $row['product_name'];
            $products[$i]['price_old'] = $row['price_old'];
            $products[$i]['quantity'] = $row['quantity'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['file_name'] = $this->getFirstImagesById($row['product_code'])['file_name'];
            $i++;
        }
        return $products;
    }
    public function getFeaturedProducts($cat_id, $limit = 12)
    {
        $sql = "Select pd.* from product as pd join product_category as pc on pd.cat_id = pc.cat_id where (pc.cat_id = $cat_id || pc.parent_id = $cat_id) and pd.featured_product = 1 limit $limit";
        $result = $this->_query($sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }
            $data = array_map(function ($item) {
                $query = $this->getFirstImagesById($item['product_code']);
                if (!empty($query)) {
                    $item['image_name'] = $query['file_name'];
                    return $item;
                }
                return $item;
            }, $data);
        }
        return $data;
    }

    public function getProductByCategory($cat_id, $limit = 12)
    {
        $sql = "Select pd.* from product as pd join product_category as pc on pd.cat_id = pc.cat_id where pc.cat_id = $cat_id || pc.parent_id = $cat_id  limit $limit";
        $result = $this->_query($sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }
            $data = array_map(function ($item) {
                $query = $this->getFirstImagesById($item['product_code']);
                if (!empty($query)) {
                    $item['image_name'] = $query['file_name'];
                    return $item;
                }
                return $item;
            }, $data);
        }
        return $data;
    }
    public function totalProductByCategory($cat_id)
    {
        $sql = "Select count(*) from product as pd join product_category as pc on pd.cat_id = pc.cat_id where pc.cat_id = $cat_id || pc.parent_id = $cat_id ";
        $result = $this->_query($sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }

    public function getProductByPage($page = 1, $limit = 12)
    {
        $start_from = ((int)$page - 1) * $limit;
        $sqlLimit = $start_from . ',' . $limit;
        $data =  $this->all(self::TABLE, ['*'], [], $sqlLimit);
        $data = array_map(function ($item) {
            $query = $this->getFirstImagesById($item['product_code']);
            if (!empty($query)) {
                $item['image_name'] = $query['file_name'];
                return $item;
            }
            return $item;
        }, $data);
        return $data;
    }

    public static function totalRecordsProduct()
    {
        $db = new DB;
        $conn = $db->connect();
        $sql = "SELECT COUNT(*) FROM " . self::TABLE;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return (int)$row[0];
    }
    public function getNextProducts($nextPage, $cat_id = '', $limit = 12)
    {
        $data = [];
        if (empty($cat_id)) {
            $data = $this->getProductByPage($nextPage, $limit);
        } else {
            $start_from = ($nextPage - 1) * $limit;
            $sqlLimit = $start_from . ',' . $limit;
            $sql = "Select pd.* from product as pd join product_category as pc on pd.cat_id = pc.cat_id where pc.cat_id = $cat_id || pc.parent_id = $cat_id  limit $sqlLimit";
            $result = $this->_query($sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($data, $row);
                }
                $data = array_map(function ($item) {
                    $query = $this->getFirstImagesById($item['product_code']);
                    if (!empty($query)) {
                        $item['image_name'] = $query['file_name'];
                        return $item;
                    }
                    return $item;
                }, $data);
            }
        }


        $dataHtml = '';
        foreach ($data as $product) {
            $dataHtml .= "
            <div class='col-xl-4 col-lg-4 col-sm-6 column-fixed'>
                <div class='product-container'>
                    <div class='image-p'>
                        <a href='product/" . $product['product_code'] . " '>
<img class='img-fluid'";
            if (isset($product['image_name'])) {
                $dataHtml .= "src='upload/images/products/" . $product['image_name'] . "'>";
            } else {
                $dataHtml .= "src='assets/images/no_image.jpg'>";
            }
            $dataHtml .= "
        </a>
        </div>
        <h3>
            <a href='product/" . $product['product_code'] . "'>" . $product['product_name'] . "</a>
        </h3>

        <p>" . number_format($product['price'], 0, ',', '.') . '₫';

            if ($product['price_old'] > 0) {
                $dataHtml .= "<del style='color: #959595; font-size: 14px'><span class='ml-1'>" . number_format($product['price_old'], 0, ',', '.') . "₫ </span></del>";
            }

            $dataHtml .= "</p>
        <div class='abs-fix'>
            <div class='cart-box'>
            <button class='style-btn add_to_wishlist'
            data-product-id='" . $product['product_code'] . "'>
            <i class='far fa-heart'></i>
        </button>

        <button class='style-btn' style='display: none;'>
            <div class='spinner-border' role='status'
                style='width: 26px;  height: 26px; font-size: 10px; '>
                <span class='sr-only'>Loading...</span>
            </div>
        </button>";
            if ($product['quantity'] > 0) {
                $dataHtml .= "<button class='atc button_between add_to_cart_product'
            data-product-id='" . $product['product_code'] . "'>
            THÊM VÀO GIỎ HÀNG
            </button>";
            } else {
                $dataHtml .= "<button class='atc button_between atc-empty'>
            HẾT HÀNG
            </button>";
            }
            $dataHtml .= "
                <button class='atc button_between' style=' display: none; margin-left: 5px;'
                                        id='loading_add_to_cart'>
                                        <div class='spinner-border' role='status'
                                            style='width: 1rem; height: 1rem ;font-size: 11px;  '>
                                            <span class='sr-only'>Loading...</span>
                                        </div>
                                    </button>
                <button class='style-btn'>
                    <i class='fas fa-search'></i>
                </button>
            </div>
        </div>

        </div>
        </div>
";
        }
        return $dataHtml;
    }
    public static function totalRecordsProductSearch($searchName)
    {
        $db = new DB;
        $conn = $db->connect();
        $sql = "SELECT COUNT(*) FROM product where product_code LIKE '%$searchName%' || product_name LIKE '%$searchName%'  ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return (int)$row[0];
    }
    public function getProductFromSearch($searchName, $page = 1, $limit = 12)
    {
        $start_from = ((int)$page - 1) * $limit;
        $sqlLimit = $start_from . ',' . $limit;
        $sql = "select * from product where product_code LIKE '%$searchName%' || product_name LIKE '%$searchName%' limit $sqlLimit ";
        $result = $this->_query($sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }
            $data = array_map(function ($item) {
                $query = $this->getFirstImagesById($item['product_code']);
                if (!empty($query)) {
                    $item['image_name'] = $query['file_name'];
                    return $item;
                }
                return $item;
            }, $data);
            return $data;
        }
        return $data;
    }
    public function getNextProductsFromSearch($searchName, $nextPage, $limit = 12)
    {
        $data = [];
        $data = $this->getProductFromSearch($searchName, $nextPage, $limit);
        $dataHtml = '';
        foreach ($data as $product) {
            $dataHtml .= "
            <div class='col-xl-4 col-lg-4 col-sm-6 column-fixed'>
                <div class='product-container'>
                    <div class='image-p'>
                        <a href='product/" . $product['product_code'] . " '>
<img class='img-fluid'";
            if (isset($product['image_name'])) {
                $dataHtml .= "src='upload/images/products/" . $product['image_name'] . "'>";
            } else {
                $dataHtml .= "src='assets/images/no_image.jpg'>";
            }
            $dataHtml .= "
        </a>
        </div>
        <h3>
            <a href='product/" . $product['product_code'] . "'>" . $product['product_name'] . "</a>
        </h3>

        <p>" . number_format($product['price'], 0, ',', '.') . '₫';

            if ($product['price_old'] > 0) {
                $dataHtml .= "<del style='color: #959595; font-size: 14px'><span class='ml-1'>" . number_format($product['price_old'], 0, ',', '.') . "₫ </span></del>";
            }

            $dataHtml .= "</p>
        <div class='abs-fix'>
            <div class='cart-box'>
            <button class='style-btn add_to_wishlist'
            data-product-id='" . $product['product_code'] . "'>
            <i class='far fa-heart'></i>
        </button>

        <button class='style-btn' style='display: none;'>
            <div class='spinner-border' role='status'
                style='width: 26px;  height: 26px; font-size: 10px; '>
                <span class='sr-only'>Loading...</span>
            </div>
        </button>";
            if ($product['quantity'] > 0) {
                $dataHtml .= "<button class='atc button_between add_to_cart_product'
            data-product-id='" . $product['product_code'] . "'>
            THÊM VÀO GIỎ HÀNG
            </button>";
            } else {
                $dataHtml .= "<button class='atc button_between atc-empty'>
            HẾT HÀNG
            </button>";
            }
            $dataHtml .= "
                <button class='atc button_between' style=' display: none; margin-left: 5px;'
                                        id='loading_add_to_cart'>
                                        <div class='spinner-border' role='status'
                                            style='width: 1rem; height: 1rem ;font-size: 11px;  '>
                                            <span class='sr-only'>Loading...</span>
                                        </div>
                                    </button>
                <button class='style-btn'>
                    <i class='fas fa-search'></i>
                </button>
            </div>
        </div>

        </div>
        </div>
";
        }
        return $dataHtml;
    }
}