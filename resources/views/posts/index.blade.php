<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script>
        window.Laravel = window.Laravel || {};
        {{--window.Laravel.csrfToken = "{{ csrf_token() }}";--}}
    </script>
</head>
<body>
<div id="app">
    <posts-container/>
    {{--<h1>Blog Posts</h1>--}}
    {{--<div class="list-group">--}}
        {{--@forelse ($posts as $post)--}}
            {{--<a class="list-group-item list-group-item-action" href="{{ url('/posts', $post->id) }}">{{ $post->title }}</a>--}}
        {{--@empty--}}
            {{--<span class="list-group-item">No posts yet</span>--}}
        {{--@endforelse--}}
    {{--</div>--}}
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
