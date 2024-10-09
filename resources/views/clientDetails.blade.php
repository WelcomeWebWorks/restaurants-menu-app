@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Details - Welcome Web Works</title>
    @section('title', 'Client Details')
    @section('content')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS and Responsive Extension -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <!-- Initialize DataTable with Responsive Feature and Column Priority -->
    <script>
        $(document).ready(function() {
            $('#clientTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true, // Enable responsive mode
                "columns": [ // Set priority for each column
                    { "data": "id", "responsivePriority": 1 }, // Always show on mobile
                    { "data": "client_name", "responsivePriority": 2 }, // Always show on mobile
                    { "data": "client_domain_name", "responsivePriority": 3 }, // Always show on mobile
                    { "data": "client_contact1", "responsivePriority": 4 },
                    { "data": "client_contact2", "responsivePriority": 5 },
                    { "data": "client_email", "responsivePriority": 6 },
                    { "data": "client_location", "responsivePriority": 7 },
                    { "data": "client_status", "responsivePriority": 8 },
                    { "data": "created_at", "responsivePriority": 9 },
                    { "data": "action", "responsivePriority": 10 } // Action buttons
                ]
            });
        });
    </script>

    <style>
        input {
            caret-color: red;
        }

        body {
            margin: 0;
            width: 100vw;
            background: #ecf0f3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            padding: 40px;
            background: #ecf0f3;
            border-radius: 20px;
            box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
            text-align: center;
        }

        .brand-logo {
            height: 100px;
            width: 100px;
            background: url("{{ asset('images/compeny_logo.png') }}") no-repeat center center;
            background-size: contain;
            margin: auto;
            border-radius: 50%;
            box-shadow: 7px 7px 10px rgb(0, 0, 0), -7px -7px 10px rgb(0, 0, 0);
        }

        .form-title {
            margin-top: 10px;
            font-weight: 500;
            font-size: 1.3rem;
            color: #008CBA;
            letter-spacing: 1px;
        }

        .brand-title {
            margin-top: 10px;
            font-weight: 200;
            font-size: 1rem;
            color: #000000;
            letter-spacing: 1px;
        }

        .inputs {
            text-align: left;
            margin-top: 30px;
        }

        input, button {
            display: block;
            width: 100%;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        input {
            background: #ecf0f3;
            padding: 10px;
            height: 50px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }

        button {
            margin-top: 20px;
            background: #1DA1F2;
            color: white;
            height: 40px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 900;
            box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
            transition: 0.5s;
        }

        button:hover {
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>

        <div class="form-title">Client Details</div>

        <div class="table-responsive">
            <table id="clientTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Client Name</th>
                        <th>Client Domain Name</th>
                        <th>Client Primary Contact Number</th>
                        <th>Client Secondary Contact Number</th>
                        <th>Client Email</th>
                        <th>Client Address</th>
                        <th>Client Status</th>
                        <th>Client Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientDetails as $clientDetail)
                    <tr>
                        <td>{{ $clientDetail->id }}</td>
                        <td>{{ $clientDetail->client_name }}</td>
                        <td>{{ $clientDetail->client_domain_name }}</td>
                        <td>{{ $clientDetail->client_contact1 }}</td>
                        <td>{{ $clientDetail->client_contact2 }}</td>
                        <td>{{ $clientDetail->client_email }}</td>
                        <td>{{ $clientDetail->client_location }}</td>
                        <td>{{ $clientDetail->client_status == 0 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ \Carbon\Carbon::parse($clientDetail->created_at)->format('d F Y') }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" class="text-success edit-client" data-id="{{ $clientDetail->id }}" title="Edit">
                                <i class="fas fa-edit" style="font-size: 20px;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to Edit Client -->
                    <form id="editClientForm" class="inputs" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <!-- Client ID (Hidden) -->
                        <input type="hidden" id="edit_client_id" name="client_id">

                        <!-- Client Name -->
                        <div class="mb-3">
                            <label for="edit_client_name" class="form-label">Client Name <span style="color: red;">*</span></label>
                            <input type="text" id="edit_client_name" name="client_name" class="form-control" required>
                        </div>

                        <!-- Client Domain Name -->
                        <div class="mb-3">
                            <label for="edit_client_domain_name" class="form-label">Client Domain Name <span style="color: red;">*</span></label>
                                <input type="text" id="edit_client_domain_name" name="edit_client_domain_name" class="form-control" required>
                        </div>                        

                        <!-- Client Contact 1 -->
                        <div class="mb-3">
                            <label for="edit_client_contact1" class="form-label">Client Primary Contact<span style="color: red;">*</span></label>
                            <input type="text" id="edit_client_contact1" name="client_contact1" class="form-control" required>
                        </div>

                        <!-- Client Contact 2 -->
                        <div class="mb-3">
                            <label for="edit_client_contact2" class="form-label">Client Secondary Contact <span style="color: red;">*</span></label>
                            <input type="text" id="edit_client_contact2" name="client_contact2" class="form-control" required>
                        </div>

                         <!-- Client Email -->
                         <div class="mb-3">
                            <label for="edit_client_email" class="form-label">Client Email <span style="color: red;">*</span></label>
                            <input type="email" id="edit_client_email" name="client_email" class="form-control" required>
                        </div>

                        <!-- Client location -->
                        <div class="mb-3">
                            <label for="edit_client_location" class="form-label">Client Address<span style="color: red;">*</span></label>
                            <input type="text" id="edit_client_location" name="client_location" class="form-control" required>
                        </div>

                         <!-- Client Status -->
                        <div class="mb-3">
                            <label for="edit_client_status" class="form-label">Client Status <span style="color: red;">*</span></label>
                            <select id="edit_client_status" name="client_status" class="form-control" required>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary" id="updateClientButton">Update Client</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
@endsection
</html>
