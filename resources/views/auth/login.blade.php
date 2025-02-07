<h1>Bala</h1>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link to your custom CSS or Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4e73df;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="email"],
        input[type="password"],
        input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3652b7;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #4e73df;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Responsive design for smaller screens */
        @media screen and (max-width: 480px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            button {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Login</h2>

    @if(session('error'))
        <p style="color: red; text-align: center;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="remember">
                <input type="checkbox" name="remember" id="remember"> Remember Me
            </label>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
