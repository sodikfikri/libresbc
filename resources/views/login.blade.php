@php
    $msg = Session::get('error');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    {{-- {{asset('assets/img/favicon/favicon.ico')}} --}}
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.min.js" integrity="sha512-vCI1Ba/Ob39YYPiWruLs4uHSA3QzxgHBcJNfFMRMJr832nT/2FBrwmMGQMwlD6Z/rAIIwZFX8vJJWDj7odXMaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="widescreen">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6">

                <div class="card o-hidden border-0 shadow-lg my-5 ">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>Dashboard <span style="color: #2e59d9">SBC & Enum</span></strong></h1>
                                    </div>
                                    <div style="padding: 20px">
                                        <form class="user" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    id="username" name="username" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                    id="password" name="password" placeholder="Password">
                                            </div>
                                            <button type="submit" id="login" class="btn btn-primary btn-block">
                                                Login
                                            </button>
                                        </form>
                                    </div>
                                    {{-- <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let err = "{{ $msg }}";
        // console.log(err);
        const toastMixin = Swal.mixin({
            toast: true,
            icon: "success",
            title: "General Title",
            animation: false,
            position: "top-right",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
        
        if (err) {
            toastMixin.fire({
                icon: "warning",
                title: err,
            });
        }

        // $('#login').on('click', function(e) {
        //     e.preventDefault()
        //     let params = {
        //         username: $('#username').val(),
        //         password: $('#password').val()
        //     }
        //     login(params)
        // })
        
        // let login = (params) => {
        //     $.ajax({
        //         url: '/api/login',
        //         method: 'POST',
        //         data: params,
        //         success: function(resp) {
        //             console.log(resp);
        //             if (resp.meta.code == '200') {
        //                 window.location.href = '/dashboard'
        //             } else {
                        // toastMixin.fire({
                        //     icon: "warning",
                        //     title: resp.meta.message,
                        // });
        //             }
        //         }
        //     })
        // }
    </script>

</body>

</html>