<?php
include_once('views/layouts/admin_header.php');
?>
<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="breadcrumb-wrapper">
            <h1>Danh sách danh mục sản phẩm</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="admin">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        Danh mục sản phẩm
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Danh sách danh mục sản phẩm</li>
                </ol>
            </nav>
        </div>
        <!-- Recent Order Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-table-border-none" id="recent-orders">

                    <div class=" card-header justify-content-between ">
                        <h2>Danh sách danh mục sản phẩm</h2>

                    </div>
                    <div class="row mt-2">
                        <div class="col-8 ">
                            <div style="margin-left: 50px">
                                <a type="button" href="admincategory/add" class="btn btn-primary ml-auto">Thêm danh
                                    mục</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="margin-right: 50px">
                                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            </div>

                        </div>
                    </div>



                    <div class="card-body pt-0 pb-5">
                        <table class=" table card-table table-responsive table-responsive-large " style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Mã Danh Mục</th>
                                    <th>Tên Danh Mục</th>

                                    <th class=" d-md-table-cell ">
                                        Danh Mục Cha
                                    </th>

                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($data as $category) : ?>

                                <tr>

                                    <td><?php echo $category['cat_id'] ?></td>
                                    <td class=" text-dark  d-md-table-cell ">
                                        <?php echo $category['cat_name'] ?>
                                    </td>
                                    <td class=" d-md-table-cell ">
                                        <?php
                                            if ($category['parent_id'] == 0) {
                                                echo "None";
                                            } else {
                                                echo $category['parent_name'];
                                            }
                                            ?>
                                    </td>


                                    <td>

                                        <a type="button" href="admincategory/update/<?php echo $category['cat_id'] ?>"
                                            class="btn btn-success btn-sm rounded-0 button-action button-first"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Edit">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <a type="button" data-id="<?php echo $category['cat_id'] ?>"
                                            class="btn btn-danger btn-sm rounded-0 button-action deleteRow"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete" aria-describedby="tooltip84720">
                                            <i class="mdi mdi-delete-outline"></i>

                                        </a>


                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>


                        </table>
                        <div class="text-right">
                            <nav aria-label="Page navigation " style="display:inline-block">
                                <?php
                                $page = new Pagination([
                                    'total' => AdminCategoryModel::totalRecords(),
                                    'limit' => 5,
                                    'full' => false,
                                    'querystring' => 'page',
                                    'path' => 'admincategory/index'
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
            url: "admincategory/search",
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
        var parent = $(this).parent('td').parent('tr');
        bootbox.dialog({
            message: 'Bạn có chắc chắn muốn xóa không ?',
            title: ' Xóa',
            buttons: {
                success: {
                    label: 'Hủy',
                    className: 'btn-success',
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: 'Xóa',
                    className: 'btn-danger',
                    callback: function() {


                        $.ajax({

                                type: 'POST',
                                url: 'admincategory/delete/' +
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


    });
});
</script>
<?php
include_once('views/layouts/admin_footer.php');
?>