<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/Authentication/notification_register.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    <div class="background" style="background-image: url('../../images/background_login.png')">
        <div class="container-notification">
            <div class="container-notification-top"></div>

            <div class="container-notification-body">
                <div class="circle-icons">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>

                <div class="wrapper">
                    <p class="content-notification">
                        @if (session('success'))
                        {{ session('success') }}
                        @endif
                    </p>

                    <button id="btnGoHomePage" type="button">
                        Đến trang chủ
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $('#btnGoHomePage').click((e) => {
     location.href = '/';
   })
</script>

</html>
