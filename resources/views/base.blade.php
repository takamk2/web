<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script>
        window.Laravel = window.Laravel || {};
        {{--window.Laravel.csrfToken = "{{ csrf_token() }}";--}}
    </script>
</head>
<body>
<div id="app">
@yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
