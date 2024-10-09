@extends('layouts.app')

@section('title', 'Add New Menu - Welcome Web Works')

@section('head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
            width: 350px;
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

        input, button, textarea, select {
            display: block;
            width: 100%;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        input, textarea, select {
            background: #ecf0f3;
            padding: 10px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            margin-bottom: 10px;
        }

        textarea {
            border-radius: 20px;
            resize: none;
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

        .alert {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>

        <div class="form-title">Add New Menu Form</div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="inputs" action="{{ route('addMenu') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Menu Name -->
            <div class="mb-3">
                <label for="menu_name" class="form-label">Menu Name <span style="color: red;">*</span></label>
                <textarea id="menu_name" name="menu_name" class="form-control" placeholder="Enter menu name" required style="height: 80px;"></textarea>
            </div>

            <!-- Menu Image Upload -->
            <div class="mb-3">
                <label for="menu_image" class="form-label">Upload Menu Image <span style="color: red;">*</span></label>
                
                <!-- Image Upload Input -->
                <input type="file" id="menu_image" name="menu_image" class="form-control" accept="image/*" required>

                <!-- Preview Container (Hidden Initially) -->
                <div id="image_preview_container" style="display: none; margin-top: 10px;">
                    <img id="image_preview" src="#" alt="Image Preview" style="width: 150px; height: 150px; border: 1px solid #ccc;" />
                </div>
            </div>

            <!-- Summernote editor container -->
            <div class="mb-3">
                <label for="menu_description" class="form-label">Menu Description <span style="color: red;">*</span></label>
                <textarea id="menu_description" name="menu_description" required></textarea>
            </div>

            <!-- Menu Type -->
            <div class="mb-3">
                <label for="menu_type" class="form-label">Menu Type <span style="color: red;">*</span></label>
                <select id="menu_type" name="menu_type" class="form-control" required>
                    <option value="" disabled selected>Select Menu Type</option>
                    <option value="0">Veg</option>
                    <option value="1">Non-Veg</option>
                    <option value="2">Snacks</option>
                </select>
            </div>

            <!-- Menu Category -->
            <div class="mb-3">
                <label for="menu_category" class="form-label">Menu Category <span style="color: red;">*</span></label>
                <input type="text" id="menu_category" name="menu_category" class="form-control" placeholder="Enter menu category" required>
            </div>

            <!-- Note to re-verify client details -->
            <p style="color: red;">NOTE: <span style="color: #000000">Please re-verify Menu details before adding the Menu.</span></p>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary addClientSubmit">Add Menu</button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- jQuery (if not already included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            $('#menu_description').summernote({
                height: 200, // Set the height of the editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'undo', 'redo']]
                ]
            });

            // When the user selects an image
            $('#menu_image').on('change', function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    // Display the preview once the image is loaded
                    reader.onload = function(e) {
                        $('#image_preview').attr('src', e.target.result);
                        $('#image_preview_container').show(); // Show the preview container
                    }

                    reader.readAsDataURL(input.files[0]); // Read the selected file as a data URL
                } else {
                    $('#image_preview_container').hide(); // Hide the preview if no image is selected
                }
            });
        });
    </script>
@endsection
