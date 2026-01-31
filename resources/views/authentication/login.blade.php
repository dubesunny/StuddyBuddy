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
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form action="{{ route('attempt-login') }}" method="POST" class="pt-3" id="loginForm">
                                @csrf
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
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted" for="remember">
                                            <input type="checkbox" name="remember" id="remember"
                                                class="form-check-input">
                                            Remember me </label>
                                    </div>
                                    <a href="{{route('forgotpassword')}}" class="auth-link text-primary float-end">Forgot password?</a>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</a>
                                </div>

                                {{-- <div class="mb-2 d-grid gap-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="mdi mdi-facebook me-2"></i>Connect using facebook </button>
                                </div> --}}
                                <div class="text-center mt-4 font-weight-light"> Don't have an account? <a
                                        href="{{ route('register') }}" class="text-primary">Create</a>
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
            $('#loginForm').parsley();
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
