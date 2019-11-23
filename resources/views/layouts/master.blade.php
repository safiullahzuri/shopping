<html>

<head>
<script src="{{ asset('js/jquery.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body>
@include('includes.partials.header')
<div class="container">
    @yield('content')
</div>

</body>

</html>
 