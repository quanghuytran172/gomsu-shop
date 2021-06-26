<?php
include_once("views/layouts/user_header.php");
?>

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

    <div class="row">
        <div class="col-12">

        </div>
        <div class="col-12 text-center">
            <h4>Thanh toán thành công</h4>
            <p class="mt-4">Mã hóa đơn của bạn là "<strong><?php echo $order_id ?></strong>"</p>
            <p>Ghi nhớ mã hóa đơn để <a href="checkOrder">xem trạng thái đơn hàng</a> </p>
        </div>


    </div>
</div>










<?php
include_once("views/layouts/user_footer.php");
?>