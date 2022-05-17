<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | Sistem Informasi Pegawai Persis 80 Al Amin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('klorofil/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('klorofil/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('klorofil/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('klorofil/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('klorofil/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('klorofil/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('klorofil/img/favicon.png')}}">
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <div class="logo" style="margin-bottom:20px"><img
                                        src="{{asset('klorofil/img/logo-dark.png')}}" alt="Klorofil Logo">
                                </div>
                                @if ($message = Session::get('success'))
                                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 12l5 5l10 -10" />
                                                <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                                        </div>
                                        <div>
                                            {{ $message }}
                                        </div>
                                    </div>
                                    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                                </div>

                                @endif
                                <p class="lead">Silahkan Login</p>
                            </div>
                            <form class="form-auth-small" action="{{route('postlogin')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Username</label>
                                    <input type="text" class="form-control" name="email" placeholder="Username">

                                </div>

                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password"
                                        placeholder="Password">
                                </div>

                                <button type="submit" class="btn btn-success btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    <span class="helper-text"><i class="fa fa-lock"></i> Belum Punya Akun ? <a
                                            href="/daftar">Daftar</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading">SISTEM INFORMASI PEGAWAI Ver. 1.0</h1>
                            <p>Pesantren Persis 80 Al-amin Sindangkasih</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>

</html>
