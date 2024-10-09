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

    fieldset {
            border: 2px solid #007BFF;
            border-radius: 10px;
            padding: 20px;
            position: relative;
        }

    legend {
        font-size: 1.5rem;
        font-weight: bold;
        color: #007BFF;
        padding: 0 10px;
        width: auto;
        text-align: center;
    }
    .forgot-password {
            margin-top: 10px;
            text-align: right;
    }
    .forgot-password a {
        font-size: 0.9rem;
        color: #1DA1F2;
        text-decoration: none;
    }
    .forgot-password a:hover {
        text-decoration: underline;
    }

</style>
</head>
<body>

    <!-- Outer Container -->
    <div class="container mt-5">
        <!-- Row for Create and Edit Forms -->
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>

            <!-- Create User Form -->
                <div class="form-title">Admin Login</div>

                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="forgot-password">
                        <a href="{{ route('password.custom.reset.form') }}">Forgot your password?</a>
                    </div>

                    <button type="submit">Login</button>
                </form>
    </div>
</body>
</html>