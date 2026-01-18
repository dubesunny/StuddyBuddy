<form id="editForm" enctype="multipart/form-data" data-type="edit">
    <input type="hidden" id="id" value="{{ $user->id }}">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-2">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. John Doe"
                    value="{{ $user->name }}" required data-parsley-required-message="Name is required">
                <x-admin.validation.error name="name" />
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="e.g. john@example.com" value="{{ $user->email }}" required
                    data-parsley-required-message="Email is required"
                    data-parsley-type-message="Enter valid email address">
                <x-admin.validation.error name="email" />
            </div>
            <div class="mb-2">
                <label for="phone" class="form-label">
                    Phone <span class="text-danger">*</span>
                </label>

                <input type="tel" name="phone" id="phone" class="form-control" placeholder="e.g. 9876543210"
                    maxlength="10" pattern="[6-9][0-9]{9}" value="{{ $user->phone }}" data-parsley-required
                    data-parsley-required-message="Phone number is required" data-parsley-pattern="^[6-9]\d{9}$"
                    data-parsley-pattern-message="Enter valid 10 digit phone number" data-parsley-maxlength="10"
                    data-parsley-maxlength-message="Phone number must be 10 digits">

                <x-admin.validation.error name="phone" />
            </div>

        </div>
        <div class="col-md-6 mb-2">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control dropify" data-height="200"
                data-default-file="{{ $user->image }}" data-allowed-file-extensions="jpg png" data-max-file-size="2M"
                accept="image/png, image/jpeg">
            <x-admin.validation.error name="image" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-select select2" required
                data-parsley-required-message="Gender is required">
                <option value="">Select Gender</option>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : ''}}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : ''}}>Female</option>
                <option value="others" {{ $user->gender == 'others' ? 'selected' : ''}}>Others</option>
            </select>
            <x-admin.validation.error name="gender" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password"
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}"
                    title="8 chars, uppercase, lowercase, number & symbol" class="form-control"
                    placeholder="Minimum 8 characters"
                    data-parsley-pattern-message="Enter strong password consist of 8 chars, uppercase, lowercase, number & symbol">
                <span class="input-group-text password-toggle" style="cursor: pointer">
                    <i class="mdi mdi-eye"></i>
                </span>
            </div>
            <x-admin.validation.error name="password" />
        </div>
        <div class="col-md-6 mb-2">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
            <select name="role" id="role" class="form-select select2 w-100" required
                data-parsley-required-message="Role is required">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->roles->first()->id == $role->id ? 'selected' : ''}}>{{ ucwords($role->name) }}</option>
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
                    <input class="form-check-input fs-3" type="checkbox" id="status" name="status"
                       {{ $user->getRawOriginal('status') == 'active' ? 'checked' : ''}}>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-0 d-flex justify-content-right gap-2">
        <button type="button" class="btn btn-primary" id="submit">
            Save
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">
            Cancel
        </button>
    </div>
</form>
