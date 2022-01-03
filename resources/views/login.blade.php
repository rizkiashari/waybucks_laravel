@extends('layout.main')

@section('content')
    @if ($errors->any())
        <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}" x-open="open" x-init="setTimeout(() => open = false, 3000)"  role="alert">
        <div class="bg-[#f8d7da] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
            <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <div class="flex flex-col ml-4">
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">There were {{ count($errors) }} errors with your submission</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                <li class="text-[10px] sm:text-[12px] md:text-[16px]">{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        </div>
        </div>
    @endif
    @if (session()->has('error'))
    <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  x-open="open" x-init="setTimeout(() => open = false, 2500)" role="alert">
      <div class="bg-[#f8d7da] z-[99] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
        <span class="absolute left-0 top-0 px-4 py-3">
          <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
        <div class="flex flex-col ml-4">
          <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('error') }}</strong>
        </div>
      </div>
    </div>
    @endif
    @if (session()->has('success'))
        <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  x-open="open" x-init="setTimeout(() => open = false, 2500)" role="alert">
            <div class="bg-[#d1e7dd] z-[99] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#badbcc] text-[#0f5132] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
                <span class="absolute left-0 top-0 px-4 py-3">
                <svg @click="open = !open" class="fill-current h-6 w-6 text-[#539b7b]" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
                <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('success') }}</strong>
            </div>
        </div>
    @endif
    <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:justify-between md:px-6 lg:px-8">
        <p class="capitalize md:text-[32px] text-[14px] font-semibold mb-8 text-[#BD0707]">Login</p>
        <form class="mb-4" action="/login" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="w-full mb-4">
                <input class="border-[2px] border-[#BD0707] w-full hover:border-[#a31b1b] py-1 text-[#BD0707] font-bold px-8 rounded-md text-sm" type="email" name="email" placeholder="Email">
            </div>
            <div class="w-full mb-4">
                <input class="border-[2px] border-[#BD0707] w-full hover:border-[#a31b1b] py-1 text-[#BD0707] font-bold px-8 rounded-md text-sm" type="password" name="password" placeholder="Password">
            </div>
            <div class="w-full mb-4">
                <input class="px-6 md:px-[26px] py-[5px] w-full text-sm bg-[#BD0707] text-[#f2f2f2] font-bold rounded-md hover:bg-[#910707]" type="submit" value="Login">
            </div>
            @error('auth')
                <label class="block text-red">{{ $message }}</label>
            @enderror
        </form>
        <a href="/register">Don't have an account?</a>
    </div>
@endsection
