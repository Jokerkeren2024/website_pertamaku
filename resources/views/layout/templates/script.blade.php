 <script src="assets/js/jquery.min.js"></script>

 <!-- Vendor JS Files -->
 <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
 <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
 <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
 <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- Template Main JS File -->
 <script src="{{ asset('assets/js/main.js') }}"></script>
 @yield('script')
 <script>
     $(document).ready(function() {
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         })
     })
 </script>
 </body>

 </html>
