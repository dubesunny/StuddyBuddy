@stack('up-script')
<script src="{{ asset('admin/dist/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/data-table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/data-table/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/data-table/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/dropify/dist/js/dropify.min.js') }}"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('admin/dist/assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('admin/dist/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('admin/dist/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('admin/dist/assets/js/misc.js') }}"></script>
<script src="{{ asset('admin/dist/assets/js/settings.js') }}"></script>
<script src="{{ asset('admin/dist/assets/js/todolist.js') }}"></script>
<script src="{{ asset('admin/dist/assets/js/jquery.cookie.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('admin/dist/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('admin/custom.js')}}"></script>
<!-- End custom js for this page -->
@stack('script')
