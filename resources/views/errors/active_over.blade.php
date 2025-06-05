<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Inactive</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 16px;
            color: #d32f2f;
        }
        p {
            font-size: 16px;
            margin-bottom: 24px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .contact-btn {
            background-color: #1976d2;
            color: #fff;
        }
        .contact-btn:hover {
            background-color: #1565c0;
        }
        .back-btn {
            background-color: #757575;
            color: #fff;
        }
        .back-btn:hover {
            background-color: #616161;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/hajji soft 1.png') }}" alt="Hajji Soft Logo" class="logo">
        <h1>Your Active Days Are Over</h1>
        <p>{{ $message ?? __('Your active days are over, please contact your Admin') }}</p>
        <a href="mailto:{{ config('app.admin_email', 'admin@example.com') }}" class="contact-btn" aria-label="Contact administrator for account issues">Contact Admin</a>
        <a href="{{ route('login') }}" class="back-btn" aria-label="Return to login page">Back to Login</a>
    </div>
</body>
</html>