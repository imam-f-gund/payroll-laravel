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
                            <form id="formAuthentication" class="mb-3" action="#" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" autofocus />
                                </div>
                                <button type="button" class="btn btn-primary d-grid w-100" onclick="forgotPassword()">Send
                                    Reset
                                    Link</button>
                            </form>
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
    
        var url = "{{ url('api/forgot-password') }}";

        function forgotPassword() {
            var email = $('#email').val();

            if (email == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter your email address!',
                })
            } else {
                $(this).attr('disabled', 'disabled');

                Swal.fire({
                    title: 'Please wait...',
                    html: `
                    <div class="mb-3"> Sending reset password link to your email address. </div>
                    <div class="spinner-border text-primary" role="status">
                        </div>`,
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        email: email
                    },
                    success: function(response) {
                        Swal.close();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Link reset password berhasil dikirim ke email anda!",
                        });

                        $(this).removeAttr('disabled');
                    },
                    error: function(response) {
                        Swal.close();

                        if (response.responseJSON.message == 'passwords.throttled') {
                            Swal.fire({
                                icon: '',
                                title: 'Information',
                                text: 'Tunggu beberapa saat untuk mengirim ulang link reset password!',
                            });
                        } else {
                            Swal.fire({
                                icon: '',
                                title: 'Information...',
                                text: response.responseJSON.message,
                            });
                        }

                        $(this).removeAttr('disabled');
                    }
                });
            }
        }

        
    </script>

    @include('sweetalert::alert')
</body>

</html>
