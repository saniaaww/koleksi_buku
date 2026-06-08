<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.header')
    @yield('style-page')
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>
<div class="container-scroller">

    @include('components.navbar')

    <div class="container-fluid page-body-wrapper">

        @include('components.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>

            @include('components.footer')
        </div>

    </div>
</div>

@include('components.script')
@yield('script-page')
 @yield('scripts')
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>