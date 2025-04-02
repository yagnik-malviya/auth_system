<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('public/admin/img/favicon.png')}}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('public/admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('public/admin/vendor/remixicon/remixicon.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/admin/css/style.css')}}" rel="stylesheet">

  {{-- Yajra Table --}}
 <link href="{{ asset('public/admin/css/bootstrap5.min.css')}}" rel="stylesheet">
    <style>
        .force-overflow
        {
            min-height: 450px;
        }

        #wrapper
        {
            text-align: center;
            width: 500px;
            margin: auto;
        }

        /*
        *  STYLE 1
        */

        #style-1::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar
        {
            width: 5px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #F5F5F5;
        }
        .sidebar::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        .sidebar::-webkit-scrollbar
        {
            width: 4px;
            background-color: #F5F5F5;
        }

        .sidebar::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #F5F5F5;
        }
        .btn-primary
        {
            border: #E76F25 !important;
            background-color: #E76F25 !important;
        }
        .sidebar span,
        .sidebar i
        {
            color: #E76F25 !important;
        }
        .sidebar-nav .nav-link{
            background-color: #e76f2510 !important;
        }
        .sidebar-nav .active{
            background-color: #e76f25 !important;
            color: #fff !important;
        }

        .sidebar-nav .active span,
        .sidebar-nav .active i{
            color: #000 !important;
        }
    </style>
</head>

<body>
    <div class="d-none" id="loader" style="width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center; position: fixed; z-index: 999;background: #0000002e">
        <div style="width: 200px; height: 200px;">
            <img src="{{ asset('public/admin/img/loader.gif') }}" alt="" style="width: 100%; height: 100%;">
        </div>
    </div>

    @include('admin.layout.header')

    @include('admin.layout.sidebar')

    @yield('content')

    @include('admin.layout.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('public/admin/js/ajax.js')}}"></script>
  <script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/main.js')}}"></script>

  {{-- Yajra Table --}}
  <script src="{{ asset('public/admin/js/dataTables.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/bootstrap5.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/sweetalert.js')}}"></script>

  @stack('js')

</body>

</html>
