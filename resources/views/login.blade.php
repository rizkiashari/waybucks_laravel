@extends('layout.main')

@section('content')
<form class="mb-4" action="/login" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-6">
    <input class="form-control" type="email" name="email" placeholder="Email">
    @error('email')
    <label class="block text-red">{{ $message }}</label>
    @enderror
    </div>
    <div class="mb-6">
    <input class="form-control" type="password" name="password" placeholder="Password">
    @error('password')
    <label class="block text-red">{{ $message }}</label>
    @enderror
    </div>
    <div class="mb-6">
    <input class="bg-red" type="submit" value="Login">
    </div>
    @error('auth')
    <label class="block text-red">{{ $message }}</label>
    @enderror
</form>
<a href="/register">Don't have an account?</a>
@endsection
