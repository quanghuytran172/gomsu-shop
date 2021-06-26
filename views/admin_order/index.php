<?php
include_once('views/layouts/admin_header.php');
include_once('models/OrderModel.php');
?>
<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="breadcrumb-wrapper">
            <h1>Danh sách hóa đơn bán hàng</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="admin">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        Hóa đơn bán hàng
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Danh sách hóa đơn bán hàng</li>
                </ol>
            </nav>
        </div>
        <!-- Recent Order Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-table-border-none" id="recent-orders">

                    <div class=" card-header justify-content-between ">
                        <h2>Danh sách hóa đơn bán hàng</h2>

                    </div>

                    <div class="table-responsive-sm card-body pt-0 pb-5">
                        <div>
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        </div>
                        <table class=" table card-table table-responsive table-responsive-large " style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Mã Hóa Đơn</th>
                                    <th>Ngày Đặt</th>
                                    <th class=" d-md-table-cell ">
                                        Khách Hàng
                                    </th>
                                    <th>Địa Chỉ</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Tổng Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Chi Tiết Sản Phẩm</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                foreach ($data as $order) :

                                    $phpdate = strtotime($order['date_order']);
                                    $order['date_order'] = date('d-m-Y', $phpdate); ?>

                                <tr>

                                    <td><?php echo $order['order_id'] ?></td>
                                    <td class=" text-dark  d-md-table-cell ">
                                        <?php echo $order['date_order'] ?>
                                    </td>
                                    <td><?php echo $order['fullname'] ?></td>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $order['address'] ?></td>
                                    <td><?php echo $order['phone'] ?></td>
                                    <td class=" text-dark  d-md-table-cell ">
                                        <?php echo number_format($order['total_price'], 0, ',', '.') . '₫' ?></td>
                                    <td class=" d-md-table-cell ">
                                        <?php
                                            if ($order['status'] == 1) {
                                                echo "  <span class=' badge badge-success '>Đã nhận hàng</span>";
                                            } else {
                                                echo " <a id='updateStatus' style='cursor:pointer' data-id='" . $order['order_id'] . "'>
                                                <span class='
                                                                        badge
                                                                        badge-warning 
                                                                    ' >Đang giao hàng </span> </a>
                                            ";
                                            }
                                            ?>
                                    </td>
                                    <td>
                                        <a data-toggle="modal" data-target=".bd-example-modal-lg"
                                            data-id="<?php echo $order['order_id'] ?>" id="order-details" type="button"
                                            class="btn btn-sm rounded-0 button-action"
                                            style="background-color: rgb(8, 174, 234);" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="Edit">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </a>


                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>


                        </table>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" style="max-width: 960px; top: 100px">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-dark" id="myLargeModalLabel">Chi tiết hóa đơn</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class=" table card-table table-responsive table-responsive-large mt-0"
                                            style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Mã Sản Phẩm</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>
                                                        Số Lượng
                                                    </th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody id="productOrder">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <nav aria-label="Page navigation " style="display:inline-block">
                                <?php
                                $page = new Pagination([
                                    'total' => OrderModel::totalRecords(),
                                    'limit' => 5,
                                    'full' => false,
                                    'querystring' => 'page',
                                    'path' => 'adminorder/index'
                                ]);
                                echo $page->getPagination();
                                ?>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Search category Ajax
    function loadData(query) {
        $.ajax({
            url: "adminorder/search",
            type: "POST",
            data: {
                query: query
            },
            success: res => {
                $('table tbody').html(res);
            }
        })
    }


    var htmlOld = $("table tbody").html();
    $("#myInput").keyup(function() {
        var search = $(this).val();
        if (search != "") {
            loadData(search);
        } else {
            $("table tbody").html(htmlOld);
        }
    });
    // Update Status Order Ajax
    $('body').on("click", "#updateStatus", function(e) {

        e.preventDefault();
        var orderId = $(this).attr('data-id');
        var thisItem = $(this);
        bootbox.dialog({
            message: 'Xác nhận thay đổi trạng thái ?',
            title: ' Thay đổi trạng thái',
            buttons: {
                success: {
                    label: 'Hủy',
                    className: 'btn-success',
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: 'Xác nhận',
                    className: 'btn-danger',
                    callback: function() {


                        $.ajax({

                                type: 'POST',
                                url: 'adminorder/changestatusorder/' +
                                    orderId

                            })
                            .done(function(response) {

                                bootbox.alert(response);
                                thisItem.html(
                                    "<span class=' badge badge-success '>Đã nhận hàng</span>"
                                );
                            })
                            .fail(function() {

                                bootbox.alert(
                                    'Something Went Wrog ....'
                                );

                            })

                    }
                }
            }
        });


    });

    // zxc
    $('body').on("click", "#order-details", function(e) {

        e.preventDefault();
        var orderId = $(this).attr('data-id');
        $.ajax({

                type: 'POST',
                url: 'adminorder/view',
                data: {
                    orderId: orderId
                }

            })
            .done(function(response) {
                $('#productOrder').html(response);

            })


    });




});
</script>
<?php
include_once('views/layouts/admin_footer.php');
?>