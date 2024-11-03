<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Student - Welcome Web Works</title>
    
    <!-- Meta Description -->
    <meta name="description" content="Add new student details at Welcome Web Works for comprehensive training programs.">
    <meta name="keywords" content="Welcome Web Works, add student, student form, student details, IT training">
    <meta name="author" content="Welcome Web Works">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
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
        .join_note {
            font-size: 0.8rem;
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

        input, textarea {
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
        /* Consistent spacing between form elements */
        .inputs label, .inputs select, .inputs input, .inputs textarea, .inputs .input-group {
            margin-bottom: 20px; /* Adjust this value as needed for desired spacing */
        }

        /* Inline alignment for the contact number field */
        .input-group {
            display: flex;
            align-items: center;
            flex-wrap: inherit
        }

        .input-group-text {
            border: none;
            background: #ecf0f3;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            border-radius: 50px 0 0 50px;
            padding: 10px; /* Adjust padding for better alignment */
        }

        .input-group input[type="text"] {
            flex-grow: 1; /* Ensures input takes up remaining space */
            margin: 0; /* Remove margin for better alignment */
            border-radius: 0 50px 50px 0; /* Match the input with the input group text */
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">THE SCHOOL OF Welcome Web Works</div>

        <div class="form-title">Add New Student Form</div>
        <!-- Note to re-verify student details -->
        <p style="color: red;">NOTE 1: <span class="join_note" style="color: #000000">Only for <b>TELUGU STUDENTS</b>.<br>Currently, we are only accepting students who speak Telugu.</span></p>
        <p style="color: red;">NOTE 2: <span class="join_note" style="color: #000000">This is serious training for students who genuinely seek jobs and come from financially disadvantaged backgrounds. If you're planning to go abroad or are involved in a family business, please reconsider and allow others to take this opportunity. We are only accepting <b>30</b> dedicated students.</span></p>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form class="inputs" action="{{ route('addStudent') }}" method="POST">
                @csrf

                <!-- Student College Name -->
                <label for="student_college_name">Student College Name <span style="color: red;">*</span></label>
                <input type="text" id="student_college_name" name="student_college_name" placeholder="Enter college name" required>

                <!-- Student Name -->
                <label for="student_name">Student Name <span style="color: red;">*</span></label>
                <input type="text" id="student_name" name="student_name" placeholder="Enter student name" required>

                <!-- Student Gender -->
                <label for="student_gender">Student Gender <span style="color: red;">*</span></label>
                <select id="student_gender" name="student_gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <!-- Student Personal Email -->
                <label for="student_email">Student Personal Email <span style="color: red;">*</span></label>
                <input type="email" id="student_email" name="student_email" placeholder="example@gmail.com" required>
                <small id="email_feedback" class="form-text"></small><br>

                <!-- Student Department -->
                <label for="student_department">Student Department & Year <span style="color: red;">*</span></label>
                <input type="text" id="student_department" name="student_department" placeholder="Enter department $ Year (e.g., ECE 3Year , IT 4Year, CSE 3Year)" required oninput="this.value = this.value.toUpperCase();">

                <!-- Student CGPA -->
                <label for="student_cgpa">Student CGPA <span style="color: red;">*</span></label>
                <input type="number" id="student_cgpa" name="student_cgpa" placeholder="Enter CGPA" step="0.1" min="6.5" max="8.5" required>
                <small class="form-text" style="color: #555;">Note: Only CGPA between 6.5 to 8.5 will be considered.</small><br>

                <!-- Student Native Location -->
                <label for="student_native_location">Student Native Location <span style="color: red;">*</span></label>
                <textarea id="student_native_location" name="student_native_location" placeholder="Enter native location (ie. Guntur, Hyderabad etc...)" rows="4" required></textarea>

                <!-- Student Contact Number -->
                <label for="student_contact">Student Contact Number <span style="color: red;">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">+91</span>
                    <input type="text" id="student_contact" name="student_contact" placeholder="Enter contact number" required maxlength="13">
                </div>
                <small id="contact_feedback" class="form-text"></small><br>

                <!-- Student Father Occupation -->
                <label for="father_occupation">Student Father Occupation</label>
                <input type="text" id="father_occupation" name="father_occupation" placeholder="Enter father occupation (optional)">

                <!-- Note to re-verify student details -->
                <p style="color: red;">NOTE: <span style="color: #000000">Please re-verify student details before adding the student.</span></p>

                <!-- Submit Button -->
                <button type="submit" class="addStudentSubmit">Submit</button>
            </form>
        @endif
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Event handler for validating student email
            $('#student_email').on('input blur keyup', function() {
                var studentEmail = $(this).val();

                if (studentEmail.length > 0) {
                    // Send AJAX request to backend to validate email
                    $.ajax({
                        url: '{{ route("check.email") }}', // The route for the AJAX call
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            student_email: studentEmail
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#email_feedback').text('This email already exists, You have already submited the form.').css('color', 'red');
                                $('.addStudentSubmit').hide();
                            } else {
                                $('#email_feedback').text('Email is available.').css('color', 'green');
                                $('.addStudentSubmit').show();
                            }
                        },
                        error: function() {
                            $('#email_feedback').text('An error occurred. Please try again later.').css('color', 'red');
                        }
                    });
                } else {
                    $('#email_feedback').text('');
                    $('.addStudentSubmit').show();
                }
            });

            // Function to format and validate contact input
            function formatContactInput(contactInput, feedbackElement) {
                $(contactInput).on('input', function() {
                    var value = $(this).val().replace(/\D/g, '');

                    if (value.length > 10) {
                        value = value.slice(0, 10);
                    }

                    if (value.length > 5) {
                        value = value.replace(/(\d{5})(\d{1,5})/, '$1 $2');
                    }

                    $(this).val(value);

                    if (value.replace(/\s/g, '').length < 10) {
                        $(feedbackElement).text('Contact number must be exactly 10 digits').css('color', 'red');
                    } else if (value.replace(/\s/g, '').length === 10) {
                        $(feedbackElement).text('Contact number looks good').css('color', 'green');
                    } else {
                        $(feedbackElement).text('');
                    }
                });
            }

            formatContactInput('#student_contact', '#contact_feedback');
        });
    </script>
</body>

</html>
