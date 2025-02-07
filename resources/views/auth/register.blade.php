<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #007BFF;
            outline: none;
        }

        .form-group p {
            font-size: 12px;
            color: red;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success-message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        #otpSentMsg {
            color: green;
            text-align: center;
            display: none;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            text-decoration: none;
            color: #007BFF;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register</h2>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            @error('name') <p>{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            @error('email') <p>{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
            @error('phone') <p>{{ $message }}</p> @enderror
        </div>

        <button type="button" id="sendOtp">Send OTP</button>
        <p id="otpSentMsg">OTP Sent!</p>

        <div class="form-group">
            <label for="otp">OTP:</label>
            <input type="text" id="otp" name="otp" required>
            @error('otp') <p>{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password') <p>{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>

    <div class="form-footer">
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

<script>
    $("#sendOtp").click(function() {
        var phone = $("#phone").val();
        if (phone.length !== 10) {
            alert("Enter a valid phone number");
            return;
        }
        $.ajax({
            url: "{{ route('send.otp') }}",
            type: "POST",
            data: { phone: phone, _token: "{{ csrf_token() }}" },
            success: function(response) {
                $("#otpSentMsg").show();
                alert("OTP Sent: " + response.otp); // For testing, remove in production
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });
</script>

</body>
</html>
