@extends('layouts.app')

@section('title', 'Client Menu Price Details')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Menu Price Details - Welcome Web Works</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    <!-- Add Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Add Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#menuPriceTable').DataTable({
                "paging": true,  // Enable pagination
                "lengthChange": false, // Disable changing page length
                "searching": true, // Enable searching
                "ordering": true,  // Enable column ordering
                "info": true,      // Enable showing information
                "autoWidth": false // Disable auto column width adjustment
            });
        });

        $(document).ready(function() {
        // Client Domain Name Filter
        $('#clientSelect').on('change', function() {
            var selectedClient = $(this).val().toLowerCase();
            filterTable(selectedClient, $('#menuSelect').val().toLowerCase());
        });

        // Menu Name Filter
        $('#menuSelect').on('change', function() {
            var selectedMenu = $(this).val().toLowerCase();
            filterTable($('#clientSelect').val().toLowerCase(), selectedMenu);
        });

        function filterTable(clientDomain, menuName) {
            $("#menuPriceTable tbody tr").filter(function() {
                var clientMatch = $(this).find("td:nth-child(2)").text().toLowerCase().indexOf(clientDomain) > -1 || clientDomain === "";
                var menuMatch = $(this).find("td:nth-child(3)").text().toLowerCase().indexOf(menuName) > -1 || menuName === "";
                $(this).toggle(clientMatch && menuMatch);
            });
        }
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

        <div class="form-title">Client Menu Price Details</div>

       <!-- Container to hold both dropdowns side by side with spacing and margin -->
        <div style="display: inline-flex; gap: 10px; margin-bottom: 20px;">
            <!-- Client Select Dropdown -->
            <div class="form-group" style="margin-top: 10px; margin-bottom: 10px;">
                <label for="clientSelect" style="font-weight: bold;">Select Client Domain Name:</label>
                <select id="clientSelect" class="form-control form-control-sm" style="width: 300px;">
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
            <div class="form-group" style="margin-top: 10px; margin-bottom: 10px;">
                <label for="menuSelect" style="font-weight: bold;">Select Menu Name:</label>
                <select id="menuSelect" class="form-control form-control-sm" style="width: 300px;">
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
        <table id="menuPriceTable" class="table table-striped table-bordered" style="margin-top: 20px;">
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

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
@endsection
