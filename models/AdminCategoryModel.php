<?php
require_once 'BaseModel.php';

class AdminCategoryModel extends BaseModel
{
    const TABLE = 'product_category';
    public function addCategory($categoryData)
    {
        return $this->create(self::TABLE, $categoryData);
    }

    function getAllCategory($page = 1, $limit = 1000)
    {
        $start_from = ($page - 1) * $limit;
        $sqlLimit = $start_from . ',' . $limit;
        $dataArr = $this->all(self::TABLE, ['*'], [], $sqlLimit);
        $dataArr = array_map(function ($item) {
            $sql = "Select * From product_category Where cat_id = $item[parent_id]";
            $result = $this->_query($sql);
            $result = mysqli_fetch_assoc($result);
            if (!empty($result['cat_name'])) {
                $item['parent_name'] = $result['cat_name'];
            }
            return $item;
        }, $dataArr);
        return $dataArr;
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
    function updateCategoryById($categoryId, $data)
    {
        return $this->update(self::TABLE, 'cat_id', $categoryId, $data);
    }
    function deleteCategoryById($categoryId)
    {
        return $this->delete(self::TABLE, 'cat_id', $categoryId);
    }
    function getCategoryById($categoryId)
    {
        return $this->find(self::TABLE, 'cat_id', $categoryId);
    }
    function search($search)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE cat_name LIKE '%$search%' LIMIT 5";
        $result = $this->_query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $dataHtml = '';
            while ($row = mysqli_fetch_array($result)) {
                array_push($data, $row);
            }
            $data = array_map(function ($item) {
                $sql = "Select * From product_category Where cat_id = $item[parent_id]";
                $result = $this->_query($sql);
                $result = mysqli_fetch_assoc($result);
                if (!empty($result['cat_name'])) {
                    $item['parent_name'] = $result['cat_name'];
                }
                return $item;
            }, $data);

            foreach ($data as $value) {
                $dataHtml .= "<tr>

                <td>" . $value['cat_id'] . " </td>
                <td class=' text-dark  d-md-table-cell '>
                    " . $value['cat_name'] . "
                </td>
                <td class=' d-md-table-cell '>";
                if ($value['parent_id'] == 0) {
                    $dataHtml .= 'None';
                } else {
                    $dataHtml .= $value['parent_name'];
                }
                $dataHtml .= "
                </td>

                <td>

                    <a type='button' href='admincategory/update/" . $value['cat_id'] . " '
                        class='btn btn-success btn-sm rounded-0 button-action button-first'
                        data-toggle='tooltip' data-placement='top' title=''
                        data-original-title='Edit'>
                        <i class='mdi mdi-square-edit-outline'></i>
                    </a>
                    <a type='button' data-id='" . $value['cat_id'] . "'
                        class='btn btn-danger btn-sm rounded-0 button-action deleteRow'
                        data-toggle='tooltip' data-placement='top' title=''
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