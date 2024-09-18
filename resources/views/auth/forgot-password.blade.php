<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus {
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
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

        button:hover {
            background-color: #f35555;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Forgot Password</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="/forgot-password" method="POST">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Send Password Reset Link</button>

        </form>

        <a href="/login" class="back-link">Back to Login</a>
    </div>

</body>

</html>
