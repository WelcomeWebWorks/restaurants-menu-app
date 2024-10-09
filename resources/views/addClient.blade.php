@extends('layouts.app')

@section('title', 'Add New Client - Welcome Web Works')

@section('head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .form-text {
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .input-group-text {
            border: none;
            background: #ecf0f3;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            border-radius: 50px 0 0 50px;
        }

        .form-control {
            border-radius: 0 50px 50px 0;
        }

        .alert {
            margin-top: 20px;
        }

        /* Adjust the use location button */
        #use_location {
            background: #008CBA;
            border: none;
            margin-top: 10px;
            height: 40px;
            border-radius: 20px;
            font-weight: 600;
        }

        #use_location:hover {
            background: #007B9E;
            box-shadow: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>

        <div class="form-title">Add New Client Form</div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="inputs" action="{{ route('addClient') }}" method="POST">
            @csrf

            <!-- Client Name -->
            <label for="client_name">Client Name <span style="color: red;">*</span></label>
            <input type="text" id="client_name" name="client_name" placeholder="Enter client name" required>

            <!-- Client Domain Name -->
            <label for="client_domain_name">Client Domain Name <span style="color: red;">*</span></label>
            <input type="text" id="client_domain_name" name="client_domain_name" placeholder="Enter client domain name" required>
            <small id="domain_name_feedback" class="form-text"></small>

            <!-- Client Contact 1 -->
            <label for="client_contact1">Primary Contact Number <span style="color: red;">*</span></label>
            <div class="input-group">
                <span class="input-group-text">+91</span>
                <input type="text" id="client_contact1" name="client_contact1" placeholder="Enter primary contact number" required maxlength="13">
            </div>
            <small id="contact1_feedback" class="form-text"></small>

            <!-- Client Contact 2 -->
            <label for="client_contact2">Secondary Contact Number</label>
            <div class="input-group">
                <span class="input-group-text">+91</span>
                <input type="text" id="client_contact2" name="client_contact2" placeholder="Enter secondary contact number" maxlength="13">
            </div>
            <small id="contact2_feedback" class="form-text"></small>

            <!-- Client Location -->
            <label for="client_location">Client Location <span style="color: red;">*</span></label>
            <textarea id="client_location" name="client_location" placeholder="Enter client location" rows="4" required></textarea>
            <button type="button" id="use_location">Use Current Location</button>
            <small id="location_feedback" class="form-text"></small>

            <!-- Client Status -->
            <label for="client_status">Client Status <span style="color: red;">*</span></label>
            <select id="client_status" name="client_status" required>
                <option value="0">Active</option>
                <option value="1">Inactive</option>
            </select>

            <!-- Email ID -->
            <label for="email">Email ID <span style="color: red;">*</span></label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com" required>

            <!-- Note to re-verify client details -->
            <p style="color: red;">NOTE: <span style="color: #000000">Please re-verify client details before adding the client.</span></p>

            <!-- Submit Button -->
            <button type="submit" class="addClientSubmit">Add Client</button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- jQuery (already included in the layout) -->
    <!-- Bootstrap JS (already included in the layout) -->
    <!-- If not included, you can add them here -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Event handler when input field loses focus
            $('#client_domain_name').on('input blur keyup', function() {
                // Remove any special characters that are not part of a typical domain name
                var domainName = $(this).val().replace(/[^a-zA-Z0-9.-]/g, '');

                // Set the cleaned domain name back into the input field
                $(this).val(domainName);

                if(domainName.length > 0) {
                    // Send AJAX request to backend
                    $.ajax({
                        url: '{{ route("check.domain") }}', // The route for the AJAX call
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            client_domain_name: domainName
                        },
                        success: function(response) {
                            if(response.exists) {
                                // Show warning if the domain already exists
                                $('#domain_name_feedback').text('This domain name already exists.')
                                                        .css('color', 'red');
                                $('.addClientSubmit').hide();
                            } else {
                                // Show success if the domain is available
                                $('#domain_name_feedback').text('Domain name is available.')
                                                        .css('color', 'green');
                                $('.addClientSubmit').show();
                            }
                        },
                        error: function() {
                            $('#domain_name_feedback').text('An error occurred. Please try again later.')
                                                    .css('color', 'red');
                        }
                    });
                } else {
                    $('#domain_name_feedback').text(''); // Clear the message if no input
                    $('.addClientSubmit').show(); // Ensure the submit button is visible if input is empty
                }
            });

            // Function to format and validate contact inputs
            function formatContactInput(contactInput, feedbackElement) {
                // On input event
                $(contactInput).on('input', function() {
                    var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters

                    // Ensure input is 10 digits max
                    if (value.length > 10) {
                        value = value.slice(0, 10);
                    }

                    // Format with space after 5 digits
                    if (value.length > 5) {
                        value = value.replace(/(\d{5})(\d{1,5})/, '$1 $2');
                    }

                    $(this).val(value); // Set formatted value back to the input

                    // Validate and show feedback
                    if (value.replace(/\s/g, '').length < 10) {
                        $(feedbackElement).text('Contact number must be exactly 10 digits').css('color', 'red');
                    } else if (value.replace(/\s/g, '').length === 10) {
                        $(feedbackElement).text('Contact number looks good').css('color', 'green');
                    } else {
                        $(feedbackElement).text('');
                    }
                });
            }

            // Apply formatting and validation to both fields
            formatContactInput('#client_contact1', '#contact1_feedback');
            formatContactInput('#client_contact2', '#contact2_feedback');

            // Function to get current location using Geolocation API
            $('#use_location').click(function() {
                // Check if browser supports Geolocation API
                if (navigator.geolocation) {
                    $('#location_feedback').text('Fetching location...').css('color', 'blue');
                    
                    // Get user's current position
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lon = position.coords.longitude;
                        
                        // Fetch location information based on coordinates (Reverse Geocoding)
                        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`, function(data) {
                            var location = data.display_name;
                            $('#client_location').val(location); // Fill the textarea with the fetched location
                            $('#location_feedback').text('Location successfully fetched!').css('color', 'green');
                        });
                        
                    }, function(error) {
                        $('#location_feedback').text('Unable to fetch location. Please allow location access.').css('color', 'red');
                    });
                } else {
                    $('#location_feedback').text('Geolocation is not supported by this browser.').css('color', 'red');
                }
            });
        });
    </script>
@endsection
