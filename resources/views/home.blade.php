<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('{{ asset('img/bg2.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Slightly transparent background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
            font-size: 2.5rem;
            animation: fadeInUp 2s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            margin: 10px;
        }

        .btn-primary {
            background-color: #e991ec;
            border-color: #fc84f2;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #d25ed6;
            border-color: #c740bc;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to your HubSpot Contacts! </h1>
        <a href="{{ route('contacts.manage') }}" class="btn btn-primary">Add Contact</a>
        <a href="{{ route('contacts.all') }}" class="btn btn-info">View All Contacts</a>
    </div>
</body>

</html>
