<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Email Verification | Purple Admin</title>
    <x-admin.block.style />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">

                            <!-- Logo -->
                            <div class="brand-logo text-center mb-4">
                                <img src="{{ asset('admin/dist/assets/images/logo.svg') }}" alt="logo">
                            </div>

                            <h4 class="text-center mb-2">Verify Your Email</h4>
                            <p class="text-center text-muted mb-4">
                                Thanks for signing up! Please verify your email address to continue.
                            </p>

                            <div class="alert alert-info text-center">
                                We have sent a verification link to your email address.
                                <br>
                                Please check your inbox (and spam folder).
                            </div>

                            <form method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <div class="mt-4 d-grid gap-2">
                                    <button type="submit"
                                        class="btn btn-gradient-primary btn-lg font-weight-medium">
                                        Resend Verification Email
                                    </button>
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

    <x-admin.block.script />
</body>

</html>
