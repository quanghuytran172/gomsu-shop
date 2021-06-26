<?php
include_once("views/layouts/user_header.php");
include_once("models/CartModel.php");
?>

<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Giỏ hàng</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>Giỏ hàng</span>
                    </li>
                </ol>
            </nav>

        </div>

    </div>


</div>
<div class="container-lg  container-fixed">
    <div class="row" id="alert-cart" style="display:none">
        <div class="col-md-12 mt-5 mb-5 text-center">
            <p>Bạn chưa mua sản phẩm nào !</p>

        </div>
    </div>
    <div class="row" id="cart-container">

        <div class="col-md-12 mt-5 mb-5">
            <div class="table-responsive-sm cart-table">
                <table class="table table-borderless" id="list-cart" total-items="<?php echo CartModel::countItems() ?>"
                    style="margin-bottom: 0">
                    <thead>
                        <tr style="background-color: #f8f8f8">
                            <th scope="col" width="100px">&nbsp;</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (!empty($data['products'])) {
                            foreach ($data['products'] as $product) : ?>

                        <tr style=" font-size: 17px">

                            <td width="100px">
                                <a type="button" class="remove-item" id="remove_item_cart"
                                    data-product_id="<?php echo $product['product_code'] ?>">×</a>
                            </td>
                            <td class="d-lg-block d-md-flex flex-column align-items-center">
                                <a href="product/view/<?php echo $product['product_code'] ?>">
                                    <img width="100px" height="70px"
                                        src="upload/images/products/<?php echo $product['file_name'] ?>" alt="">
                                </a>
                                <a class="ml-3" href="product/view/<?php echo $product['product_code'] ?>">
                                    <h5 style="display: inline-block"><?php echo $product['product_name'] ?></h5>
                                </a>

                            </td>



                            <td><?php echo number_format($product['price'], 0, ',', '.') . '₫' ?></td>
                            <td><input class="js-number-value js-only-number" type="number"
                                    onchange="updateCart('<?php echo $product['product_code'] ?>')"
                                    id="<?php echo $product['product_code'] ?>"
                                    value="<?php echo $productsInCart[$product['product_code']] ?>">
                            </td>
                            <td><?php echo number_format($product['price'] * $productsInCart[$product['product_code']], 0, ',', '.') . '₫' ?>
                            </td>
                        </tr>
                        <?php endforeach;
                        } ?>
                    </tbody>

                </table>
                <div class="text-right">
                    <a href="" type="button" class="btn d-inline-block button-back " style="color: #fff">Tiếp tục
                        mua
                        hàng</a>

                </div>



            </div>



        </div>
        <div class="table-responsive-sm col-md-6 mb-5 text-left ml-auto">
            <div class="cart_totals ">
                <?php
                if (!isset($data['totalPrice'])) {
                    $data['totalPrice'] = 0;
                }


                ?>

                <h2 class="mb-4">Tổng thành tiền</h2>

                <table cellspacing="0" class="table table-borderless" style="margin-bottom: 0" id="checkout_check">

                    <tbody>
                        <tr class="cart-subtotal" style="border-bottom: 1px solid #dfdfdf">
                            <th>Tạm tính</th>
                            <td> <?php echo number_format($data['totalPrice'], 0, ',', '.') . '₫' ?>
                            </td>
                        </tr>

                        <tr class="order-total">
                            <th>Thành tiền</th>
                            <td>
                                <h5>
                                    <?php echo number_format($data['totalPrice'], 0, ',', '.') . '₫' ?>
                                </h5>
                            </td>
                        </tr>


                    </tbody>
                </table>



                <a type="button" href="cart/checkout" class="btn d-block">
                    THANH TOÁN NGAY</a>

            </div>

        </div>
    </div>

</div>
<script>
if ($("#list-cart").attr("total-items") <= 0) {
    $('#alert-cart').show();
    $('#cart-container').html('');
}
</script>
<?php
include_once("views/layouts/user_footer.php");
?>