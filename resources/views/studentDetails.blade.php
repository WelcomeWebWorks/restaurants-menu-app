@extends('layouts.app')

@section('title', 'Client Details')

@section('head')
    <!-- Additional CSS Libraries -->
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
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
            width: 100%;
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

        /* Adjust table styles */
        .table-responsive {
            margin-top: 30px;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e0e0e0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0;
            margin-left: 0;
            display: inline;
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: none;
            color: #008CBA;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: none;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: auto;
            background: #ecf0f3;
            border-radius: 20px;
            padding: 5px 10px;
            border: 1px solid #cbced1;
        }

        .dataTables_wrapper .dataTables_length select {
            background: #ecf0f3;
            border-radius: 20px;
            padding: 5px 10px;
            border: 1px solid #cbced1;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>

        <div class="form-title">Student Details</div>

        <div class="table-responsive">
            <table id="clientTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student College Name</th>
                        <th>Student Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>CGPA</th>
                        <th>Native Location</th>
                        <th>Contact Number</th>
                        <th>Father's Occupation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentDetails as $studentDetail)
                    <tr>
                        <td>{{ $studentDetail->student_id }}</td>
                        <td>{{ $studentDetail->student_college_name }}</td>
                        <td>{{ $studentDetail->student_name }}</td>
                        <td>{{ $studentDetail->student_gender }}</td>
                        <td>{{ $studentDetail->student_personal_email }}</td>
                        <td>{{ $studentDetail->student_department }}</td>
                        <td>{{ $studentDetail->student_cgpa }}</td>
                        <td>{{ $studentDetail->student_native_location }}</td>
                        <td>{{ $studentDetail->student_contact_number }}</td>
                        <td>{{ $studentDetail->student_father_occupation }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" class="text-success edit-client" data-id="{{ $studentDetail->student_id }}" title="Edit">
                                <i class="fas fa-edit" style="font-size: 20px;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Modal Title -->
                    <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                    <!-- Close Button -->
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
                            <input type="text" id="edit_client_domain_name" name="client_domain_name" class="form-control" required>
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
@endsection

@section('scripts')
    <!-- Additional JS Libraries -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- DataTables Responsive Bootstrap JS -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#clientTable').DataTable({
                responsive: true,
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                // Ensure that the columns option is removed if not using AJAX data source
                // columns: [ ... ]
            });
        });
    </script>
@endsection
