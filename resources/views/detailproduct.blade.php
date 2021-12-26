@extends('layout.main')

@section('content')
<div class="container px-4 md:px-8 sm:px-6 mx-auto">
  <div class="flex gap-10 flex-col md:flex-row md:gap-32">
    <img class="rounded-[10px] object-cover md:w-1/4 w-full h-[30rem]" src="https://images.unsplash.com/photo-1606166325695-ce4d64e3195f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y29tcHV0ZXxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"/>
    <div class="w-full md:w-1/2">
      <h2 class="font-bold text-[#BD0707] capitalize sm:text-[32px] text-[20px] mb-4 md:text-[48px]">Ice Coffee Palm Sugar</h3>
      <p class="font-normal text-[#974A4A] sm:text-[16px] md:mb-14 text-[14px] mb-4 md:text-[24px]">Rp 27.000</p>
      <h3 class="capitalize font-semibold sm:text-[16px] md:mb-10 text-[14px] mb-4 md:text-[24px] text-[#974A4A] ">Topping</h3>
      {{-- START:  All Topping --}}
      <div class="flex gap-4 md:gap-6">
        {{-- Topping --}}
        <div class="flex items-center gap-y-3 flex-col">
          <label for="topping" class="relative">
            <img class="w-24 h-24 object-cover rounded-full" src="https://media.istockphoto.com/photos/little-gamer-in-headset-near-compute-picture-id1342094843?b=1&k=20&m=1342094843&s=170667a&w=0&h=3uN5LbqY_2sJgcdn89JfoiN98k2p4cXy5k9R_zEplFA="/>
            <input type="checkbox" id="topping" class="absolute top-1 right-0 w-6 h-6 rounded-full appearance-none hidden checked:flex checked:bg-[#d35252]" />
          </label>
          <p class="text-[#BD0707] text-[12px] md:text-[14px]">Bubble Tea Gelatin</p>
        </div>
      </div>
      {{-- END: ALL Topping --}}
      <div class="flex my-10 justify-between">
        <h3 class="text-[#974A4A] font-semibold md:text-[24px] sm:text-[20px] text-[14px]">Total</h3>
        <h3 class="text-[#974A4A] font-semibold md:text-[24px] sm:text-[20px] text-[14px]">Rp.12.000</h3>
      </div>
      <button class="w-full mb-8 capitalize text-center font-medium text-[#fff] py-1 md:text-[18px] bg-[#BD0707] rounded-[5px] sm:text-[16px] text-[12px]">
        add cart
      </button>
    </div>
  </div>
</div>
@endsection