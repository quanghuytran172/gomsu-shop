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
                    <h2>Thêm sản phẩm</h2>

                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="productcode">Mã sản phẩm</label>
                                <input type="text" class="form-control" name='product_code' id="productcode"
                                    placeholder="Nhập mã sản phẩm">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="productname">Tên sản phẩm</label>
                                <input type="text" class="form-control" name='product_name' id="productname"
                                    placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="description">Mô tả sản phẩm </label>

                            <textarea name="description" id="editor" cols="10" rows="100" class=" form-control"
                                id="description"></textarea>




                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="priceproduct">Giá sản phẩm đã sale</label>
                                <input type="text" class="form-control" name='price' id="priceproduct"
                                    placeholder="Nhập giá sản phẩm đã sale">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="priceoldproduct">Giá sản phẩm chưa sale </label>
                                <input type="text" class="form-control" name='price_old' id="priceoldproduct"
                                    placeholder="Nhập giá sản phẩm chưa sale">
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="form-check-label mr-2" for="defaultCheck1">
                                Sản phẩm nổi bật
                            </label>
                            <input name="featured_product" type="checkbox" value="" id="defaultCheck1">


                        </div>
                        <div class="form-group">
                            <label for="quantityproduct">Số lượng</label>
                            <input type="text" class="form-control" name='quantity' id="quantityproduct"
                                placeholder="Nhập số lượng sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="cParent">Danh mục sản phẩm</label>
                            <select class="form-control" id="cParent" name="cat_id">

                                <?php
                                cate_parent($data['parent_id']); ?>
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="tagname">Tag name </label>
                            <input type="text" class="form-control" name='tag_name' id="tagname"
                                placeholder="Nhập tag name sản phẩm">
                        </div>


                        <fieldset class="form-group">
                            <label for="tagname">Ảnh sản phẩm </label>





                        </fieldset>
                        <div class="preview-images-zone">


                        </div>

                        <div class="file file--upload mt-3">
                            <a href="javascript:void(0)" onclick="$('#pro-image').click()"> <i
                                    class="mdi mdi-cloud-upload"></i> Upload
                                Image</a>
                            <input type="file" id="pro-image" name="upload[]" style="display: none;"
                                class="form-control" multiple>
                        </div>



                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <button type="submit" name="submit" class="btn btn-primary btn-default">Thêm</button>
                            <a type="button" href="adminproduct"
                                class="btn btn-secondary btn-default text-white">Hủy</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });

$(document).ready(function() {
    document.getElementById('pro-image').addEventListener('change', readImage, false);


    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-" + no).remove();
    });
});



var num = 4;

function readImage() {
    $('.preview-images-zone').html('');
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;

            var picReader = new FileReader();

            picReader.addEventListener('load', function(event) {
                var picFile = event.target;
                var html = '<div class="preview-image preview-show-' + num + '">' +
                    '<div class="image-cancel" data-no="' + num + '">x</div>' +
                    '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result +
                    '"></div>';

                output.append(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }
        // $("#pro-image").val('');
    } else {
        console.log('Browser not support');
    }
}
</script>


<?php
include_once('views/layouts/admin_footer.php');
?>