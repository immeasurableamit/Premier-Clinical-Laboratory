<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('Title') | {{ config('app.name') }}</title>
    <!-- plugins:css -->
    @include('web.layout.partials.head');
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('web.layout.partials.navbar.nav')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('web.layout.partials.navbar.sidebar')
            <!-- partial -->
            <div class="main-panel">

                @yield('main')

                <!-- content-wrapper ends -->

                <!-- partial:partials/_footer.html -->
                @include('web.layout.partials.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('web.layout.partials.foot')

    <!-- End custom js for this page-->
</body>

<style>
    .mydata-table a {
    vertical-align: middle !important;
}
</style>

</html>
