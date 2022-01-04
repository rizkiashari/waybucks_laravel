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
  <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
    <div>
        @if (count($products) > 0)
          <h1 class="md:mb-16 mb-12 font-extrabold md:text-[36px] sm:text-[24px] text-[16px] text-[#BD0707]">Product</h1>
          <div class="flex md:gap-9 sm:gap-6 gap-4 mb-4 md:mb-8 flex-wrap">
              @foreach ($products as $product)
                <form class="mb-5" action="{{url('deleteproduct/'.$product->id)}}" method="POST">
                  @method('DELETE')
                  @csrf
                  <div class="rounded-t-[8px] relative bg-[#F6DADA]">
                    <div class="before:absolute before:top-0 before:bottom-0 before:right-0 before:left-0 before:bg-[#3d3d3d33] before:rounded-t-[8px] ">
                        <img class="w-[250px] object-cover" src="<?php echo asset("storage/images/$product->photo_product") ?>" />
                    </div>
                    <h3 class="text-[#bf0707] md:text-[18px] font-bold text-[12px] sm:text-[16px] px-4 py-2">{{ $product->name_product }}</h3>
                    <p class="text-[#974A4A] px-4 pb-2 md:text-[14px] sm:text-[12px] text-[10px]">{{ $product->price_product }}</p>
                  </div>
                  <div class="inline-flex w-full">
                    <button type="submit" class="w-[50%] bg-[#fff] border-[#974A4A] rounded-bl-lg border-[1px] text-[14px] text-[#111545] font-medium py-2 px-3">Delete</button>
                    <a href="{{url('updateproduct/'.$product->id)}}" class="w-[50%] rounded-br-lg bg-[#974A4A] text-center text-[14px] text-[#fff] font-medium py-2 px-3">Update</a>
                  </div>         
              </form>
            @endforeach
          </div>
        @else
            <p class="capitalize md:text-[32px] text-[14px] font-semibold">Product Not found</p>
        @endif
    </div>
    <a href="{{url('addproduct')}}" style="-webkit-tap-highlight-color: rgba(0,0,0,0);" class="transition-[0.3s] fixed bottom-4 md:right-32 sm:right-8 right-4">
      <svg class="h-14 w-14 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
        <path stroke="none" d="M0 0h24v24H0z"/>
        <circle cx="12" cy="12" r="9" />  
        <line x1="9" y1="12" x2="15" y2="12" />  
        <line x1="12" y1="9" x2="12" y2="15" />
      </svg>
    </a>
  </div>
@endsection