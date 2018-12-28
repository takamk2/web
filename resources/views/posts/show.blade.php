<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $post->title }}</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{!! $post->body !!}</p>
</div>
</body>
</html>
