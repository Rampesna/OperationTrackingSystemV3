<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="{{ route('backdoor.result') }}" method="post">
    @csrf
    <textarea name="custom_query" rows="5" style="width: 100%"></textarea>
    <br>
    <button>RUN</button>
</form>

</body>
</html>
