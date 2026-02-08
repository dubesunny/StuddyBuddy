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
                            <h4>Send Password ResetLink.</h4>
                            <form action="{{ route('sendPasswordResetLink')}}" class="pt-3" method="POST" id="forgetPassword">
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
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Send
                                        Reset Link</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light"><a
                                        href="{{ route('login') }}" class="text-primary">Back to login</a>
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
            $('#forgetPassword').parsley();
        </script>
    @endpush
    <x-admin.block.script />
</body>

</html>
