<?php
include_once('views/layouts/admin_header.php');
?>
<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="breadcrumb-wrapper">
            <h1>Danh sách sản phẩm</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="admin">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        Sản phẩm
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Danh sách sản phẩm</li>
                </ol>
            </nav>
        </div>
        <!-- Recent Order Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-default" id="recent-orders">

                    <div class=" card-header justify-content-between ">
                        <h2>Danh sách sản phẩm</h2>

                    </div>

                    <div class="row mt-2">
                        <div class="col-8">
                            <div style="margin-left: 50px">
                                <a type="button" href="adminproduct/add" class="btn btn-primary ml-auto">Thêm sản
                                    phẩm</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="margin-right: 50px">
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            </div>

                        </div>
                    </div>

                    <div class="card-body pt-0 pb-5 mt-3">
                        <table class=" table table-responsive table-responsive-large overflow-auto "
                            style="width: 100%">
                            <thead style="font-size: 1.06rem">
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>

                                    <th class=" d-md-table-cell ">
                                        Ảnh sản phẩm
                                    </th>

                                    <th>Danh mục sản phẩm</th>
                                    <th>Giá đã sale</th>
                                    <th>Giá chưa sale</th>
                                    <th>Tag name</th>
                                    <th style="width:110px">Hành động</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.98rem">

                                <?php

                                foreach ($data as $product) : ?>

                                <tr>

                                    <td class=" text-dark  d-md-table-cell "><?php echo $product['product_code'] ?></td>
                                    <td class=" text-dark  d-md-table-cell ">
                                        <?php echo $product['product_name'] ?>
                                    </td>

                                    <td>
                                        <?php
                                            if (isset($product['image_name'])) {
                                                echo
                                                "<img width= '100' src='upload/images/products/" . $product['image_name'] . "' alt='image'></img>";
                                            } else {
                                                echo
                                                "<img width= '100' src='assets/images/no_image.jpg' alt='image'></img>";
                                            }

                                            ?>
                                    </td>

                                    <td class=" text-dark  d-md-table-cell ">
                                        <?php
                                            echo $product['cat_name'];
                                            ?>
                                    </td>

                                    <td class=" text-dark  d-md-table-cell "><?php echo $product['price'] ?></td>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $product['price_old'] ?></td>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $product['tag_name'] ?></td>


                                    <td class=" text-dark  d-md-table-cell ">

                                        <a type="button"
                                            href="adminproduct/update/<?php echo $product['product_code'] ?>"
                                            class="btn btn-success btn-sm rounded-0 button-action button-first"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Edit">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>

                                        <a type="button" data-id="<?php echo $product['product_code'] ?>"
                                            class="btn btn-danger btn-sm rounded-0 button-action deleteRow"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete" aria-describedby="tooltip84720">
                                            <i class="mdi mdi-delete-outline"></i>

                                        </a>


                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <script>

                                </script>
                            </tbody>

                        </table>

                        <div class="text-right">
                            <nav aria-label="Page navigation " style="display:inline-block">
                                <?php
                                $page = new Pagination([
                                    'total' => AdminProductModel::totalRecords(),
                                    'limit' => 5,
                                    'full' => false,
                                    'querystring' => 'page',
                                    'path' => 'adminproduct/index'
                                ]);
                                echo $page->getPagination();
                                ?>
                            </nav>
                        </div>


                    </div>

                </div>
                <script>
                $(document).ready(function() {
                    //Search Product Ajax

                    function loadData(query) {
                        $.ajax({
                            url: "adminproduct/search",
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
                    // Delete Row Ajax
                    $('body').on("click", ".deleteRow", function(e) {

                        e.preventDefault();
                        var pid = $(this).attr('data-id');
                        var parent = $(this).parent("td").parent("tr");
                        bootbox.dialog({
                            message: "Bạn có chắc chắn muốn xóa không ?",
                            title: " Xóa",
                            buttons: {
                                success: {
                                    label: "Hủy",
                                    className: "btn-success",
                                    callback: function() {
                                        $('.bootbox').modal('hide');
                                    }
                                },
                                danger: {
                                    label: "Xóa",
                                    className: "btn-danger",
                                    callback: function() {


                                        $.ajax({

                                                type: 'POST',
                                                url: 'adminproduct/delete/' +
                                                    pid

                                            })
                                            .done(function(response) {

                                                bootbox.alert(response);
                                                parent.fadeOut('slow');

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


                    })


                });
                </script>
            </div>
        </div>
    </div>
</div>

<?php
include_once('views/layouts/admin_footer.php');
?>