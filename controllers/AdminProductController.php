<?php
require_once('controllers/BaseController.php');

class AdminProductController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin_product';
    }
    public function index($name = 'page', $page = 1)
    {
        if ($name == 'page') {
            $this->loadModel('AdminProductModel');
            $productModel = new AdminProductModel;
            $data = $productModel->getProductByPage($page);
            $data = array_map(function ($item) {
                $productModel = new AdminProductModel;
                $query = $productModel->getFirstImagesById($item['product_code']);
                if (!empty($query)) {
                    $item['image_name'] = $query['file_name'];
                    return $item;
                }
                return $item;
            }, $data);
            $this->render(
                'index',
                $data
            );
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }

    public function add()
    {
        $this->loadModel('AdminCategoryModel');
        $this->loadModel('AdminProductModel');
        $catModel = new AdminCategoryModel;
        $productModel = new AdminProductModel;
        $dataParent = $catModel->getAllCategory();
        if (isset($_POST['submit'])) {
            $product_code = $this->validate_input($_POST['product_code']);
            $cat_id = $this->validate_input($_POST['cat_id']);
            $product_name = $this->validate_input($_POST['product_name']);
            $quantity = $this->validate_input($_POST['quantity']);
            echo $quantity;
            $price = $this->validate_input($_POST['price']);
            $price_old = $this->validate_input($_POST['price_old']);
            $tag_name = $this->validate_input($_POST['tag_name']);
            $featured_product = isset($_POST['featured_product']) ? 1 : 0;
            $description = $productModel->real_escape($_POST['description']);

            if (empty($product_code) || empty($cat_id) || empty($product_name) || empty($price) || empty($price_old) || empty($tag_name)) {
                $this->render('add', ['error' => 'Yêu cầu nhập đầy đủ thông tin', 'parent_id' => $dataParent]);
            } else {
                $productModel->addProduct([
                    'product_code' => $product_code,
                    'cat_id' => $cat_id,
                    'product_name' => $product_name,
                    'quantity' => $quantity,
                    'price' => $price,
                    'price_old' => $price_old,
                    'tag_name' => $tag_name,
                    'description' => $description,
                    'featured_product' => $featured_product
                ]);

                $total = count(array_filter($_FILES['upload']['name']));
                for ($i = 0; $i < $total; $i++) {

                    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                    if ($tmpFilePath != "") {
                        $newFilePath = ROOT . "/upload/images/products/" . $_FILES['upload']['name'][$i];

                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $productModel->addImage([
                                'file_name' => $_FILES['upload']['name'][$i],
                                'product_relation' => $product_code
                            ]);
                        }
                    }
                }
                header('Location: ../adminproduct/index');
            }
        }
        $this->render('add', ['parent_id' => $dataParent]);
    }
    public function delete($productCode = '')
    {
        if (!empty($productCode)) {
            $this->loadModel('AdminProductModel');
            $productCode = $this->validate_input($productCode);
            $productModel = new AdminProductModel;
            $productModel->deleteProductById($productCode);
            echo "Xóa thành công";
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }


    public function update($productCode = '')
    {
        $this->loadModel('AdminCategoryModel');
        $catModel = new AdminCategoryModel;
        $dataParent = $catModel->getAllCategory();

        $this->loadModel('AdminProductModel');
        $productModel = new AdminProductModel;
        if (isset($_POST['submit'])) {
            $product_code = $this->validate_input($_POST['product_code']);
            $cat_id = $this->validate_input($_POST['cat_id']);
            $product_name = $this->validate_input($_POST['product_name']);
            $quantity = $this->validate_input($_POST['quantity']);
            $price = $this->validate_input($_POST['price']);
            $price_old = $this->validate_input($_POST['price_old']);
            $tag_name = $this->validate_input($_POST['tag_name']);
            $description = $productModel->real_escape($_POST['description']);
            $featured_product = isset($_POST['featured_product']) ? 1 : 0;
            if (empty($product_code) || empty($cat_id) || empty($product_name)  || empty($price) || empty($price_old) || empty($tag_name)) {
                $this->render('add', ['error' => 'Yêu cầu nhập đầy đủ thông tin', 'parent_id' => $dataParent]);
            } else {
                $productModel->updateProductById($productCode, [
                    'product_code' => $product_code,
                    'cat_id' => $cat_id,
                    'product_name' => $product_name,
                    'quantity' => $quantity,
                    'price' => $price,
                    'price_old' => $price_old,
                    'tag_name' => $tag_name,
                    'description' => $description,
                    'featured_product' => $featured_product
                ]);

                $total = count(array_filter($_FILES['upload']['name']));
                if ($total > 0) {
                    $productModel->deleteAllImagesProduct($productCode);
                    for ($i = 0; $i < $total; $i++) {

                        $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                        if ($tmpFilePath != "") {
                            $newFilePath = ROOT . "/upload/images/products/" . $_FILES['upload']['name'][$i];

                            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                                $productModel->addImage([
                                    'file_name' => $_FILES['upload']['name'][$i],
                                    'product_relation' => $product_code
                                ]);
                            }
                        }
                    }
                }
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/adminproduct");
            }
        } else {
            if (!empty($productCode)) {
                $productCode = $this->validate_input($productCode);
                $productData = $productModel->getProductById($productCode);
                $imagesData = $productModel->getImagesById($productCode);
                $this->render('update', [
                    'parent_id' => $dataParent,
                    'productData' => $productData,
                    'imagesData' => $imagesData

                ]);
            } else {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
            }
        }
    }
    public function search()
    {
        if (isset($_POST['query'])) {
            $this->loadModel('AdminProductModel');
            $productModel = new AdminProductModel;
            $dataHtml = $productModel->search($_POST['query']);
            echo $dataHtml;
        }
    }
}