<?php
include_once("views/layouts/user_header.php");
?>
<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Chi tiết sản phẩm</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href='shop'><span>Sản phẩm</span></a>

                    </li>
                    <li class='breadcrumb-item active' aria-current='page'>
                        <?php echo $product_name ?>
                    </li>
                </ol>
            </nav>

        </div>

    </div>

</div>

<div class="container-lg container-fluid container-fixed mt-5 mb-5">
    <style>
    .preview-images img:hover {
        border: 2px solid #000;
        cursor: pointer;
        transition: all 0.5s;
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        overflow: hidden
    }

    .main_image img {
        width: 100%;
        height: 100%;
        object-fit: cover;

    }

    .main_image .product-main {
        height: 300px;
        object-fit: cover;
    }

    .preview-images {
        width: 100%;
        text-align: left;
        margin-top: 10px;
        white-space: nowrap;
    }

    .preview-images img {
        border: 2px solid #eee;
        height: 80px;
        max-width: 100px;
    }

    .preview-images li {
        display: inline-block;
        list-style-type: none;
        margin: 0 2px;
    }

    .preview-images li:first-child {
        margin: 0;
    }

    .preview-images li:last-child {
        margin: 0;
    }

    .product-meta-seperator {
        display: inline-block;
        color: #333;
        margin: 0 5px;
    }

    .product-meta-seperator:after {
        content: '.';
    }

    .product-social-items a {
        color: #646464;
        margin: 0 5px;
    }

    .product-social-items a:hover {
        color: #111
    }

    .box-product {
        color: #646464;
    }

    .box-product h2 {
        color: #010101;
    }

    .price-box .special-price {
        color: #111;
        font-weight: 500;
        font-size: 24px;
    }

    .price-box .old-price {
        font-size: 18px;
        color: #646464;
        font-weight: 500;
    }

    .box-product .status_name {
        color: #111;
        font-weight: 500;
    }

    .button-buy {
        color: #fff;
        background-color: #111;
        padding: 12px 25px;

    }

    .button-empty {
        cursor: auto !important;
    }

    .button-wishlist {
        color: #111;
        border: 1px solid #dcdcdc;
        padding: 12px 17px;

    }

    .button-buy:hover {
        color: #fff;
        opacity: 0.8;
        transition: 0.5s all;
    }

    .button-wishlist:hover {
        color: #fff;
        background-color: #111;
        opacity: 0.8;
        transition: 0.5s all;
    }

    .button-group button:focus {
        box-shadow: none;

    }

    .description-tab {
        font-size: 24px;
        font-weight: 500;
    }

    .description-tab span {
        padding-bottom: 10px;
        border-bottom: 3px solid #111;
    }
    </style>
    <div class="row">
        <div class="col-md-5 ">
            <div class="d-flex flex-column justify-content-center">
                <div class="main_image d-flex flex-column">
                    <img class="product-main img-fluid" <?php
                                                        if (!empty($images)) {

                                                            echo "src='upload/images/products/" . $images[0]['file_name'] . "'";
                                                        } else {
                                                            echo "src='assets/images/no_image.jpg' style='object-fit: contain'";
                                                        }
                                                        ?> id="main_product_image">

                    <ol class=" p-0 preview-images">
                        <?php
                        if (!empty($images)) {
                            foreach ($images as $element) {
                                echo "<li><img onclick='changeImage(this)'
                                src='upload/images/products/" . $element['file_name'] . "' alt=''>
                        </li>";
                            }
                        }
                        ?>

                    </ol>
                </div>

            </div>
        </div>

        <div class="col-md-7 box-product">

            <h2><?php echo $product_name ?>
            </h2>
            <div class="price-box mt-4 mb-4">
                <span class="special-price"><span class="price product-price product-detail-price">
                        <?php echo number_format($price, 0, ',', '.') . '₫' ?>
                    </span>

                </span> <!-- Giá Khuyến mại -->
                <span class="old-price">
                    <del class="price product-price-old">
                        <?php echo number_format($price_old, 0, ',', '.') . '₫' ?>
                    </del>

                </span> <!-- Giá gốc -->
            </div>
            <div class="group-status">
                <span class="first_status">Mã sản phẩm: <span
                        class="status_name"><?php echo $product_code ?></span></span>
                <div class="product-meta-seperator"></div>
                <span class="first_status">Tình trạng: <span class="status_name availabel">
                        <?php
                        if ($quantity > 0) {
                            echo 'Còn hàng';
                        } else {
                            echo 'Hết hàng';
                        }

                        ?>
                    </span></span>
            </div>
            <div class="group-information mt-2 mb-2">
                <span class="first_status">Danh mục sản phẩm: <span
                        class="status_name"><?php echo $cat_name ?></span></span>
                <div class="product-meta-seperator"></div>
                <span class="first_status">Tags: <span class="status_name availabel">
                        <?php echo $tag_name ?>
                    </span></span>
            </div>
            <div class="product-social d-flex">
                <span class="product-social-title">Chia sẻ:</span>
                <ul class="product-social-items p-0 d-flex ml-2">
                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-linkedin"><a href="#"> <i class="fa fa-linkedin"></i></a></li>
                    <li class="social-pinterest"><a href="#"> <i class="fa fa-pinterest"></i></a></li>
                    <li class="social-reddit"><a href="#"><i class="fa fa-reddit"></i></a></li>
                </ul>
            </div>
            <div class="mt-3 button-group">


                <?php
                if ($quantity > 0) {
                    echo "<a type='button' href='cart/add/" . $product_code . "' class='btn button-buy'
                                            >
                                            MUA HÀNG
                                            </a>";
                } else {
                    echo "<button class='btn button-buy button-empty'>
                                            HẾT HÀNG
                                            </button>";
                }
                ?>
                <a type='button' href='wishlist/add/<?php echo $product_code ?>' class="btn button-wishlist">
                    <i class="wishlist-icon fa fa-heart-o"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="description-tab">
                <span>Mô tả sản phẩm</span>
            </div>
            <div class="des-data mt-5">
                <?php echo $description ?>
            </div>
        </div>
    </div>



</div>
<script>
function changeImage(element) {
    var main_prodcut_image = document.getElementById('main_product_image');
    main_prodcut_image.src = element.src;

}
</script>
<?php
include_once("views/layouts/user_footer.php");
?>