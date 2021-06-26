<?php
include_once("views/layouts/user_header.php");
include_once('Pagination.php');
include_once('models/ProductModel.php');
function categoryParent($data)
{
    $html = "<ul class='list-clo'>";
    $maxCat = 9;
    $count = 0;
    foreach ($data as $val) {
        $id = $val['cat_id'];
        $name = $val['cat_name'];
        if ($val['parent_id'] == 0) {
            if ($count === $maxCat) break;
            $count++;
            $subHtml = subCategory($data, $id);
            $html .= "<li ";
            if ($subHtml) {
                $html .= "class = 'select-list'";
            }
            $html .= ">
            <a href='catalog/index/" . $id . "'>
                <div>" . mb_strtoupper($name, 'UTF-8') . "</div>
                </a>";

            if ($subHtml) {
                $html .= $subHtml;
            };
            $html .= "</li>";
        }
    }
    $html .= "</ul>";
    echo $html;
}
function subCategory($data, $parent_id)
{
    $subHtml = "<span class='icon-list'><i class='fas fa-chevron-right'></i></span>
    <ul id='dropdown-child' class='child child-hover child-dropdown'>";
    $flag = false;
    foreach ($data as $val) {
        $id = $val['cat_id'];
        $name = $val['cat_name'];
        if ($val['parent_id'] == $parent_id) {
            $flag = true;
            $subHtml .= "
            <li><a href='catalog/index/" . $id . "'>
                                <div class='a-fix a-fix1'>" . $name . "</div>
                            </a></li>
            ";
        }
    }
    $subHtml .= "</ul>";
    if ($flag) {
        return $subHtml;
    }
    return false;
}
?>
<script>
$(document).ready(function() {
    var nextPage = 1;
    var num = 12;
    if ($('#getNext').attr('total_product') <= nextPage * num) {
        $('#getNext').remove();
    }
    nextPage++;
    $('#getNext').click(function(e) {
        var totalProduct = $('#getNext').attr('total_product');
        var searchName = $('#getNext').attr('search-data');
        $('#getNext').hide();
        $('#loading_button').show();
        $.ajax({
            url: "shop/getProductSearch",
            type: "POST",
            data: {
                nextPage: nextPage,
                searchName: searchName

            },
            success: res => {

                setTimeout(() => {
                    $('#loading_button').hide();
                    $('#product-list').append(res);
                    if (nextPage * num >= totalProduct) {
                        $('#getNext').remove();
                    } else {
                        $('#getNext').show();
                    }
                    nextPage += 1;

                }, 1000);


            }
        })

    });

});
</script>
<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Tìm kiếm sản phẩm</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <span>Tìm kiếm sản phẩm</span>
                    </li>

                </ol>
            </nav>

        </div>

    </div>


</div>

<div class="container-lg container-fluid container-fixed mt-5 mb-5">
    <div class="main-show flex-lg-row flex-column">
        <div class="col-lg-3 col-12 clo-box">
            <div class="categories">
                <img
                    src="https://www.radiustheme.com/demo/wordpress/themes/metro/wp-content/themes/metro/assets/img/menubar.png">
                <span>DANH MỤC SẢN PHẨM</span>
            </div>
            <?php
            if (isset($data['category'])) {
                categoryParent($data['category']);
            }
            ?>

        </div>

        <div class="col-lg-9 col-12 intro-box">

            <div class="cart">
                <div class="row">
                    <div class="col-12 column-fixed">
                        <p style="margin: 21px 0">Từ khóa "<strong><?php echo $data['searchName'] ?></strong>" có
                            <?php echo $data['totalProduct'] ?> kết quả tìm kiếm phù
                            hợp</p>
                    </div>
                </div>
                <div class="row" id="product-list">
                    <?php foreach ($data['sanpham'] as $product) : ?>
                    <div class="col-xl-4 col-lg-4 col-sm-6 column-fixed">
                        <div class="product-container">
                            <div class="image-p">
                                <a href="product/view/<?php echo $product['product_code'] ?>">
                                    <img class="img-fluid" <?php if (isset($product['image_name'])) {
                                                                    echo "src='upload/images/products/${product['image_name']}'";
                                                                } else {
                                                                    echo "src='assets/images/no_image.jpg'";
                                                                }
                                                                ?>>
                                </a>
                            </div>
                            <h3>
                                <a
                                    href="product/view/<?php echo $product['product_code'] ?>"><?php echo $product['product_name'] ?></a>
                            </h3>

                            <p><?php echo number_format($product['price'], 0, ',', '.') . '₫' ?> <?php if ($product['price_old'] > 0) {
                                                                                                            echo "<del style='color: #959595; font-size: 14px'><span class='ml-1'>" . number_format($product['price_old'], 0, ',', '.') . "₫ </span></del>";
                                                                                                        }  ?> </p>
                            <div class="abs-fix">
                                <div class="cart-box">
                                    <button class="style-btn add_to_wishlist"
                                        data-product-id="<?php echo $product['product_code'] ?>">
                                        <i class="far fa-heart"></i>
                                    </button>

                                    <button class="style-btn" style="display: none;">
                                        <div class="spinner-border" role="status"
                                            style="width: 26px;  height: 26px; font-size: 10px; ">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </button>
                                    <?php
                                        if ($product['quantity'] > 0) {
                                            echo "<button class='atc button_between add_to_cart_product'
                                            data-product-id='" . $product['product_code'] . "'>
                                            THÊM VÀO GIỎ HÀNG
                                            </button>";
                                        } else {
                                            echo "<button class='atc button_between atc-empty'>
                                            HẾT HÀNG
                                            </button>";
                                        }
                                        ?>

                                    <button class="atc button_between" style=" display: none; margin: 0 5px;"
                                        id="loading_add_to_cart">
                                        <div class="spinner-border" role="status"
                                            style="width: 1rem; height: 1rem ;font-size: 11px;  ">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </button>



                                    <button class="style-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>




            </div>
            <div class="text-center mt-3 button-load">

                <div class="btn" style="background-color: #45526c; color: #fff" id="getNext"
                    search-data="<?php echo $data['searchName'] ?>" total_product="<?php echo $data['totalProduct'] ?>">
                    <span style="font-size:15px">Load More</span>
                </div>
                <div class="btn" style="background-color: #45526c; color: #fff ; display:none" id="loading_button">
                    <div class="spinner-border" role="status"
                        style="width: 1rem; height: 1rem ;font-size: 11px; margin: 0 5px">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

            </div>

        </div>

    </div>


</div>


<?php
include_once("views/layouts/user_footer.php");
?>