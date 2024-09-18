<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Reset Password</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        .reset-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .reset-card:hover {
            box-shadow: 0px 15px 40px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #d50000;
            color: #fff;
            padding: 15px;
            border-radius: 15px 15px 0 0;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            margin: -30px -30px 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            border-radius: 30px;
            background-color: #f5f5f5;
            border: 2px solid #ddd;
            padding: 15px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #d50000;
            box-shadow: 0 0 5px rgba(213, 0, 0, 0.5);
            outline: none;
        }

        .btn {
            width: 100%;
            background-color: #d50000;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 30px;
            font-weight: bold;
            font-size: 1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #b71c1c;
        }

        .invalid-feedback {
            color: #d50000;
            font-size: 0.875rem;
            display: block;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .reset-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="reset-card">
            <div class="card-header">
                <h3>{{ __('Reset Password') }}</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
