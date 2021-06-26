<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/gomsu_shop/" />
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/stylesheets/util.css">
    <link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>


    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="assets/images/img-01.png" alt="IMG">
                </div>

                <form action="" method="post" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Admin Login
                    </span>

                    <div class="main-alert">
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" id="nameid" name="name" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa far fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" id="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button name='submit' id="button-submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>

                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $('#button-submit').on('click', function(e) {
        var name = $('#nameid').val();
        var password = $('#password').val();
        if (name !== '' && password !== '') {
            $.ajax({
                type: 'POST',
                url: 'auth/checklogin',
                data: {
                    name: name,
                    password: password
                },
                success: function(res) {
                    if (res == 'success') {
                        window.location.href = "http://localhost/gomsu_shop/admin";
                    } else {
                        $(".main-alert").html(
                            '<p style="color: red; margin-bottom: 12px">Tài khoản hoặc mật khẩu không đúng</p>'
                        );
                        setTimeout(function() {
                            $(".main-alert").html('');
                        }, 3000);
                    }
                }
            });
            e.preventDefault();

        }

    })
    </script>




    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="assets/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
    </script>
    <!--===============================================================================================-->
    <script src="assets/javascripts/main.js"></script>



</body>

</html>