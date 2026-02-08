<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <x-admin.block.style />
</head>

<body>
    <div class="container-scroller">
        <x-admin.navbar />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <x-admin.sidebar />
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    {{ $slot }}
                </div>
                <X-admin.modal/>
                <x-admin.Offcanvas />
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-admin.footer />
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <x-admin.block.script />
</body>

</html>
