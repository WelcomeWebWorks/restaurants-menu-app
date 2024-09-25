<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Details - Welcome Web Works</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#clientTable').DataTable({
                "paging": true,  // Enable pagination
                "lengthChange": false, // Disable changing page length
                "searching": true, // Enable searching
                "ordering": true,  // Enable column ordering
                "info": true,      // Enable showing information
                "autoWidth": false // Disable auto column width adjustment
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

    <!-- Outer Container -->
    <div class="container mt-5">
        <!-- Row for Create and Edit Forms -->
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>
        <div class="row">
            <!-- Create User Form -->
            <div class="col-md-6">
                <div class="form-title">Client Create Form</div>

                <form id="createClientForm" class="inputs" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST') <!-- This method is required for creating -->

                    <!-- Client Domain Name -->
                    <div class="mb-3">
                        <label for="create_client_domain_name" class="form-label">Client Domain Name <span style="color: red;">*</span></label>
                        <input type="text" id="create_client_domain_name" name="js_client_domain_name" class="form-control" required>
                    </div>

                    <!-- Client Name -->
                    <div class="mb-3">
                        <label for="create_client_name" class="form-label">Client Name <span style="color: red;">*</span></label>
                        <input type="text" id="create_client_name" name="js_client_name" class="form-control" required>
                    </div>

                    <!-- Client Email -->
                    <div class="mb-3">
                        <label for="create_client_email" class="form-label">Client Email <span style="color: red;">*</span></label>
                        <input type="email" id="create_client_email" name="js_client_email" class="form-control" required>
                    </div>

                    <!-- Client Contact 1 -->
                    <div class="mb-3">
                        <label for="create_client_contact1" class="form-label">Primary Contact Number <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="text" id="create_client_contact1" name="js_client_contact1" class="form-control" placeholder="Enter primary contact number" required maxlength="13">
                        </div>
                        <small id="create_contact1_feedback" class="form-text"></small>
                    </div>

                    <!-- Client Contact 2 -->
                    <div class="mb-3">
                        <label for="create_client_contact2" class="form-label">Secondary Contact Number</label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="text" id="create_client_contact2" name="js_client_contact2" class="form-control" placeholder="Enter secondary contact number" maxlength="13">
                        </div>
                        <small id="create_contact2_feedback" class="form-text"></small>
                    </div>

                    <!-- Client Location -->
                    <div class="mb-3">
                        <label for="create_client_location" class="form-label">Client Location <span style="color: red;">*</span></label>
                        <textarea id="create_client_location" name="js_client_location" class="form-control" placeholder="Enter client location" rows="4" required></textarea>
                        <button type="button" id="use_location" class="btn btn-primary mt-2">Use Current Location</button>
                        <small id="location_feedback" class="form-text"></small>
                    </div>

                    <!-- Client Status -->
                    <div class="mb-3">
                        <label for="create_client_status" class="form-label">Client Status <span style="color: red;">*</span></label>
                        <select id="create_client_status" name="js_client_status" class="form-control" required>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit Client</button>
                </form>
            </div>

            <!-- Edit User Form -->
            <div class="col-md-6">
                <div class="form-title">Client Edit Form</div>

                <form id="editClientForm" class="inputs" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST') <!-- This method is required for updating -->

                    <!-- Client Domain Name -->
                    <div class="mb-3">
                        <label for="edit_client_domain_name" class="form-label">Client Domain Name <span style="color: red;">*</span></label>
                        <input type="text" id="edit_client_domain_name" name="edit_client_domain_name" class="form-control" required>
                    </div>

                    <!-- Client Name -->
                    <div class="mb-3">
                        <label for="edit_client_name" class="form-label">Client Name <span style="color: red;">*</span></label>
                        <input type="text" id="edit_client_name" name="edit_client_name" class="form-control" required>
                    </div>

                    <!-- Client Email -->
                    <div class="mb-3">
                        <label for="edit_client_email" class="form-label">Client Email <span style="color: red;">*</span></label>
                        <input type="email" id="edit_client_email" name="edit_client_email" class="form-control" required>
                    </div>

                    <!-- Client Contact 1 -->
                    <div class="mb-3">
                        <label for="edit_client_contact1" class="form-label">Primary Contact Number <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="text" id="edit_client_contact1" name="edit_client_contact1" class="form-control" placeholder="Enter primary contact number" required maxlength="13">
                        </div>
                        <small id="edit_contact1_feedback" class="form-text"></small>
                    </div>

                    <!-- Client Contact 2 -->
                    <div class="mb-3">
                        <label for="edit_client_contact2" class="form-label">Secondary Contact Number</label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="text" id="edit_client_contact2" name="edit_client_contact2" class="form-control" placeholder="Enter secondary contact number" maxlength="13">
                        </div>
                        <small id="edit_contact2_feedback" class="form-text"></small>
                    </div>

                    <!-- Client Location -->
                    <div class="mb-3">
                        <label for="edit_client_location" class="form-label">Client Location <span style="color: red;">*</span></label>
                        <textarea id="edit_client_location" name="edit_client_location" class="form-control" placeholder="Enter client location" rows="4" required></textarea>
                        <button type="button" id="use_location" class="btn btn-primary mt-2">Use Current Location</button>
                        <small id="location_feedback" class="form-text"></small>
                    </div>

                    <!-- Client Status -->
                    <div class="mb-3">
                        <label for="edit_client_status" class="form-label">Client Status <span style="color: red;">*</span></label>
                        <select id="edit_client_status" name="edit_client_status" class="form-control" required>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </div>

                    <!-- Update Button -->
                    <button type="update" class="btn btn-primary">Update Client</button>
                </form>
            </div>
        </div>

        <!-- Row for Client Table -->
        <div class="row mt-5">
            <div class="col-sm-12">
                <div class="brand-title">Client Table</div>
                <table id="clientTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Client Domain Name</th>
                            <th>Client Primary Contact Number</th>
                            <th>Client Secondary Contact Number</th>
                            <th>Client Email</th>
                            <th>Client Location</th>
                            <th>Client Status</th>
                            <th>Client Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientDatas as $clientDetail)
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
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
