<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    {{$meta}}
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('public/admin/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('public/admin/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('public/admin/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('public/admin/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="d-none" id="loader" style="width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center; position: absolute; z-index: 999;background: #0000002e">
        <div style="width: 200px; height: 200px;">
            <img src="{{ asset('public/admin/img/loader.gif') }}" alt="" style="width: 100%; height: 100%;">
        </div>
    </div>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center">
                <a href="{{route('admin.dashboard')}}" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('public/admin/img/logo.png')}}" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">{{$cardTitle}}</h5>
                    <p class="text-center small">{{$cardText}}</p>
                  </div>

                  {{$form}}
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->


  <!-- Vendor JS Files -->
  <script src="{{ asset('public/admin/js/ajax.js')}}"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  {{$js}}
</body>

</html>
