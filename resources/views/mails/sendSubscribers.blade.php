<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>m-bianca 订阅周刊</title>
</head>
<body>
    <h1>本周最新的内容有</h1>
    @foreach($data['topics'] as $topic)
    <li><a href="https://www.m-bianca.top/topics/{{$topic->id}}">{{ $topic->title }}</a></li>
    @endforeach
</body>
</html>
