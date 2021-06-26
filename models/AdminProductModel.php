<?php
require_once 'BaseModel.php';
require_once './core/Database.php';

class AdminProductModel extends BaseModel
{
    const TABLE = 'product';
    public function addProduct($productData)
    {
        return $this->create(self::TABLE, $productData);
    }


    public function addImage($image)
    {
        return $this->create('product_images', $image);
    }

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
    public static function totalRecords()
    {
        $db = new DB;
        $conn = $db->connect();
        $sql = "SELECT COUNT(*) FROM " . self::TABLE;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    public function getImagesById($productCode)
    {
        $sql = "SELECT * FROM product_images WHERE product_relation = '$productCode' ";
        return $this->_query($sql);
    }
    public function getProductByPage($page = 1, $limit = 5)
    {
        $start_from = ($page - 1) * $limit;
        $sql = "select * from product join product_category on product.cat_id = product_category.cat_id order by product_code desc limit $start_from, $limit";
        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getCategoryProduct($catId)
    {
        $sql = "Select cat_name From product_category Where cat_id = $catId ";
        $query = $this->_query($sql);
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            return $row['cat_name'];
        }

        return false;
    }

    public function deleteProductById($productCode)
    {
        $queryGetImages = $this->getImagesById($productCode);
        if (mysqli_num_rows($queryGetImages) > 0) {
            while ($row = mysqli_fetch_assoc($queryGetImages)) {
                $filePath = ROOT . '/upload/images/products/' . $row['file_name'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        return $this->delete(self::TABLE, 'product_code', $productCode);
    }
    public function getProductById($productCode)
    {
        return $this->find(self::TABLE, 'product_code', $productCode);
    }

    public function updateProductById($productCode, $data)
    {
        return $this->update(self::TABLE, 'product_code', $productCode, $data);
    }

    public function deleteAllImagesProduct($productCode)
    {
        $queryGetImages = $this->getImagesById($productCode);
        if (mysqli_num_rows($queryGetImages) > 0) {
            while ($row = mysqli_fetch_assoc($queryGetImages)) {
                $filePath = ROOT . '/upload/images/products/' . $row['file_name'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        return $this->delete('product_images', 'product_relation', $productCode);
    }
    function search($search)
    {
        $sql = "SELECT * FROM " . self::TABLE . " join product_category on product.cat_id = product_category.cat_id WHERE product_name LIKE '%$search%'  || product_code LIKE '%$search%' LIMIT 5";
        $result = $this->_query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $dataHtml = '';
            while ($row = mysqli_fetch_array($result)) {
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

            foreach ($data as $product) {
                $dataHtml .= "<tr>

                <td class=' text-dark  d-md-table-cell '>" . $product['product_code'] . "</td>
                <td class=' text-dark  d-md-table-cell '>
                    " . $product['product_name'] . "
                </td>

                <td>";


                if (isset($product['image_name'])) {
                    $dataHtml .= "<img width= '100' src='upload/images/products/" . $product['image_name'] . "' alt='image'></img>";
                } else {
                    $dataHtml .=  "<img width= '100' src='assets/images/no_image.jpg' alt='image'></img>";
                }
                $dataHtml .= "
                        
                </td>

                <td class=' text-dark  d-md-table-cell '>
                    " .
                    $product['cat_name']
                    . "
                </td>

                <td class='text-dark  d-md-table-cell '>" .  $product['price'] . "</td>
                <td class=' text-dark  d-md-table-cell '>" . $product['price_old'] . " </td>
                <td class=' text-dark  d-md-table-cell '>" . $product['tag_name'] . "</td>
                <td>

                    <a type='button'
                        href='adminproduct/update/" . $product['product_code'] . "'
                        class='btn btn-success btn-sm rounded-0 button-action button-first'
                        data-toggle='tooltip' data-placement='top' title=''
                        data-original-title='Edit'>
                        <i class='mdi mdi-square-edit-outline'></i>
                    </a>

                    <a type='button' data-id='" . $product['product_code'] . "'
                        class='btn btn-danger btn-sm rounded-0 button-action deleteRow'
                        data-toggle='tooltip' data-placement='top' title= ''
                        data-original-title='Delete' aria-describedby='tooltip84720'>
                        <i class='mdi mdi-delete-outline'></i>

                    </a>


                </td>
            </tr>";
            };

            return $dataHtml;
        } else {
            return 'Không có bản ghi nào phù hợp';
        }
    }
}