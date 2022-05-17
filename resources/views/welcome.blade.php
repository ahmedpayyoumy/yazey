<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css"/>
    @toastr_css
  </head>

<body>

    <!-- <div class="bg-sign-in"> -->
        <div class="sign-in-layout">
            <div class="sign-in-form">
                <div class="title-form" style="line-height: 50px;">Chào mừng bạn đến với Aiosale 👋</div>
                <form action="" method="post">
                    @csrf
                    <div class="form-content">
                        <div class="form-input-block">
                            <div class="form-title-text">Họ và tên</div>
                            <input placeholder="Nhập họ và tên" name="name" type="text" class="ant-input" required value="">
                        </div>
                        <div class="form-input-block">
                            <div class="form-title-text">Tên cửa hàng</div>
                            <input placeholder="Nhập tên cửa hàng" name="company_name" type="text" class="ant-input" required value="">

                            <div class="icon-eye-container" style="font-family: unset !important;">
                                .aiosale.com
                            </div>
                        </div>
                    </div>
                    <div class="sign-in-submit" style="margin-top: 48px;">
                        <button type="submit" class="btn btn-primary">Tiếp tục</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- </div> -->
</body>
@jquery
    @toastr_js
    @toastr_render
</html>
