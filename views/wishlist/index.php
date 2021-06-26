<?php
include_once("views/layouts/user_header.php");
include_once("models/WishListModel.php");
?>

<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Sản phẩm yêu thích</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>Sản phẩm yêu thích</span>
                    </li>
                </ol>
            </nav>

        </div>

    </div>


</div>
<div class="container-lg  container-fixed">
    <div class="row" id="alert-wishlist" style="display:none">
        <div class="col-md-12 mt-5 mb-5 text-center">
            <p>Bạn chưa có sản phẩm yêu thích nào !</p>

        </div>
    </div>
    <div class="row" id="wishlist-container">
        <div class="col-md-12 mt-5 mb-5">
            <div class="table-responsive-sm cart-table">
                <table class="table table-borderless" id="wishlist"
                    total-items="<?php echo WishListModel::countItems() ?>" style="margin-bottom: 0">
                    <thead>
                        <tr style="background-color: #f8f8f8">
                            <th scope="col" width="100px">&nbsp;</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if (!empty($data['products'])) {
                            foreach ($data['products'] as $product) :  ?>

                        <tr style=" font-size: 17px">

                            <td width="100px">
                                <a type="button" class="remove-item" id="remove_item_wishlist"
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



                            <td><del class="price product-price-old mr-2" style="color: #9c9c9c">
                                    <?php echo number_format($product['price_old'], 0, ',', '.') . '₫' ?>
                                </del><?php echo number_format($product['price'], 0, ',', '.') . '₫' ?></td>
                            <td>
                                <?php
                                        if ($product['quantity'] > 0) {
                                            echo '<span class="text-success">Còn hàng</span>';
                                        } else {
                                            echo '<span class="text-danger">Hết hàng</span>';
                                        }
                                        ?>
                            </td>
                        </tr>
                        <?php endforeach;
                        } ?>
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<script>
if ($("#wishlist").attr("total-items") <= 0) {
    $('#alert-wishlist').show();
    $('#wishlist-container').html('');
}
</script>
<?php
include_once("views/layouts/user_footer.php");
?>