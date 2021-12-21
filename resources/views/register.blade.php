<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form class="mb-4" action="/register" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="email" name="email" placeholder="Email">
        <input class="form-control" type="password" name="password" placeholder="Password">
        <input class="form-control" type="text" name="fullname" placeholder="Full Name">
        <input class="btn btn-primary mt-3" type="submit" value="Register">
    </form>
    <a href="/login">Already have an account?</a>
</body>
</html>
