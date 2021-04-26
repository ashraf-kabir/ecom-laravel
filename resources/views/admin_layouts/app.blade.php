<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('admin_title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="css/themify-icons.css">
  <link rel="stylesheet" href="css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/logo_2H_tech.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

      {{-- start admin topnavbar --}}
      @include('admin_include.topnavbar')
      {{-- start admin topnavbar --}}


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      
        {{-- start admin leftsidebar --}}
        @include('admin_include.leftsidebar')
        {{-- start admin leftsidebar --}}

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">



          {{-- start content --}}
          @yield('admin_content')
          {{-- end content --}}



        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        {{-- start admin footer --}}
        @include('admin_include.footer')
        {{-- end admin footer --}}

        <!-- partial -->
        </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

<!-- plugins:js -->
<script src="js/vendor.bundle.base.js"></script>
<script src="js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/dashboard.js"></script>
<!-- End custom js for this page-->
</body>

</html>

