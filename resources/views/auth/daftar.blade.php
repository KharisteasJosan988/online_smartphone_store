<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="{{ asset('assets/css/adminlte.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-form {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .register-form h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
            text-align: center;
        }

        .form-group input {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 45px;
            font-size: 16px;
            margin-bottom: 20px;
            padding: 0 10px;
            box-sizing: border-box;
        }

        .form-group .btn-primary {
            background-color: #d10024;
            border: none;
            width: 100%;
            height: 45px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .form-group .btn-primary:hover {
            background-color: #c00022;
        }

        .form-links {
            text-align: center;
            margin-top: 20px;
        }

        .form-links a {
            color: #d10024;
            text-decoration: none;
        }

        .form-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-form">
            <h2>Create Your Account</h2>
            @if (Session::has('success'))
                <div class="alert alert-success mt-3">
                    {{ Session::get('success') }}
                </div>
            @endif
            <!-- Menampilkan pesan kesalahan validasi -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('daftar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Username" required autofocus>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm Password" required>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <div class="form-links">
                <p>
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
