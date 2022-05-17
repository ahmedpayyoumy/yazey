
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
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet" />
</head>
<style>
  
</style>
<body>
    <div class="bg__yezy__si">
        <div class="sign-in-layout">
            <div class="logo">
                <img src="/images/logo.png" width="50px" alt="">
                <img src="/images/logo-text.png" width="190px" alt="">
            </div>
            <div class="sign-in-form">
                <div class="sign-in-form">
                    <div class="title-form">Khôi phục mật khẩu</div>
                    <div class="text-description">
                      Yazey đã gửi email tới địa chỉ {{$email}}. Vui lòng làm theo hướng dẫn trong email để đặt lại mật khẩu mới
                    </div>
                    <div class="register" style="padding-top: 32px;">Không nhận được email? <span class="text-index bold"><a href="{{route('authenticate.forgot')}}" class="text-index">Nhập lại địa chỉ email</a></span></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
