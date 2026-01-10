<form id="addForm" enctype="multipart/form-data" data-type="add">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-2">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. John Doe"
                    required>
                <x-admin.validation.error name="name" />
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="e.g. john@example.com" required>
                <x-admin.validation.error name="email" />
            </div>
            <div class="mb-2">
                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="e.g. 9876543210"
                    required>
                <x-admin.validation.error name="phone" />
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control dropify" data-height="200" required>
            <x-admin.validation.error name="image" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-select select2">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>
            <x-admin.validation.error name="gender" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" id="password" class="form-control"
                placeholder="Minimum 8 characters" required>
            <x-admin.validation.error name="password" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
            <select name="role" id="role" class="form-select select2 w-100">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
                @endforeach
            </select>
            <x-admin.validation.error name="role" />
        </div>
        <div class="col-sm-6 mb-2">
            <label for="status" class="form-label">
                Status
            </label>

            <div class="d-flex align-items-center mx-5" style="height: 30px;">
                <div class="form-check form-switch mx-4">
                    <input class="form-check-input fs-3" type="checkbox" id="status" name="status" value="yes"
                        checked>
                </div>
            </div>
        </div>
    </div>
</form>
