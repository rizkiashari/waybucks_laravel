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
<form method="POST" action="/product/{{ $product->slug_product }}/add-to-cart" enctype="multipart/form-data">
  @csrf
  <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
    <div class="flex w-full gap-10 flex-col md:flex-row md:gap-28">
      <img class="rounded-[10px] object-cover md:w-1/2 w-full h-[30rem]" src="<?php echo asset("storage/images/$product->photo_product") ?>"/>
      <div class="w-full">
        <h2 class="font-bold text-[#BD0707] capitalize sm:text-[28px] text-[16px] mb-4 md:text-[44px]">{{ $product->name_product }}</h3>
        <p class="font-normal text-[#974A4A] sm:text-[16px] md:mb-14 text-[14px] mb-4 md:text-[24px]"> Rp.{{ number_format($product->price_product,  0, ".", ".") }}</p>
        <h3 class="capitalize font-semibold sm:text-[16px] md:mb-10 text-[14px] mb-4 md:text-[24px] text-[#974A4A] ">Topping</h3>
        {{-- START:  All Topping --}}
        <div class="flex w-full gap-4 md:gap-8 flex-wrap">
          {{-- Topping --}}
          @if (count($toppings) > 0)
            @foreach ($toppings as $topping)
              <div class="flex items-center gap-y-3 flex-col">
                <label for="{{ $topping->id }}" class="relative cursor-pointer">
                  <img class="md:w-24 md:h-24 w-16 h-16 object-cover rounded-full" src="<?php echo asset("storage/images/$topping->photo_topping") ?>"/>
                  <input type="checkbox" value={{ $topping->price_topping }}  name="topping[{{ $topping->id }}]" id="{{ $topping->id }}" class="absolute top-1 right-0 w-6 h-6 rounded-full appearance-none hidden checked:flex checked:bg-[#d35252] toppings" />
                </label>
                <label class="text-[#BD0707] text-[12px] md:text-[14px]">{{ $topping->name_topping }}</label>
              </div>
            @endforeach
          @else
            <p class="capitalize md:text-[32px] text-[14px] font-semibold">Topping not found</p>
          @endif
        </div>
        {{-- END: ALL Topping --}}
        <div class="flex my-10 justify-between">
          <h3 class="text-[#974A4A] font-semibold md:text-[24px] sm:text-[20px] text-[14px]">Total</h3>
          <h3 class="text-[#974A4A] font-semibold md:text-[24px] sm:text-[20px] text-[14px] total">Rp.{{ number_format($product->price_product,  0, ".", ".") }}</h3>
        </div>
        <button type="submit" class="w-full mb-8 capitalize text-center font-medium text-[#fff] py-1 md:text-[18px] bg-[#BD0707] rounded-[5px] sm:text-[16px] text-[12px]">
          add cart
        </button>
      </div>
    </div>
  </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
  const formatRupiah = (money) => {
    let reverse = money.toString().split('').reverse().join(''),
    ribuan  = reverse.match(/\d{1,3}/g);
    ribuan  = ribuan.join('.').split('').reverse().join('');
    return ribuan;
  }

  $('.toppings').change(function(){
    let total = 0;
    // condition if topping is checked
    if($(this).is(':checked')){
      // get value of topping
      let topping = $(this).val();
      // get total
      total = parseInt($('.total').text().replace(/[^\d]/g, ''));
      // add topping to total
      total += parseInt(topping);
      // set total
      const format = formatRupiah(total);
      $('.total').text('Rp.' + format);
    }else{
      // get value of topping
      let topping = $(this).val();
      // get total
      total = parseInt($('.total').text().replace(/[^\d]/g, ''));
      // remove topping from total
      total -= parseInt(topping);
      // set total
      const format = formatRupiah(total);
      $('.total').text('Rp.' + format);
    } 
  });
</script>
@endsection