<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>OTP Email</title>
    <style>
        body {
            background-color: #f4f4f7;
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4f46e5;
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #999;
        }

        .footer a {
            color: #4f46e5;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <h2>Hi {{ $detail['user_name'] }},</h2>
            <p><b>Your mail:</b> {!!$detail['message']!!}</p>
            <p><b>Reply:</b> {!! $detail['reply'] !!}</p>

        </div>
        <div class="footer">
            Thank you for using {{ config('app.name') }}.<br>
        </div>
    </div>
</body>

</html>