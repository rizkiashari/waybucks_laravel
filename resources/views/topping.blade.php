@extends('layout.main')
@section('content')
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
        @if (count($toppings) > 0)
        <h1 class="md:mb-16 mb-12 font-extrabold md:text-[36px] sm:text-[24px] text-[16px] text-[#BD0707]">Topping</h1>
            <div class="flex md:gap-9 sm:gap-6 gap-4 mb-4 md:mb-8 flex-wrap">
                @foreach ($toppings as $topping)
                <form class="mb-5" 
                        action="{{url('deletetopping/'.$topping->id)}}" 
                        method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="flex w-full gap-4 md:gap-8 flex-wrap">
                        <div class="flex items-center gap-y-3 flex-col">
                          <label for="{{ $topping->id }}" class="relative cursor-pointer">
                            <img class="md:w-24 md:h-24 w-16 h-16 object-cover rounded-full" src="<?php echo asset("storage/images/$topping->photo_topping") ?>"/>
                            <input type="checkbox" value={{ $topping->price_topping }}  name="toppings[{{ $topping->id }}]" id="{{ $topping->id }}" class="absolute top-1 right-0 w-6 h-6 rounded-full appearance-none hidden checked:flex checked:bg-[#d35252] toppings" />
                          </label>
                          <label class="text-[#BD0707] text-[12px] md:text-[14px]">{{ $topping->name_topping }}</label>
                        </div>
                      </div>
                      <div class="inline-flex">
                        <button type="submit"class="bg-blue-300 hover:bg-gray-400 text-gray-500 font-bold py-2 rounded-l">Delete</button>
                        <a href="{{url('updatetopping/'.$topping->id)}}" class="bg-grey-300 hover:bg-gray-400 text-gray-500 font-bold py-2 px-4 rounded-r">Update</a>
                      </div>
                    </form>
                @endforeach
            </div>
            
        @else
            <p class="capitalize md:text-[32px] text-[14px] font-semibold">Topping Not found</p>
        @endif
    </div>
        <a href="{{url('addtopping')}}" style="transition:.3s; -webkit-tap-highlight-color: rgba(0,0,0,0);position: fixed; bottom: 16px;right: 16px;" class="overflow-scroll"><svg class="h-16 w-16 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="12" r="9" />  <line x1="9" y1="12" x2="15" y2="12" />  <line x1="12" y1="9" x2="12" y2="15" /></svg></a>
</div>
@endsection