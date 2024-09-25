@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Details - Welcome Web Works</title>
    @section('title', 'Menu Details')
    @section('content')
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Include SweetAlert2 from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Google Font: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

<!-- jQuery (Include only once) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
    $('#menuDetails').DataTable({
        "paging": true,  // Enable pagination
        "lengthChange": false, // Disable changing page length
        "searching": true, // Enable searching
        "ordering": true,  // Enable column ordering
        "info": true,      // Enable showing information
        "autoWidth": false // Disable auto column width adjustment
    });

    // Use event delegation to handle delete functionality with SweetAlert confirmation
    $(document).on('click', '.delete-menu', function() {
        var menuId = $(this).data('id'); // Get the menu ID from the button's data attribute

        // SweetAlert confirmation popup
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request to delete the record
                $.ajax({
                    url: '/menu/' + menuId, // Replace with your delete route
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        // Show success toast notification after successful deletion
                        toastr.success('Menu deleted successfully!');

                        // Remove the corresponding table row dynamically
                        $('#menu-row-' + menuId).fadeOut(500, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error and show error toast notification
                        toastr.error('Failed to delete the menu. Please try again.');
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Handle if the user cancels
                toastr.info('Action canceled.'); // Optional: Display a notification when cancellation happens
            }
        });
        
    });
    // Handle the click on Edit icon
    $(document).on('click', '.edit-menu', function() {
        var menuId = $(this).data('id'); // Get menu ID

        // Send AJAX request to fetch the menu data
        $.ajax({
            url: '/menu/' + menuId + '/edit', // Replace with your correct route for fetching menu data
            method: 'GET',
            success: function(response) {
                // Assuming the response contains the menu data, populate the form
                $('#edit_menu_name').val(response.menu_name);
                $('#edit_menu_description').val(response.menu_description);
                $('#edit_menu_type').val(response.menu_type);
                $('#edit_menu_category').val(response.menu_category);

                // Set the image preview if there's an existing image
                if (response.menu_image) {
                    $('#edit_image_preview').attr('src', '/storage/' + response.menu_image);
                } else {
                    $('#edit_image_preview').attr('src', '#'); // Default or empty
                }

                // Set the form action URL dynamically (for updating the menu)
                $('#editMenuForm').attr('action', '/menu/' + menuId);

                // Show the modal
                $('#editMenuModal').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle errors (optional)
                toastr.error('Failed to fetch menu details. Please try again.');
            }
        });
    });

    // Handle form submission (if needed)
    $('#editMenuForm').on('submit', function(e) {
        e.preventDefault();
        // Send the updated data via AJAX (optional)
        // Here you would perform the update action using the form action URL
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
            font-weight: 700;
            font-size: 1.5rem;
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



        <div class="form-title">Menu Details</div>

        <table id="menuDetails" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Menu ID</th>
                    <th>Menu Name</th>
                    <th>Menu Image</th>
                    <th>Menu Description</th>
                    <th>Menu Type</th>
                    <th>Menu Category</th>
                    <th>Menu Created Date</th>
                    <th>Action</th> <!-- New column for action -->
                </tr>
            </thead>
            <tbody>
                @foreach($menuDetails as $menuDetail)
                <tr id="menu-row-{{ $menuDetail->id }}">
                    <td>{{ $menuDetail->id }}</td>
                    <td>{{ $menuDetail->menu_name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $menuDetail->menu_image) }}" alt="{{ $menuDetail->menu_name }}" width="100">
                    </td>
                    <td>{!! $menuDetail->menu_description !!}</td>
                    <td>{{ $menuDetail->menu_type }}</td>
                    <td>{{ $menuDetail->menu_category }}</td>
                    <td>{{ \Carbon\Carbon::parse($menuDetail->created_at)->format('d F Y') }}</td>
                    <td class="text-center"> <!-- Center the action icons -->
                        <!-- Edit Icon -->
                        <a href="javascript:void(0);" class="text-success edit-menu" data-id="{{ $menuDetail->id }}" title="Edit">
                            <i class="fas fa-edit" style="font-size: 20px;"></i>
                        </a>
                
                        <!-- Delete Icon (With Confirmation) -->
                        <a href="javascript:void(0);" class="text-danger delete-menu" data-id="{{ $menuDetail->id }}" title="Delete">
                            <i class="fas fa-trash" style="font-size: 20px; margin-left: 10px;"></i>
                        </a>
                    </td>
                </tr>                
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


<!-- Edit Menu Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Edit Menu -->
                <form id="editMenuForm" class="inputs" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- This method is required for updating -->

                    <!-- Menu Name -->
                    <div class="mb-3">
                        <label for="edit_menu_name" class="form-label">Menu Name <span style="color: red;">*</span></label>
                        <textarea id="edit_menu_name" name="menu_name" class="form-control" required></textarea>
                    </div>

                    <!-- Menu Image Upload -->
                    <div class="mb-3">
                        <label for="edit_menu_image" class="form-label">Upload Menu Image <span style="color: red;">*</span></label>
                        <input type="file" id="edit_menu_image" name="menu_image" class="form-control" accept="image/*">

                        <!-- Preview Existing Image -->
                        <div id="edit_image_preview_container" style="margin-top: 10px;">
                            <img id="edit_image_preview" src="#" alt="Image Preview" style="width: 150px; height: 150px; border: 1px solid #ccc;" />
                        </div>
                    </div>

                    <!-- Menu Description -->
                    <div class="mb-3">
                        <label for="edit_menu_description" class="form-label">Menu Description <span style="color: red;">*</span></label>
                        <textarea id="edit_menu_description" name="menu_description" required></textarea>
                    </div>

                    <!-- Menu Type -->
                    <div class="mb-3">
                        <label for="edit_menu_type" class="form-label">Menu Type <span style="color: red;">*</span></label>
                        <select id="edit_menu_type" name="menu_type" class="form-control" required>
                            <option value="0">Veg</option>
                            <option value="1">Non-Veg</option>
                            <option value="2">Snacks</option>
                        </select>
                    </div>

                    <!-- Menu Category -->
                    <div class="mb-3">
                        <label for="edit_menu_category" class="form-label">Menu Category <span style="color: red;">*</span></label>
                        <input type="text" id="edit_menu_category" name="menu_category" class="form-control" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Menu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
</html>
