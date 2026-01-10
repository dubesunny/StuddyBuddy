<x-admin.master>
    <x-admin.header :breadcrumbs="$breadcrumbs" />
    <button class="btn btn-primary openCanvas" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">ADD USER</button>
    <div class="card my-2">
        <div class="card-body">
            <div class="table-responsive">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
    @push('script')
        {{ $dataTable->scripts() }}

        <script>
            $(document).on('click', '.openCanvas', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('users.create') }}",
                    success: function(response) {
                        showCanvas('Add User', response);
                        $('.dropify').dropify();
                    }
                })
            })

            $(document).on('click', '#submit', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let formType = form.data('type');
                let url;
                let type;
                let formdata;
                if (formType === 'add') {
                    type = 'POST';
                    url = "{{ route('users.store') }}";
                    form = $('#addForm');
                    formdata = new FormData(form[0]);
                }

                $.ajax({
                    type: type,
                    url: url,
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showMessage(response.message, 'success');
                        closeCanvas();
                        refreshTable();
                    },
                    error: function(response) {

                        $('.err-class').html('');
                        $('.is-invalid').removeClass('is-invalid');

                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;

                            $.each(errors, function(field, message) {
                                $('#' + field.replace('.', '')).addClass('is-invalid');
                                $('#err-' + field.replace('.', '')).html(message[0]);
                            });
                        }

                        if (response.status === 500) {
                            showMessage(response.error, 'error');
                        }
                    }
                });
            });
        </script>
    @endpush
</x-admin.master>
