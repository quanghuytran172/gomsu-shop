<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel
{
    const TABLE = 'product_category';
    public function getAllCategory()
    {
        return $this->all(self::TABLE);
    }
    public function getCategoryName($cat_id)
    {
        $result = $this->find(self::TABLE, 'cat_id', $cat_id);
        return $result;
    }
}