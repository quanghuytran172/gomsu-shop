<?php
include_once('views/layouts/admin_header.php');
?>

<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Thêm tài khoản</h2>

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


                        <div class="form-group">
                            <label for="quantityproduct">Tên tài khoản</label>
                            <input type="text" class="form-control" name='username' placeholder="Nhập tên tài khoản">
                        </div>

                        <div class="form-group">
                            <label for="quantityproduct">Mật khẩu</label>
                            <input type="password" class="form-control" name='password' placeholder="Nhập mật khẩu">

                        </div>

                        <div class="form-group">
                            <label for="quantityproduct">Tên người dùng</label>
                            <input type="text" class="form-control" name='name' placeholder="Nhập tên người dùng">
                        </div>
                        <div class="form-group">
                            <label for="quantityproduct">Email</label>
                            <input type="email" class="form-control" name='email' placeholder="Nhập địa chỉ email">
                        </div>
                        <div class="form-group">
                            <label for="quantityproduct">Ảnh đại diện</label>
                            <input type="file" class="form-control" name='avatar_img'>
                        </div>


                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <button type="submit" name="submit" class="btn btn-primary btn-default">Thêm</button>
                            <a type="button" href="adminaccounts"
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