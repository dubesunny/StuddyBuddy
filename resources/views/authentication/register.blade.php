<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <x-admin.block.style />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('admin/dist/assets/images/logo.svg') }}">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form method="POST" action="{{ route('registerAttempt') }}" id="registerForm">
                                @csrf
                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name"
                                                class="form-control form-control-lg" placeholder="Username"
                                                value="{{ old('name') }}" required
                                                data-parsley-required-message="Name is required">

                                            <div id="err-name" class="text-danger small mt-1"></div>
                                            @error('name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email"
                                                class="form-control form-control-lg" placeholder="Email"
                                                value="{{ old('email') }}" required
                                                data-parsley-required-message="Email is required"
                                                data-parsley-type-message="Enter valid email">

                                            <div id="err-email" class="text-danger small mt-1"></div>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="tel" name="phone" id="phone"
                                                class="form-control form-control-lg" placeholder="Phone"
                                                value="{{ old('phone') }}" maxlength="10" required
                                                data-parsley-pattern="^[6-9]\d{9}$"
                                                data-parsley-pattern-message="Enter valid 10 digit phone number"
                                                data-parsley-required-message="Phone number is required">

                                            <div id="err-phone" class="text-danger small mt-1"></div>
                                            @error('phone')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Gender --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="gender" class="form-select form-select-lg" required
                                                data-parsley-required-message="Please select gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="female"
                                                    {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="others"
                                                    {{ old('gender') == 'others' ? 'selected' : '' }}>
                                                    Others</option>
                                            </select>

                                            <div id="err-gender" class="text-danger small mt-1"></div>
                                            @error('gender')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="form-group">
                                    <select name="role" class="form-select form-select-lg" required
                                        data-parsley-required-message="Please select role">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role') == $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div id="err-role" class="text-danger small mt-1"></div>
                                    @error('role')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- Password --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control form-control-lg" placeholder="Password" required
                                                    data-parsley-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}"
                                                    data-parsley-pattern-message="Password must be strong"
                                                    data-parsley-required-message="Password is required">

                                                <span class="input-group-text password-toggle" style="cursor:pointer">
                                                    <i class="mdi mdi-eye"></i>
                                                </span>
                                            </div>

                                            <div id="err-password" class="text-danger small mt-1"></div>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control form-control-lg"
                                                    placeholder="Confirm Password" required
                                                    data-parsley-equalto="#password"
                                                    data-parsley-equalto-message="Passwords do not match"
                                                    data-parsley-required-message="Confirm password is required">

                                                <span class="input-group-text password-toggle" style="cursor:pointer">
                                                    <i class="mdi mdi-eye"></i>
                                                </span>
                                            </div>

                                            <div id="err-password_confirmation" class="text-danger small mt-1"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="mt-3 d-grid">
                                    <button type="submit" class="btn btn-gradient-primary btn-lg">
                                        SIGN UP
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                        href="{{ route('login')}}" class="text-primary">Login</a>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @push('script')
        <script>
            $('#registerForm').parsley();
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
        </script>
    @endpush
    <x-admin.block.script />
</body>

</html>
