@extends('layouts.app')

@section('title', 'Login')

@push('styles')
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .login-form {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-form h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
            text-align: center;
        }
        .form-group input {
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 45px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .form-group .btn-primary {
            background-color: #d10024;
            border-color: #d10024;
            width: 100%;
            height: 45px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 4px;
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
        }
    </style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-form col-md-4">
        <h2>Login to Your Account</h2>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Alamat Email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

        </form>
        <div class="form-links">
            <p>
                <a href="#">Forgot Your Password?</a>
            </p>
            <p>
                Don't have an account? <a href="#">Sign Up</a>
            </p>
        </div>
    </div>
</div>
@endsection
