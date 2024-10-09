@extends('layouts.app')

@section('title', 'Client Menu Price Details')

@section('head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">
    <!-- Select2 CSS -->
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

        input,
        button {
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

        /* Additional styles for the Select2 dropdowns */
        .select2-container .select2-selection--single {
            height: 50px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 50px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 50px !important;
        }

        .form-group label {
            font-weight: bold;
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

        /* Adjusting the width of the select boxes */
        #clientSelect, #menuSelect {
            width: 300px !important;
        }

        /* Container for dropdowns */
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-container .form-group {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="brand-logo"></div>
        <div class="brand-title">Welcome Web Works</div>

        <div class="form-title">Client Menu Price Details</div>

        <!-- Filter Dropdowns -->
        <div class="filter-container">
            <!-- Client Select Dropdown -->
            <div class="form-group">
                <label for="clientSelect">Select Client Domain Name:</label>
                <select id="clientSelect" class="form-control client-select">
                    <option value="">Select Client</option>
                    @php
                        $uniqueClients = $menuPriceDetails->unique('client_domain_name');
                    @endphp
                    @foreach($uniqueClients as $menuPriceDetail)
                        <option value="{{ $menuPriceDetail->client_domain_name }}">{{ $menuPriceDetail->client_domain_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Menu Select Dropdown -->
            <div class="form-group">
                <label for="menuSelect">Select Menu Name:</label>
                <select id="menuSelect" class="form-control menu-select">
                    <option value="">Select Menu</option>
                    @php
                        $uniqueMenus = $menuPriceDetails->unique('menu_name');
                    @endphp
                    @foreach($uniqueMenus as $menuPriceDetail)
                        <option value="{{ $menuPriceDetail->menu_name }}">{{ $menuPriceDetail->menu_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Table to Display Data -->
        <div class="table-responsive">
            <table id="menuPriceTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Menu Price ID</th>
                        <th>Client Domain Name</th>
                        <th>Menu Name</th>
                        <th>Menu Price</th>
                        <th>Client Created Date</th>
                        <th>Client Last Updated Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuPriceDetails as $menuPriceDetail)
                    <tr>
                        <td>{{ $menuPriceDetail->id }}</td>
                        <td>{{ $menuPriceDetail->client_domain_name }}</td>
                        <td>{{ $menuPriceDetail->menu_name }}</td>
                        <td>{{ $menuPriceDetail->menu_price }}</td>
                        <td>{{ \Carbon\Carbon::parse($menuPriceDetail->created_at)->format('d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($menuPriceDetail->updated_at)->format('d F Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- jQuery (Include only once) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Initialize DataTable and Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize Select2 for dropdowns
            $('.client-select').select2({
                placeholder: "Select Client",
                allowClear: true
            });

            $('.menu-select').select2({
                placeholder: "Select Menu",
                allowClear: true
            });

            // Initialize DataTable
            var table = $('#menuPriceTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            // Client Domain Name Filter
            $('#clientSelect').on('change', function() {
                var selectedClient = $(this).val();
                table.column(1).search(selectedClient).draw();
            });

            // Menu Name Filter
            $('#menuSelect').on('change', function() {
                var selectedMenu = $(this).val();
                table.column(2).search(selectedMenu).draw();
            });
        });
    </script>
@endsection
