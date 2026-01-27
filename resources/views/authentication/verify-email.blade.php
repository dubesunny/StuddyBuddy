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
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    Before proceeding, please check your email for a verification link. If you did not receive the
                    email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary p-0 m-0 align-baseline">click here to request
                            another</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-admin.block.script />
</body>

</html>
