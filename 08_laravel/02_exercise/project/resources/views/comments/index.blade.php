<html>
<head>
    <title>Comments</title>
</head>
<body>
    <h1>Comments</h1>
    <div>
    @foreach($comments as $comment)
        <a href="{{route("comments.show", $comment)}}">{{$comment->title}}</a>
    @endforeach
    </div>
</body>
</html>
