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
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('admin/dist/assets/images/logo.svg') }}">
                            </div>
                            <h4>Reset Password</h4>
                            <form action="{{route('resetPassword')}}" class="pt-3" method="POST" id="resetPassword">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email"
                                        id="email" placeholder="Email" required
                                        data-parsley-required-message="Email is required"
                                        data-parsley-type-message="Enter valid email">
                                    <div id="err-email" class="text-danger small mt-1"></div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control form-control-lg" placeholder="Confirm Password" required
                                            data-parsley-equalto="#password"
                                            data-parsley-equalto-message="Passwords do not match"
                                            data-parsley-required-message="Confirm password is required">

                                        <span class="input-group-text password-toggle" style="cursor:pointer">
                                            <i class="mdi mdi-eye"></i>
                                        </span>
                                    </div>

                                    <div id="err-password_confirmation" class="text-danger small mt-1"></div>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Send
                                        Reset Link</a>
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
    <!-- container-scroller -->
    @push('script')
        <script>
            $('#resetPassword').parsley();
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
