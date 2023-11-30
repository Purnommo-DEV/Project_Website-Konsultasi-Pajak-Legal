  <!-- Vendor JS Files -->

  <script src="{{ asset('Back/assets/vendors/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/form/jquery.form.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/validate/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/moment/moment.js') }}"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script src="{{ asset('Front/assets/js/jquery.elevateZoom.min.js') }}"></script>
  <script src="{{ asset('Back/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  {{-- <script src="{{ asset('Back/assets/js/bootstrap.bundle.min.js') }}"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <script src="{{ asset('Back/assets/js/pages/dashboard.js') }}"></script>

  <script src="{{ asset('Back/assets/js/main.js') }}"></script>

  <script src="{{ asset('Back/assets/vendors/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('All/js/mask/jquery.mask.min.js') }}"></script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
      CKEDITOR.replaceAll('.ckeditor');
      CKEDITOR.editorConfig = function() {
          CKEDITOR.config.removePlugins = 'Source,Save,Print,Preview,Find,About,Maximize,ShowBlocks';
          //   config.removeButtons = 'Source', 'Outdent', 'Indent', '-', 'Cut', 'Copy', 'Paste', 'PasteText',
          //       'PasteFromWord', '-', 'Maximize';
      }
  </script>

  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> --}}
  <!-- Template Main JS File -->
