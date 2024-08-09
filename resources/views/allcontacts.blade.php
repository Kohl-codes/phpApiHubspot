<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('{{ asset('img/bg1.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
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

        .navbar .form-inline {
            margin-left: auto;
        }

        .container {
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: black;
            backdrop-filter: blur(10px);
        }


        h3 {
            color: #343a40;
            text-align: center;
            padding-bottom: 10px;
        }

        .list-group-item {
            border: none;
            border-radius: 8px;
            margin-bottom: 10px;
            margin-top: 20px;
            background-color: #e9ecef;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #dee2e6;
        }

        .btn-custom {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #138496;
            border-color: #138496;
            color: white;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('home') }}">Contacts</a>
    </nav>

    <div class="container mt-5">
        <!-- Display Contacts -->
        @if (isset($contacts) && count($contacts) > 0)
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('contacts.manage') }}" class="btn btn-info">Add Contact</a>
                <form class="form-inline" action="{{ route('contacts.search') }}" method="GET">
                    <input class="form-control mr-sm-2 search-bar" type="search" name="query" aria-label="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>
            </div>
            <ul class="list-group mt-3">
                @foreach ($contacts as $contact)
                    <li class="list-group-item">
                        <strong>{{ $contact['properties']['firstname'] ?? 'N/A' }}
                            {{ $contact['properties']['lastname'] ?? 'N/A' }}</strong><br>
                        Email: {{ $contact['properties']['email'] ?? 'N/A' }}<br>
                        Phone: {{ $contact['properties']['phone'] ?? 'N/A' }}
                    </li>
                @endforeach
            </ul>
        @else
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('contacts.manage') }}" class="btn btn-info">Add Contact</a>
                <form class="form-inline" action="{{ route('contacts.search') }}" method="GET">
                    <input class="form-control mr-sm-2 search-bar" type="search" name="query" aria-label="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>
            </div>
            <p style="text-align: center;">No contacts found.</p>
        @endif
    </div>
</body>

</html>
