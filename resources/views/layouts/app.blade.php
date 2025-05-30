<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    @yield('style')



    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{-- lien select 2 --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- @vite('resources/css/app.css') --}}
                                                        <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

</head>

<body>

    <div class="loader-overlay" id="loader">
        <div class="loader-spinner"></div>
    </div>

  <!-- ======= Header ======= -->

  @include('layouts.partials.header')


  <!-- ======= Sidebar ======= -->

  @include('layouts.partials.Sidebar')


  <main id="main" class="main">



    <section class="section">






        @include('layouts.partials.header-content')

        <br>


        @include('layouts.partials.message')

        @yield('voidgrubs')

        @yield('content')


    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

  @include('layouts.partials.footer')


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- js pour datatable --}}

  @yield('scripts')

  {{-- script pour select 2 --}}

  @yield('select')

    <script>
     $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
        placeholder: "Sélectionnez un ou plusieurs équipements",
        allowClear: true
      });
    });
    </script>


                    {{-- SCRIPT POUR LE TOAST --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, { autohide: true, delay: 5000 }) // 5 secondes
            })
            toastList.forEach(toast => toast.show());
        });
    </script>

    {{-- Code pour la sidebar active --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        let links = document.querySelectorAll(".sidebar-nav .nav-content a");

        let currentUrl = window.location.href;

        links.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("active");

                let parentMenu = link.closest(".nav-content");
                if (parentMenu) {
                    parentMenu.classList.add("show");
                    let parentToggle = document.querySelector(`[data-bs-target="#${parentMenu.id}"]`);
                    if (parentToggle) {
                        parentToggle.classList.remove("collapsed");
                    }
                }
                localStorage.setItem("activeLink", link.href);
            }
        });

        let savedActiveLink = localStorage.getItem("activeLink");
        if (savedActiveLink) {
            links.forEach(link => {
                if (link.href === savedActiveLink) {
                        link.classList.add("active");
                        let parentMenu = link.closest(".nav-content");
                        if (parentMenu) {
                            parentMenu.classList.add("show");
                            let parentToggle = document.querySelector(`[data-bs-target="#${parentMenu.id}"]`);
                            if (parentToggle) {
                                parentToggle.classList.remove("collapsed");
                            }
                        }
                    }
                });
            }
        });

    </script>

    {{-- script pour mon loader --}}

    <script>
        window.addEventListener('load', function () {
            const loader = document.getElementById('loader');
            if (loader) {
            loader.style.display = 'none';
            }
        });
    </script>





</body>

</html>
