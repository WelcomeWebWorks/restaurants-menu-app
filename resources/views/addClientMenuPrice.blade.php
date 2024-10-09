@extends('layouts.app')

@section('title', 'Add Client Menu Price')

@section('head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- Select2 CSS for searchable dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            font-size: 1rem;
            color: #008CBA;
            letter-spacing: 1px;
            margin-bottom: 20px;
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

        input, button, select {
            display: block;
            width: 100%;
            border: none;
            outline: none;
            box-sizing: border-box;
        }

        input, select {
            background: #ecf0f3;
            padding: 10px;
            height: 50px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            margin-bottom: 10px;
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

        .menu-price-section {
            margin-top: 55px;
        }

        .remove-menu {
            color: red;
            cursor: pointer;
            margin-left: 10px;
            display: inline-block;
            margin-top: 10px;
        }

        .select2-container .select2-selection--single {
            height: 50px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 50px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 50px !important;
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

        <div class="form-title">Add Client Menu & Price Form</div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('submitClientMenuPrice') }}" method="POST">
            @csrf

            <!-- Client Dropdown -->
            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name</label>
                <select class="form-control client-select" name="client_id" required>
                    <option value="" disabled selected>Select Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Menu-Price Fields -->
            <div id="menu-container">
                <div class="menu-price-section">
                    <!-- Menu Name Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <label for="menu_name" class="form-label">Menu Name</label>
                            <select class="form-control menu-select" name="menu_id[]" required>
                                <option value="" disabled selected>Select Menu</option>
                                @foreach($menu as $menuItem)
                                    <option value="{{ $menuItem->id }}">{{ $menuItem->menu_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Set Price Row -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="menu_price" class="form-label">Set Price</label>
                            <input type="number" class="form-control" name="menu_price[]" placeholder="Enter price" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add More Menu Button -->
            <div class="mt-3">
                <button type="button" class="btn btn-primary" id="add-menu">Add Menu</button>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- jQuery (if not already included in the layout) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize Select2 for searchable dropdowns
            $('.client-select').select2({
                placeholder: "Select a client",
            });
            $('.menu-select').select2({
                placeholder: "Select a menu",
            });

            // Function to dynamically add menu-price fields
            $('#add-menu').on('click', function() {
                var menuOptions = `
                    @foreach($menu as $menuItem)
                        <option value="{{ $menuItem->id }}">{{ $menuItem->menu_name }}</option>
                    @endforeach
                `;
                
                var menuPriceSection = `
                <div class="menu-price-section">
                    <!-- Menu Name Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <label for="menu_name" class="form-label">Menu Name</label>
                            <select class="form-control menu-select" name="menu_id[]" required>
                                <option value="" disabled selected>Select Menu</option>
                                ${menuOptions}
                            </select>
                        </div>
                    </div>

                    <!-- Set Price Row -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="menu_price" class="form-label">Set Price</label>
                            <input type="number" class="form-control" name="menu_price[]" placeholder="Enter price" required>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <span class="remove-menu">Remove</span>
                    </div>
                </div>`;
                
                $('#menu-container').append(menuPriceSection);
                
                // Reinitialize select2 for new fields
                $('.menu-select').select2({
                    placeholder: "Select a menu",
                });
            });

            // Remove menu-price section
            $(document).on('click', '.remove-menu', function() {
                $(this).closest('.menu-price-section').remove();
            });
        });
    </script>
@endsection
