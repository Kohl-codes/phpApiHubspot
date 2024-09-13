<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 20px;
            background-image: url('{{ asset('img/bg1.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .navbar .navbar-brand {
            color: #343a40;
            font-weight: bold;
        }

        .navbar .navbar-brand:hover {
            color: #131414;
        }

        .navbar .btn-info {
            margin-left: 15px;
        }



        .navbar .form-inline {
            margin-left: auto;
            /* Ensure the form is aligned to the right */
        }

        .container {
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: black;
            backdrop-filter: blur(10px);
        }

        h2 {
            color: #343a40;
            text-align: center;
        }

        .form-group label {
            color: #495057;
        }

        .alert {
            margin-top: 15px;
        }

        .btn-center {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('home') }}">Contacts</a>
        <div class="ml-auto">
            <!-- Button to Retrieve All Contacts -->
            <form action="{{ route('contacts.all') }}" method="GET" class="d-inline">
                <button type="submit" class="btn btn-info">View All Contacts</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Add Contact Form -->
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <h2>Add Contact</h2>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <!-- Display success or error message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Center the Add Contact button -->
            <div class="btn-center">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
