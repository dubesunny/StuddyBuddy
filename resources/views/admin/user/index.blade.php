<x-admin.master>
    <x-admin.header :breadcrumbs="$breadcrumbs" />
    <div class="row align-items-center mb-3">
        <!-- Left: Add User -->
        <div class="col-md-4">
            @can('view_user')
                <button class="btn btn-primary openCanvas" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">
                    Add USER
                </button>
            @endcan
        </div>

        <!-- Right: Filter -->
        <div class="col-md-8">
            <div class="d-flex justify-content-end align-items-center gap-2">
                <select name="role" id="filter-role" class="form-select select-lg select2 datatable-filter"
                    style="width: 220px;">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
                    @endforeach
                </select>
                <select name="status" id="filter-status" class="form-select select-lg select2 datatable-filter"
                    style="width: 220px;">
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button class="btn btn-danger d-none" id="clear">
                    Clear
                </button>
            </div>
        </div>
    </div>


    <div class="card my-2">
        <div class="card-body table-responsive">
            {{ $dataTable->table() }}
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

                let parsleyForm = form.parsley();
                if (!parsleyForm.validate()) {
                    return false;
                }

                let formdata = new FormData(form[0]);

                let status = $('#status').is(':checked') ? 'active' : 'inactive';
                formdata.append('status', status);

                if (formType === 'edit') {
                    let id = $('#id').val();
                    url = "{{ route('users.update', ':id') }}".replace(':id', id);
                    formdata.append('_method', 'PUT');
                } else {
                    url = "{{ route('users.store') }}";
                }

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showToast({
                            type: 'success',
                            title: 'Success',
                            message: response.message
                        });
                        closeCanvas();
                        refreshTable();
                    },
                    error: function(response) {
                        $('.err-class').html('');

                        if (response.status === 422) {
                            $.each(response.responseJSON.errors, function(field, message) {
                                $('#err-' + field.replace('.', '')).html(message[0]);
                            });
                        }

                        if (response.status === 500) {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: response.error
                            });
                        }
                    }
                });
            });


            const editHandler = (url) => {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        showCanvas('Edit User', response);
                        $('.dropify').dropify();
                    }
                })
            }

            $(document).on('click', '.password-toggle', function() {
                const input = $(this).closest('.input-group').find('input');
                const icon = $(this).find('i');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('mdi-eye').addClass('mdi-eye-off');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('mdi-eye-off').addClass('mdi-eye');
                }
            });

            const deleteHandler = (url) => {
                swalConfirm({
                    title: 'Are you sure you want to delete this user?',
                    text: 'This action cannot be reverted',
                    confirmButtonText: 'Yes, Delete!',
                    cancelButtonText: 'Cancel'
                }, () => {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        success: function(response) {
                            showToast({
                                type: 'success',
                                title: 'Success',
                                message: response.message
                            });
                            refreshTable();
                        },
                        error: function(xhr) {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: xhr.responseJSON?.message ?? 'Something went wrong'
                            });
                        }
                    });
                });
            };
        </script>
    @endpush
</x-admin.master>
