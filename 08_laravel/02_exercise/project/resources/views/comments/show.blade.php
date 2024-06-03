<html>
<head>
    <title>Comments</title>
</head>
<body>
    <h1>Comments</h1>
    <div>
    @foreach($comments as $comment)
        <h1>{{$comment->title}}</h1>
        <p>{{$comment->text}}</p>
    @endforeach
    </div>
</body>
</html>
