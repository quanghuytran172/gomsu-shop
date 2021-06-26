<?php
require_once(ROOT . '/core/Database.php');
class BaseModel extends DB
{
    public $conn;
    function __construct()
    {
        $this->conn = $this->connect();
    }

    //Lay ra tat ca du lieu trong bang
    function all($table, $select = ['*'], $orderBys = [], $limit = 15)
    {
        $columns = implode(',', $select);
        $orderByString = implode(' ', $orderBys);

        if ($orderByString) {
            $sql = "SELECT ${columns} FROM ${table} ORDER BY ${orderByString} LIMIT ${limit}";
        } else {
            $sql = "SELECT ${columns} FROM ${table} LIMIT ${limit}";
        }


        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }
    // Lay ra 1 ban ghi trong bang
    function find($table, $id_table, $id)
    {
        $sql = "SELECT * FROM ${table} WHERE ${id_table} = '${id}' LIMIT 1";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    // Them du lieu vao bang
    function create($table, $data = [])
    {

        $columns = implode(',', array_keys($data));
        $values = implode("','", array_values($data));
        $sql = "INSERT INTO ${table}(${columns}) VALUES ('{$values}')";

        mysqli_query($this->conn, $sql);
    }

    // Update du lieu vao bang
    function update($table,  $id_table, $id_update, $data)
    {
        $dataSets = [];

        foreach ($data as $key => $val) {
            array_push($dataSets, "${key} = '" . $val . "'");
        }
        $dataSetString = implode(',', $dataSets);
        $sql = "UPDATE ${table} SET ${dataSetString} WHERE $id_table = '${id_update}'";
        $this->_query($sql);
    }

    // Xoa du lieu cua bang
    function delete($table, $id_table, $id_update)
    {
        $sql = "DELETE FROM ${table} WHERE ${id_table} = '${id_update}'";
        $this->_query($sql);
    }

    public function _query($sql)
    {
        return mysqli_query($this->conn, $sql);
    }
}