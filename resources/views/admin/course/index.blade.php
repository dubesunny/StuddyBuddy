<x-admin.master>
    <x-admin.header :breadcrumbs="$breadcrumbs" />
    <div class="row align-items-center mb-3">
        <!-- Left: Add User -->
        <div class="col-md-4">
            @can('view_user')
                <button class="btn btn-primary" data-toggle="modal" data-target="#commonModal">
                    Add Course
                </button>
            @endcan
        </div>

        <!-- Right: Filter -->
        <div class="col-md-8">
            <div class="d-flex justify-content-end align-items-center gap-2">
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
    @endpush
</x-admin.master>
