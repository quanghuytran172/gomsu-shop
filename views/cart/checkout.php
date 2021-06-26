<?php
include_once("views/layouts/user_header.php");
?>
<style>
.checkout-table table tbody tr {
    border-bottom: 1px solid #eee;
}

.checkout-table table tr th:last-child,
.checkout-table table tr td:last-child {
    text-align: right;
}

.checkout-box button[type="submit"] {
    margin-top: 1rem;
    padding: 12px 17px;
    color: #fff;
    background-color: #111;
}

.checkout-box button[type="submit"]:hover {
    color: #fff;
    opacity: 0.8;
    transition: 0.3s all;
}
</style>
<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Thanh toán</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>Thanh toán</span>
                    </li>
                </ol>
            </nav>

        </div>

    </div>


</div>
<div class="container-lg  container-fixed mt-5 mb-5">
    <form action="" method="post">
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($data['alert'])) {
                    echo '<div class="alert alert-warning" role="alert">' . $data['alert'] . '
                    </div>';
                }
                ?>

            </div>
            <div class="col-12">
                <h4>THÔNG TIN GIAO DỊCH</h4>

            </div>

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        <p style="font-weight: bold; margin-bottom: 0">THÔNG TIN MUA HÀNG</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title" style="font-size:17px; margin-bottom: 15px; padding-right: 15px;
    padding-left: 15px;">THÔNG TIN NGƯỜI MUA HÀNG
                            </h5>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Họ và tên người mua hàng</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="fullname" id="name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Số điện thoại liên lạc</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" id="phone" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="email" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label">Địa chỉ nhận hàng</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address" id="address" value="">
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-lg-4 checkout-box ">
                <div class="card">
                    <div class="card-header text-center">
                        <p style="font-weight: bold; margin-bottom: 0">ĐƠN HÀNG</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm cart-table checkout-table">
                            <table class="table table-borderless" id="list-cart"
                                style="margin-bottom: 0; font-size: 15px">
                                <thead>
                                    <tr style="background-color: #f8f8f8">
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data['products'])) {
                                        foreach ($data['products'] as $product) : ?>

                                    <tr>
                                        <td>
                                            <?php echo $product['product_name'] . ' x ' . $productsInCart[$product['product_code']] ?>

                                        </td>

                                        <td>
                                            <?php echo number_format($product['price'] * $productsInCart[$product['product_code']], 0, ',', '.') . '₫' ?>
                                        </td>
                                    </tr>
                                    <?php endforeach;
                                    } ?>


                                </tbody>
                                <tfoot>
                                    <?php
                                    if (!isset($data['totalPrice'])) {
                                        $data['totalPrice'] = 0;
                                    }
                                    ?>
                                    <tr>
                                        <th>Tạm tính </th>
                                        <td><span><?php echo number_format($data['totalPrice'], 0, ',', '.') . '₫' ?></span>
                                        </td>
                                    </tr>
                                    <tr style="font-weight: bold; font-size: 17px; border-top: 2px solid #ddd">
                                        <th>Tổng tiền thanh toán</th>
                                        <td><span><?php echo number_format($data['totalPrice'], 0, ',', '.') . '₫' ?></span>
                                        </td>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>

                    </div>

                </div>
                <div class="text-left">
                    <button type="submit" name="submit" class="btn d-inline-block ">Tiến hành thanh toán</button>
                </div>


            </div>

        </div>






    </form>


</div>

<?php
include_once("views/layouts/user_footer.php");
?>