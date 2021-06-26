<?php
require_once 'BaseModel.php';

class OrderModel extends BaseModel
{
    const CUSTOMER_TABLE = 'customer';
    const ORDER_TABLE = 'customer_order';
    const ORDER_DETAILS_TABLE = 'order_details';
    const PRODUCT_TABLE = 'product';
    public function totalRevenue()
    {
        $sql = "select sum(total_price)from " . self::ORDER_TABLE;
        $result = $this->_query($sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    public function totalRevenueThisDay()
    {
        $sql = "select sum(total_price) from " . self::ORDER_TABLE . " where date_order = CURDATE()";
        $result = $this->_query($sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    public function addCustomer($data)
    {
        return $this->create(self::CUSTOMER_TABLE, $data);
    }
    public function getNextCustomerId()
    {
        $sql = "SHOW TABLE STATUS LIKE '" . self::CUSTOMER_TABLE . "'";
        $result = $this->_query($sql);
        $row = mysqli_fetch_array($result);
        return $row['Auto_increment'];
    }
    public function getNextOrderId()
    {
        $sql = "SHOW TABLE STATUS LIKE '" . self::ORDER_TABLE . "'";
        $result = $this->_query($sql);
        $row = mysqli_fetch_array($result);
        return $row['Auto_increment'];
    }
    public function addOrder($data)
    {
        return $this->create(self::ORDER_TABLE, $data);
    }

    public function addOrderDetails($data)
    {
        return $this->create(self::ORDER_DETAILS_TABLE, $data);
    }
    public function updateStatusOrder($orderID, $data)
    {
        return $this->update(self::ORDER_TABLE, 'order_id', $orderID, ['status' => $data]);
    }
    public static function totalRecords()
    {
        $db = new DB;
        $conn = $db->connect();
        $sql = "SELECT COUNT(*) FROM " . self::CUSTOMER_TABLE . " as C join " . self::ORDER_TABLE . " as O on C.c_id = O.c_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    public function getAllMainOrder($page = 1, $limit = 5)
    {
        $start_from = ($page - 1) * $limit;
        $sql = "select * from " . self::CUSTOMER_TABLE . " as C join " . self::ORDER_TABLE . " as O on C.c_id = O.c_id order by order_id desc limit $start_from, $limit";
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getMainOrderById($orderID)
    {
        $sql = "select * from " . self::CUSTOMER_TABLE . " as C join " . self::ORDER_TABLE . " as O on C.c_id = O.c_id where O.order_id = '" . $orderID . "'";
        $result = $this->_query($sql);
        return mysqli_fetch_array($result);
    }
    public function getOrderDetailsById($orderID)
    {
        $sql = "select * from " . self::ORDER_DETAILS_TABLE . " as OD join " . self::PRODUCT_TABLE . " as P on OD.product_code = P.product_code where OD.order_id = '" . $orderID . "'";
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($data, $row);
        }
        return $data;
    }
    public function getOrderDetailsAdmin($orderID)
    {
        $data = $this->getOrderDetailsById($orderID);
        $dataHtml = '';
        foreach ($data as $productOrder) {
            $dataHtml .= '<tr>
            <td>' . $productOrder['product_code'] . '</td>
            <td class=" text-dark  d-md-table-cell ">' . $productOrder["product_name"] . '</td>
            <td>' . $productOrder["quantity_order"] . '</td>
            <td>' . number_format($productOrder['price_order'] * $productOrder['quantity_order'], 0, ',', '.') . '₫' . '</td>
            </tr>';
        }
        return $dataHtml;
    }
    public function search($search)
    {
        $sql = "select * from " . self::CUSTOMER_TABLE . " as C join " . self::ORDER_TABLE . " as O on C.c_id = O.c_id where order_id LIKE '%$search%' limit 5";
        $result = $this->_query($sql);
        $dataHtml = '';
        while ($order = mysqli_fetch_array($result)) {
            $phpdate = strtotime($order['date_order']);
            $order['date_order'] = date('d-m-Y', $phpdate);
            $dataHtml .= "
            <tr>
                <td>" . $order['order_id'] . "</td>
            <td class=' text-dark  d-md-table-cell '>
            " . $order['date_order'] . "
            </td>
            <td>" . $order['fullname'] . "</td>
            <td class=' text-dark  d-md-table-cell '>" . $order['address'] . "</td>
            <td>" . $order['phone'] . "</td>
            <td class=' text-dark  d-md-table-cell '>
            " . number_format($order['total_price'], 0, ',', '.') . '₫' . "</td>
            <td class=' d-md-table-cell' >";
            if ($order['status'] == 1) {
                $dataHtml .= " <span class=' badge badge-success '>Đã nhận hàng</span>";
            } else {
                $dataHtml .= " <a id='updateStatus' style='cursor:pointer' data-id='" . $order['order_id'] . "'>
                                                <span class=' badge badge-warning' >Đang giao hàng </span> </a>
                                            ";
            }
            $dataHtml .= " </td>
            <td>
            <a data-toggle='modal' data-target='.bd-example-modal-lg' data-id='" . $order['order_id'] . "'
            id='order-details' type='button'
            class='btn btn-sm rounded-0 button-action' style='background-color: rgb(8, 174, 234);' data-toggle='tooltip'
            data-placement='top' title='' data-original-title='Edit'>
            <i class='mdi mdi-eye-outline'></i>
            </a>


            </td>
            </tr>";
        }
        return $dataHtml;
    }
}