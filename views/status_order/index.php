<?php
include_once("views/layouts/user_header.php");
?>

<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Xem trạng thái đơn hàng</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>Xem trạng thái đơn hàng</span>
                    </li>
                </ol>
            </nav>

        </div>

    </div>


</div>
<div class="container-lg  container-fixed mt-5 mb-5">

    <div class="row">
        <div class="col-12">

        </div>
        <div class="col-12 text-center">
            <form action="" method="post">
                <label for="input_search">
                    <h4>Nhập mã đơn hàng</h4>
                </label>

                <div class="input-group">
                    <input type="text" name="search_order" class="form-control" id="input_search" placeholder="">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit" name="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (!empty($data['alert'])) {
            echo "<div class='col-12 text-center text-info mt-3'> <h5>
                " . $data['alert'] . "</h5>
              </div>";
        }
        ?>
        <?php if (!empty($data['mainInfor']) && !empty($data['orderDetails'])) {
            $phpdate = strtotime($data['mainInfor']['date_order']);
            $date_order = date('d-m-Y', $phpdate);
        ?>
        <div class="col-md-12 mt-5 mb-5">
            <div class="order-infor row">
                <div class="col-md-2 col-sm-6 mt-2">
                    <span>Mã hóa đơn: </span>
                    <h5><?php echo $data['mainInfor']['order_id'] ?></h5>
                </div>
                <div class="col-md-2 col-sm-6 mt-2">
                    <span>Ngày đặt hàng: </span>
                    <h5><?php echo $date_order ?></h5>
                </div>
                <div class="col-md-4 col-sm-6 mt-2">
                    <span>Email: </span>
                    <h5><?php echo $data['mainInfor']['email'] ?></h5>
                </div>
                <div class="col-md-2 col-sm-6 mt-2">
                    <span>Tổng tiền thanh toán </span>
                    <h5><?php echo number_format($data['mainInfor']['total_price'], 0, ',', '.') . '₫' ?></h5>
                </div>
                <div class="col-md-2 col-sm-6 mt-2">
                    <span>Trạng thái </span>


                    <?php if ($data['mainInfor']['status'] == 1)
                            echo "<p class='text-success' style='font-size: 17px;'>Đã nhận hàng</p>";
                        else {
                            echo "<p class='text-warning' style='font-size: 17px;'>Đang giao hàng</p>";
                        }
                        ?>


                </div>
            </div>
            <div class="order-details">
                <h5 class="mt-4 mb-4">Chi tiết hóa đơn</h5>
                <div class="table-responsive-sm cart-table">
                    <table class="table table-borderless" style="margin-bottom: 0">
                        <thead>
                            <tr style="background-color: #f8f8f8">
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach ($data['orderDetails'] as $product) :  ?>

                            <tr style=" font-size: 17px">
                                <td class="d-lg-block d-md-flex flex-column align-items-center">
                                    <a href="product/view/<?php echo $product['product_code'] ?>" target="_blank">
                                        <h5 style="display: inline-block"><?php echo $product['product_name'] ?></h5>
                                    </a>
                                    <?php echo 'x ' . $product['quantity_order'] ?>
                                </td>



                                <td><?php echo number_format($product['price_order'] * $product['quantity_order'], 0, ',', '.') . '₫' ?>
                                </td>

                            </tr>
                            <?php endforeach;
                                ?>
                        </tbody>

                    </table>

                </div>
            </div>


        </div>

        <?php
        }   ?>






    </div>
</div>










<?php
include_once("views/layouts/user_footer.php");
?>