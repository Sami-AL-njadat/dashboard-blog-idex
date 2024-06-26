<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us Email</title>
    <style>
        body {
            background-image: url('images/logoidex.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #555;
        }
        p {
            margin-bottom: 10px;
        }
        strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Us Email</h2>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
        <p><strong>Message:</strong><br>{{ $data['message'] }}</p>
    </div>
</body>
</html>
