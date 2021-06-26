<?php
include_once('views/layouts/admin_header.php');
?>
<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="breadcrumb-wrapper">
            <h1>Danh sách tài khoản</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="admin">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        Tài khoản
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Danh sách tài khoản</li>
                </ol>
            </nav>
        </div>
        <!-- Recent Order Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-default" id="recent-orders">

                    <div class=" card-header justify-content-between ">
                        <h2>Danh sách tài khoản</h2>

                    </div>
                    <div class="add-button">
                        <a type="button" href="adminaccounts/add" class="btn btn-primary ml-auto">Thêm tài khoản</a>
                    </div>


                    <div class="card-body pt-0 pb-5 mt-3">
                        <table class=" table table-responsive table-responsive-large " style="width: 100%">
                            <thead style="font-size: 1.06rem">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tài khoản</th>

                                    <th class=" d-md-table-cell ">
                                        Avatar
                                    </th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.98rem">

                                <?php
                                $i = 1;
                                foreach ($data as $account) : ?>
                                <tr>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $i ?></td>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $account['username'] ?></td>
                                    <td class=" text-dark  d-md-table-cell ">
                                        <div class="avatar-center avatar-default">
                                            <img src="upload/images/admin/<?php echo $account['avatar_img'] ?>" alt=""
                                                class="image-cover avatar-default-image">
                                        </div>
                                    </td>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $account['name'] ?></td>
                                    <td class=" text-dark  d-md-table-cell "><?php echo $account['email'] ?></td>

                                    <td>

                                        <a type="button" data-id="<?php echo $account['admin_id'] ?>"
                                            class="btn btn-danger btn-sm rounded-0 button-action deleteRow"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete" aria-describedby="tooltip84720">
                                            <i class="mdi mdi-delete-outline"></i>

                                        </a>

                                    </td>
                                </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <nav aria-label="Page navigation " style="display:inline-block">
                                <?php
                                $page = new Pagination([
                                    'total' => AdminAccountsModel::totalRecords(),
                                    'limit' => 5,
                                    'full' => false,
                                    'querystring' => 'page',
                                    'path' => 'adminaccounts/index'
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

    $('.deleteRow').click(function(e) {

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
                                url: 'adminaccounts/delete/' + pid

                            })
                            .done(function(response) {

                                bootbox.alert(response);
                                parent.fadeOut('slow');
                                location.href =
                                    "http://localhost/gomsu_shop/adminaccounts";
                            })
                            .fail(function() {

                                bootbox.alert('Something Went Wrog ....');

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