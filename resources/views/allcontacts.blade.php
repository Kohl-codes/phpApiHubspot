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
            display: flex;
            align-items: center;
            justify-content: space-between;
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
                        <div>
                            <strong>{{ $contact['properties']['firstname'] ?? 'N/A' }}
                                {{ $contact['properties']['lastname'] ?? 'N/A' }}</strong><br>
                            Email: {{ $contact['properties']['email'] ?? 'N/A' }}<br>
                            Phone: {{ $contact['properties']['phone'] ?? 'N/A' }}
                        </div>
                        <div>
                            <!-- Update Button -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal" data-id="{{ $contact['id'] }}" data-firstname="{{ $contact['properties']['firstname'] ?? '' }}" data-lastname="{{ $contact['properties']['lastname'] ?? '' }}" data-email="{{ $contact['properties']['email'] ?? '' }}" data-phone="{{ $contact['properties']['phone'] ?? '' }}">Update</button>

                            <!-- Delete Form -->
                            <form action="{{ route('contacts.destroy', $contact['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
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

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm" action="{{ route('contacts.update', 'placeholder') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <input type="hidden" id="contact_id" name="contact_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#updateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var firstname = button.data('firstname');
            var lastname = button.data('lastname');
            var email = button.data('email');
            var phone = button.data('phone');

            var modal = $(this);
            modal.find('.modal-title').text('Update Contact ' + firstname + ' ' + lastname);
            modal.find('#firstname').val(firstname);
            modal.find('#lastname').val(lastname);
            modal.find('#email').val(email);
            modal.find('#phone').val(phone);
            modal.find('#contact_id').val(id);
            modal.find('form').attr('action', '/contacts/' + id);
        });
    </script>
</body>

</html>
