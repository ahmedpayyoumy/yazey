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
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet" />
</head>

<body>

    <div class="bg__yezy__si email-tems">
        {{--
        <form action="" method="post">
            @csrf
            <div class="form-content">
                @if(session('danger'))
                <p class="main-form__danger text-description" style="color: red">{{ session('danger') }}
                </p>
                @endif
                <div class="form-input-block">
                    <div class="form-title-text">Email</div>
                    <input placeholder="Nhập email" name="email" type="email" required class="ant-input" value="">
                </div>
            </div>
            <div class="sign-in-submit" style="margin-top: 12px;">
                <button type="submit" class="btn btn-primary" style="min-height: 40px;">Gửi email</button>
            </div>
        </form> --}}
        <div class="block__form">
            <div class="logo">
                <img src="/images/logo.png" width="50px" alt="">
                <img src="/images/logo-text.png" width="190px" alt="">
            </div>
            <div class="form">
                <form method="POST" action="">
                    @csrf
                    <div class="header__form" style="font-size: 24.6204px;">
                      Your Email is not Verified.
                    </div>
                    <div class="des__header" >
                        Please Enter email to continue.
                    </div>

                    <div class="bl__input">
                        <div class="input__group">
                            <div for="" class="lb__input">Email Address</div>
                            <input type="email" name="email" placeholder="You@email.com" required>
                        </div>
                    </div>

                    <div class="action">
                        <button type="submit" class="btn btn__submit">
                            submit
                        </button>
                        <div class="link__signup">
                            Do you have an account ? <a href="/login">Sign in</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>