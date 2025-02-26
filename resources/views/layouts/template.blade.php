<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
  </head>
  <body id="body-pd">

    <div class="container">
        @yield('content')
    </div>

    <!------------------ SCRIPTS ------------------>
    <!-- JQuery datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- <script src="{{ asset('js/jquery.js') }}"></script> --}}
    <!-- Datatables responsive datatables -->
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css"  rel="stylesheet" />

    <!-- <script>$(document).ready(function() {
      $('#@yield('table_name')').DataTable({
          responsive:true
      });});
    </script> -->
    @yield('js-header')
    @yield('js')
  </body>

</html>