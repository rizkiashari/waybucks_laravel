@extends('layout.main')

@section('content')
<form class="mb-4" action="/register" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-6">
    <input class="form-control" type="email" name="email" placeholder="Email">
    @error('email')
    <label class="block">{{ $message }}</label>
    @enderror
    </div>
    <div class="mb-6">
    <input class="form-control" type="password" name="password" placeholder="Password">
    @error('password')
    <label class="block">{{ $message }}</label>
    @enderror
    </div>
    <div class="mb-6">
    <input class="form-control" type="text" name="fullname" placeholder="Full Name">
    @error('fullname')
    <label class="block">{{ $message }}</label>
    @enderror
    </div>
    <input class="btn btn-primary mt-3" type="submit" value="Register">
</form>
<a href="/login">Already have an account?</a>
@endsection
