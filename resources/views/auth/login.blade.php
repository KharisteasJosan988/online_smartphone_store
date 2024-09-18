<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom CSS -->
    <style>
        /* CSS untuk memposisikan form login di tengah */
        html,
        body {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
        }

        .primary-btn {
            width: 100%;
            margin-top: 1px;
        }
    </style>
</head>

<body>

    <!-- CONTENT -->
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>{{ __('Login') }}</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="input @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="input @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password">
                                    @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group text-center">
                                    <button type="submit"
                                        class="primary-btn btn btn-primary">{{ __('Login') }}</button>
                                </div>

                                <!-- Register Button -->
                                <div class="form-group text-center">
                                    <a href="{{ route('register') }}"
                                        class="primary-btn btn btn-secondary">{{ __('Register') }}</a>
                                    <!-- Forgot Password -->
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link"
                                            href="{{ url('forgot-password') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTENT -->

    <!-- jQuery Plugins -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
