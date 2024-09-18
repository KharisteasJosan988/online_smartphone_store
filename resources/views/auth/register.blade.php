<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .register-card h3 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #d50000;
            color: white;
            margin-bottom: 20px;
        }

        .login {
            text-align: center;
            color: #d50000;
        }

        .btn-primary:hover {
            background-color: #b71c1c;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .invalid-feedback {
            color: #d50000;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="register-card">
        <h3>Buat Akun</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="Name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Email Address">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn btn-primary">
                REGISTER
            </button>
        </form>

        <div class="login">
            <a href="{{ route('login') }}">
                Sudah Punya Akun? LOGIN!
            </a>
        </div>

        <div class="forgot-password">
            <a href="{{ url('forgot-password') }}">
                Forgot Your Password?
            </a>
        </div>
    </div>
</body>

</html>
