<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contacts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 20px;
            background-image: url('{{ asset('img/bg1.jpg') }}');
            /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.8);
            /* Transparent background */
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
            /* Ensure the form is aligned to the right */
        }

        .container {

            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            background: rgba(255, 255, 255, 0.1);
            /* Increased opacity for better readability */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: black;
            /* Transparent white */
            backdrop-filter: blur(10px);
        }

        .back-link {
            color: #000000;
            text-decoration: none;
            font-size: 1rem;
            display: block;
            margin-bottom: 20px;
            font-weight: bold;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back-link:hover {
            color: #000;
            text-decoration: none;
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
            background-color: #e9ecef;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #dee2e6;
        }

        .search-bar {
            margin: 20px 0;
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
                <!-- Add Contact Button aligned to the right -->
                <a href="{{ route('contacts.manage') }}" class="btn btn-info">Add Contact</a>

                <form class="form-inline ml-auto" action="{{ route('contacts.search') }}" method="GET">
                    <input class="form-control mr-sm-2 search-bar" type="search" name="query" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
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
            <!-- Add Contact Button aligned to the right -->
            <a href="{{ route('contacts.manage') }}" class="btn btn-info">Add Contact</a>

            <form class="form-inline ml-auto" action="{{ route('contacts.search') }}" method="GET">
                <input class="form-control mr-sm-2 search-bar" type="search" name="query" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
            <p style="text-align: center;">No contacts found.</p>
        @endif
    </div>
</body>

</html>
