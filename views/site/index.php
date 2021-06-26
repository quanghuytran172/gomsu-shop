<?php
include_once("views/layouts/user_header.php");

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


<div class="container-lg container-fluid container-fixed">
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
            <form action="shop/search" method="POST">
                <div class="cover">
                    <div class="searching">
                        <input type="text" id="search_name_product" name="searchName" placeholder="Tìm kiếm sản phẩm">
                    </div>
                    <div class="icon-search">
                        <button type="submit" name="submit" id="search_product">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>


            <div class="main-intro m1" style="opacity: 1">
                <div class="box-content">
                    <div class="this">
                        <h3>Lọ hoa <span>Sale</span></h3>
                        <p class="discribe">
                            Các sản phẩm mới trong bộ sưu tập lọ hoa gốm sứ đẹp
                        </p>
                        <p class="explore"><a class="explore" href="catalog/index/55">XEM NGAY</a></p>
                        <div class="number">
                            <a type="button"><span class="text-button1 fix-number">01</span>
                                <a type="button">
                                    <span>
                                        /
                                    </span>
                                    <span class="text-button2">
                                        02
                                    </span>

                                </a>
                                <a type="button">
                                    <span>
                                        /
                                    </span>
                                    <span class="text-button3">
                                        03
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>

                <div class="d-none d-md-block image-main"
                    style="background: url('assets/images/anh_gomsu.jpg') ; background-size: cover; background-repeat: no-repeat;">

                </div>
            </div>
            <div class="main-intro m2" style="display: none">
                <div class="box-content">
                    <div class="this">
                        <h3>Lọ hoa <span>Sale</span></h3>
                        <p class="discribe">
                            Các sản phẩm mới trong bộ sưu tập lọ hoa gốm sứ đẹp
                        </p>
                        <p class="explore"><a class="explore" href="catalog/index/55">XEM NGAY</a></p>
                        <div class="number">
                            <a type="button"><span class="text-button1">01</span>
                                <a type="button">
                                    <span>
                                        /
                                    </span>
                                    <span class="text-button2 fix-number">
                                        02
                                    </span>

                                </a>
                                <a type="button">
                                    <span>
                                        /
                                    </span>
                                    <span class="text-button3">
                                        03
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>

                <div class="d-none d-md-block image-main"
                    style="background: url('assets/images/anh_gomsu2.jpg') ; background-size: cover; background-repeat: no-repeat; background-position-y: -40px">

                </div>
            </div>

            <div class="main-intro m3" style="display: none">
                <div class="box-content">
                    <div class="this">
                        <h3>Lọ hoa <span>Sale</span></h3>
                        <p class="discribe">
                            Các sản phẩm mới trong bộ sưu tập lọ hoa gốm sứ đẹp
                        </p>
                        <p class="explore"><a class="explore" href="catalog/index/55">XEM NGAY</a></p>
                        <div class="number">
                            <a type="button"><span class="text-button1">01</span>
                                <a type="button">
                                    <span>
                                        /
                                    </span>
                                    <span class="text-button2">
                                        02
                                    </span>

                                </a>
                                <a type="button">
                                    <span>
                                        /
                                    </span>
                                    <span class="text-button3 fix-number">
                                        03
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>

                <div class="d-none d-md-block image-main"
                    style="background: url('assets/images/anh_gomsu3.jpg') ; background-size: cover; background-repeat: no-repeat;background-position: center ">

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="container-box-image flex-lg-row ">
            <a class="col-xl-6 mb-lg-0 mb-sm-4" href="catalog/index/54">
                <div>
                    <img class="img-fluid women" src="assets/images/bodotho.jpg">
                </div>
                <div class="trending">
                    <div class="content-box">
                        <h3>BỘ ĐỒ THỜ</h3>
                        <h5>2021</h5>
                    </div>
                </div>
            </a>
            <a class="col-xl-6" href="catalog/index/82">
                <div>
                    <img class="img-fluid men" src="assets/images/amchen.jpg">
                </div>
                <div class="trending">
                    <div class="content-box">
                        <h3>ẤM CHÉN</h3>
                        <h5>2021</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <section class="sale-products">
        <div class="content-product">
            <h3>Dòng Sản Phẩm Nổi Bật</h3>
            <nav>
                <div class="nav choose-show " id="nav-tab" role="tablist">
                    <a class="active" data-toggle="tab" href="#dotho" role="tab" aria-selected="true">Bộ đồ thờ cúng</a>
                    <a data-toggle="tab" href="#lohoa" role="tab" aria-selected="false">Lọ hoa
                        đẹp</a>
                    <a data-toggle="tab" href="#amchen" role="tab" aria-selected="false">Ấm chén đẹp</a>
                    <a data-toggle="tab" href="#tranhgom" role="tab" aria-selected="false">Tranh gốm</a>
                </div>
            </nav>

        </div>
        <div class="cart tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="dotho" role="tabpanel">
                <div class="row">

                    <?php foreach ($data['dothocung'] as $product) : ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 column-fixed">
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


                    <div class="col-12 column-fixed">
                        <div class="view-product">
                            <a href="catalog/index/54">
                                XEM TOÀN BỘ SẢN PHẨM
                            </a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row tab-pane fade" id="lohoa" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row">
                    <?php foreach ($data['loahoadep'] as $product) : ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 column-fixed">
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
                <div class="col-12 column-fixed">
                    <div class="view-product">
                        <a href="catalog/index/55">
                            XEM TOÀN BỘ SẢN PHẨM
                        </a>
                    </div>
                </div>

            </div>

            <div class="row tab-pane fade" id="amchen" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row">
                    <?php foreach ($data['amchendep'] as $product) : ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 column-fixed">
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
                <div class="col-12 column-fixed">
                    <div class="view-product">
                        <a href="catalog/index/82">
                            XEM TOÀN BỘ SẢN PHẨM
                        </a>
                    </div>
                </div>

            </div>

            <div class="row tab-pane fade" id="tranhgom" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row">
                    <?php foreach ($data['tranhgom'] as $product) : ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 column-fixed">
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
                <div class="col-12 column-fixed">
                    <div class="view-product">
                        <a href="catalog/index/86">
                            XEM TOÀN BỘ SẢN PHẨM
                        </a>
                    </div>
                </div>

            </div>

        </div>
</div>


</section>
</div>




<div class="container-fluid site-sale">
    <div class="container-lg container-fluid container-fixed">
        <div class="div-s">
            <div class="content-sale">
                <h2>Giảm giá cuối năm 2021 <br>Sale upto 30%</h2>
                <p>Hàng có hạn, đặt hàng ngay trước khi<br>hết.</p>
                <a href="shop">
                    XEM NGAY
                </a>
            </div>
        </div>

    </div>


</div>
<div class="container-lg container-fluid">
    <section class="row product-display">
        <div class="col-lg-6 mb-5 mb-lg-0 image-s">
            <div class="sweater">
                <div class="content-s">
                    <h3>Lọ Hoa Cao Cấp</h3>
                    <p>Trang trí cho phòng của bạn</p>
                    <a href="#">MUA NGAY</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 image-s">
            <div class="shoes">
                <div class="content-sh">
                    <h3>Bộ Ấm Chén Victoria </h3>
                    <p>Bộ ấm chén nghệ thuật</p>
                    <a href="#">MUA NGAY</a>
                </div>
            </div>
        </div>
    </section>
</div>


<section class="container-lg container-fluid news-post">
    <h3 class="title-p">Các Bài Viết Nổi Bật</h3>
    <div class="flex-pb">
        <div class="row">
            <div class="col-md-4 post-box">
                <div class="pb-image">
                    <a href="#">
                        <img class="img-fluid"
                            src="https://phanphoigomsu.com/img.php?pic=OGYyYmM0Yjc5Y2ZiNjhhNTMxZWEuanBn&w=480&h=320&encode=1">
                        <div class="overlay c1">
                            <div>29</div>
                            <div class="font-weight-bold">Mar</div>
                        </div>
                    </a>
                </div>


                <div>
                    <p><a class="a-fix" href="#">Tranh sứ</a>, <a class="a-fix" href="#">Trang trí</a></p>
                    <h3><a class="ac-fix" href="#">Tổng Hợp Những Mẫu Tranh Sứ Mosaic Được Làm Nhiều Nhất Hiện Nay</a>
                    </h3>
                </div>


            </div>

            <div class="col-md-4  mt-4 mb-4 mt-md-0 mb-md-0 post-box">
                <div class="pb-image">
                    <a href="#">
                        <img class="img-fluid"
                            src="https://phanphoigomsu.com/img.php?pic=ODIzNzM5MzNfMjg2MjY4ODU1MDQ1MDI5N181MjQwMjEzMjExODU2MjQwNjQwX24uanBn&w=480&h=320&encode=1">
                        <div class="overlay c2">
                            <div>28</div>
                            <div class="font-weight-bold">Mar</div>
                        </div>
                    </a>
                </div>


                <div>
                    <p><a class="a-fix" href="#">Tips</a>, <a class="a-fix" href="#">Hướng dẫn</a></p>
                    <h3><a class="ac-fix" href="#">Hướng Dẫn Cách Lau Dọn Ban Thờ Và Tỉa Chân Nhang Dịp Cuối Năm</a>
                    </h3>
                </div>

            </div>

            <div class="col-md-4 post-box">
                <div class="pb-image">
                    <a href="#">
                        <img class="img-fluid"
                            src="https://phanphoigomsu.com/img.php?pic=Mzk1NTc2NDlfMTc3OTU2MDc0ODgzMTE4Nl84NjY4NDkwNDg4NzM2NjQ1MTIwX24uanBn&w=480&h=320&encode=1">
                    </a>
                    <div class="overlay c3">
                        <div>27</div>
                        <div class="font-weight-bold">Mar</div>
                    </div>
                </div>


                <div>
                    <p><a class="a-fix" href="#">Tips</a>, <a class="a-fix" href="#">Hướng dẫn</a></p>
                    <h3><a class="ac-fix" href="#">Hướng Dẫn Cách Bài Trí Ban Thờ Gia Tiên Chuẩn Phong Thủy Mang May Mắn
                            Tài Lộc Cho Gia Chủ Vào Năm Mới</a>
                    </h3>
                </div>


            </div>
        </div>

    </div>
</section>

<div class="container-lg container-fluid " style="margin-top: 100px">
    <section class="gift flex-md-row flex-column text-center">
        <h3>NHẬP EMAIL ĐỂ NHẬN ĐƯỢC MÃ ƯU ĐÃI KHI MUA HÀNG</h3>
        <input class="mt-md-0 mt-4 mb-md-0 mb-4 mt-md" type="email" placeholder="Địa chỉ email của bạn">
        <button>Xác nhận</button>
    </section>
</div>

<?php
include_once("views/layouts/user_footer.php");
?>