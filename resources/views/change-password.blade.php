<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reset Password</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .bg-gradient-success {
            background-color: #143eb4;
            background-image: linear-gradient(180deg, #692234 10%, #cebb0f 100%);
            background-size: cover;
        }

        .btn-login {
        border-radius: 4px;
        background-image: linear-gradient(180deg, #226769 10%, #0a259c 90%);
        background-size: cover;
        border: none;
        color: #FFFFFF;
        text-align: center;
        }

        /* .btn-login {
            background-color: #143eb4;
            background-image: linear-gradient(180deg, #226769 10%, #55ce0f 90%);
            background-size: cover;
            transition: all 0.5s;
            cursor: pointer;
        } */
    
        input {
            font-size: 11pt !important;
            padding: 10px 10px;
        }

    </style>

</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card my-3">
                    <div class="card-body">
                        <div class="p-3">
                            <div class="text-center">
                            
                            </div>
                            <h4 class="mb-2">Change Password 🔒</h4>
                            <p class="mb-4">Change your password to a new one.</p>
                            <form id="formAuthentication" class="mb-3" action="#" method="POST">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter your new password" autofocus />
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm your new password" />
                                </div>
                                <button type="button" class="btn btn-primary d-grid w-100" onclick="changePassword()">
                                    Change Password
                                </button>
                            </form>
                            <div class="text-center">
                                <a href="{{ url('login') }}" class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    Back to login
                                </a>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>


    @if ($errors->any())
        <div id="ERROR_COPY" style="display: none;" class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <h6>{{ $error }}</h6>
            @endforeach
        </div>
    @endif

    @if (config('sweetalert.animation.enable'))
        <link rel="stylesheet" href="{{ config('sweetalert.animatecss') }}">
    @endif
    <script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <script type="text/javascript">
        var cekError = {{ $errors->any() > 0 ? 'true' : 'false' }};
        var ht = $("#ERROR_COPY").html();
        if (cekError) {
            Swal.fire({
                title: 'Errors',
                icon: 'error',
                html: ht,
                showCloseButton: true,
            });
        }
    
        var url = "{{ url('api/reset-password') }}";
        var email = "{{ request('email') }}";
        var token = "{{ request('token') }}";

        if (email == '' || token == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid URL',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('login') }}";
                }
            })
        }

        function changePassword() {
            if ($('#password').val() == $('#password_confirmation').val()) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        email: email,
                        token: token,
                        password: $('#password').val(),
                        password_confirmation: $('#password_confirmation').val(),
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Password berhasil diubah",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ url('login') }}";
                            }
                        })
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,
                        })
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password and confirm password does not match!',
                })
            }
        }

    </script>

    @include('sweetalert::alert')
</body>

</html>
