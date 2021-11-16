<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    Home
    <h1>{{auth()->user()->name}}</h1>
    <pre>
        {{json_encode($data, JSON_PRETTY_PRINT)}}
    </pre>
    <a href="{{ url('auth/logout') }}" style="margin-top: 0 !important;background: green;color: #ffffff;padding: 5px;border-radius:7px;" class="ml-2">
        <strong>Logout</strong>
    </a>
</body>
</html>
