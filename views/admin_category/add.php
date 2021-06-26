<?php
include_once('views/layouts/admin_header.php');
?>
<?php
function cate_parent($data, $parent = 0, $str = '--', $select = 0)
{
    foreach ($data as $val) {
        $id = $val['cat_id'];
        $name = $val['cat_name'];
        if ($val['parent_id'] == $parent) {
            if ($select != 0 && $id == $select) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            cate_parent($data, $id, $str . "--");
        }
    }
}

?>
<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Thêm danh mục sản phẩm</h2>

                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <?php

                        if (isset($error)) {
                            $error = $data['error'];
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                             ${error}
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                            </button>
                          </div> ";
                        }

                        ?>
                        <div class="form-group">
                            <label for="cParent">Danh mục cha</label>
                            <select class="form-control" id="cParent" name="parent_id">
                                <option value="0">Hãy chọn danh mục</option>

                                <?php

                                cate_parent($data['parent_id']); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tên danh mục *</label>
                            <input type="text" class="form-control" name='cat_name' id="exampleFormControlInput1"
                                placeholder="Nhập danh mục">
                        </div>

                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <button type="submit" name="submit" class="btn btn-primary btn-default">Thêm</button>
                            <a type="button" href="admincategory"
                                class="btn btn-secondary btn-default text-white">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once('views/layouts/admin_footer.php');
?>