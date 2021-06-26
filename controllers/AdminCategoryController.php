<?php
require_once('controllers/BaseController.php');

class AdminCategoryController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin_category';
    }
    public function index($name = 'page', $page = 1)
    {
        if ($name == 'page') {
            $this->loadModel('AdminCategoryModel');
            $catModel = new AdminCategoryModel;
            $data = $catModel->getAllCategory($page, 5);
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
        $catModel = new AdminCategoryModel;
        $dataParent = $catModel->getAllCategory();
        if (isset($_POST['submit'])) {

            $cat_name = $this->validate_input($_POST['cat_name']);
            $parent_id = $this->validate_input($_POST['parent_id']);
            if (empty($cat_name)) {
                $this->render('add', ['error' => 'Yêu cầu nhập đầy đủ thông tin', 'parent_id' => $dataParent]);
            } else {
                $catModel->addCategory([
                    'cat_name' => $cat_name,
                    'parent_id' => $parent_id
                ]);
                header('Location: ../admincategory/index');
            }
        }

        $this->render('add', ['parent_id' => $dataParent]);
    }
    public function delete($categoryId = '')
    {
        if (!empty($categoryId)) {
            $this->loadModel('AdminCategoryModel');
            $categoryId = $this->validate_input($categoryId);
            $catModel = new AdminCategoryModel;
            $catModel->deleteCategoryById($categoryId);
            echo "Xóa thành công";
            // header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/admincategory");
        } else {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
        }
    }


    public function update($categoryId = '')
    {
        $this->loadModel('AdminCategoryModel');
        $catModel = new AdminCategoryModel;
        $parentData = $catModel->getAllCategory();
        $categoryData = $catModel->getCategoryById($categoryId);
        if (isset($_POST['submit'])) {
            $cat_name = $this->validate_input($_POST['cat_name']);
            $parent_id = $this->validate_input($_POST['parent_id']);
            if (empty($cat_name)) {
                $this->render('update', [
                    'error' => 'Yêu cầu nhập đầy đủ thông tin',
                    'parentData' => $parentData,
                    'categoryData' => $categoryData
                ]);
            } else {
                $catModel->updateCategoryById($categoryId, [
                    'cat_name' => $cat_name,
                    'parent_id' => $parent_id
                ]);
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/admincategory");
            }
        } else {
            if (!empty($categoryId)) {
                $categoryId = $this->validate_input($categoryId);
                $catModel = new AdminCategoryModel;
                $this->render('update', [
                    'parentData' => $parentData,
                    'categoryData' => $categoryData
                ]);
            } else {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/gomsu_shop/NotFoundController");
            }
        }
    }
    public function search()
    {
        if (isset($_POST['query'])) {
            $this->loadModel('AdminCategoryModel');
            $catModel = new AdminCategoryModel;
            $dataHtml = $catModel->search($_POST['query']);
            echo $dataHtml;
        }
    }
}