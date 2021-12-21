<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form class="mb-4" action="/login" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="email" name="email" placeholder="Email">
        @error('email')
        <label class="alert alert-danger">{{ $message }}</label>
        @enderror
        <input class="form-control" type="password" name="password" placeholder="Password">
        @error('password')
        <label class="alert alert-danger">{{ $message }}</label>
        @enderror
        <input class="btn btn-primary mt-3" type="submit" value="Login">
        @error('auth')
        <label class="alert alert-danger">{{ $message }}</label>
        @enderror
    </form>
    <a href="/register">Don't have an account?</a>
</body>
</html>
