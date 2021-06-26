<?php
include_once("views/layouts/user_header.php");
?>
<div class="container-fluid banner">
    <div class="container">

        <div class="banner-content">
            <h1>Liên hệ</h1>
            <nav aria-label="breadcrumb " class="breadcrumb-fix mt-3">
                <ol class="breadcrumb breadcrumb-wrapped ">
                    <li class="breadcrumb-item ">
                        <a href=""><span>Trang chủ</span></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>Liên hệ</span>
                    </li>
                </ol>
            </nav>

        </div>

    </div>


</div>
<div class="container-lg  container-fixed">

    <div class="col-12">
        <h5 class="mt-5 mb-4">Bản đồ chỉ đường</h5>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3779899050974!2d105.80942985082778!3d21.01755649346724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab64031d4f5b%3A0x2d9c65c4e4c14420!2zNDUgTmd1ecOqbiBI4buTbmcsIEzDoW5nIEjhuqEsIMSQ4buRbmcgxJBhLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1622116255374!5m2!1sen!2s"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <div class="col-12 mt-5" style="margin-bottom: 6rem">
        <div class="row">
            <div class="col-4">
                <h4> Địa chỉ liên hệ</h4>
                <ul class="contact s-none pt-2" style="padding: 0; margin: 0">
                    <li class="d-flex ">
                        <span class="mr-3 icon-contact">
                            <i class="fas fa-map-marker-alt  "></i>
                        </span>

                        <span>
                            Số 10, Ngõ 45, Nguyên Hồng, Hà Nội</span>
                    </li>
                    <li class="contact-box d-flex mt-3 mb-3">
                        <span class="mr-3 icon-contact">
                            <i class="fas fa-phone-volume "></i>
                        </span>
                        0976724222
                    </li>
                    <li class="contact-box d-flex ">
                        <span class="mr-3 icon-contact">
                            <i class="far fa-envelope "></i>
                        </span>
                        info@battrang.info
                    </li>
                </ul>
            </div>

            <div class="col-8">
                <h4>Gửi tin nhắn cho chúng tôi</h4>
                <form>
                    <div class="form-group">
                        <label for="fullname">Họ và tên:</label>
                        <input type="text" class="form-control" id="fullname" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="emailuser">Email:</label>
                        <input type="text" class="form-control" id="emailuser" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="infor">Nội dung:</label>
                        <textarea class="form-control" id="infor" rows="5"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger">Gửi tin nhắn</button>
                </form>
            </div>
        </div>

    </div>





</div>

<?php
include_once("views/layouts/user_footer.php");
?>