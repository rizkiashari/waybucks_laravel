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
    <div class="flex flex-col max-w-screen-xl md:mb-10 sm:mb-8 mb-6 px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        @if (count($carts) > 0)  
            <div class="flex gap-8 md:flex-row flex-col w-full">
                <div class="md:w-3/5 w-full">
                    <h2 class="text-[#BD0707] md:mb-8 mb-4 font-bold md:text-3xl text-xl sm:text-lg">My Cart</h2>
                    <div class="border-b-2 border-[#974A4A] pb-5">
                        <h2 class="text-[#BD0707] font-normal text-2xl" >Review Your Order</h2>
                        </div>
                        {{-- {{ dd($carts) }} --}}
                        <div class="border-b-2 border-[#974A4A] pb-5">
                            @foreach ($carts as $keyCart => $cart)
                                <div class="flex h-28 my-6 justify-between">
                                    <div class="flex gap-6">
                                        <div>
                                            <img class="h-28 w-28 object-cover rounded-md" src="<?php echo asset("/storage/images/". $cart['photo_product']) ?>" alt="">
                                        </div>
                                        <div class="flex flex-col justify-center gap-y-4">
                                            <div>
                                                <p class="text-[#BD0707] font-bold">
                                                    {{ $cart['name_product'] }}
                                                </p>
                                            </div>
                                            <div class="flex gap-2">
                                                <div>
                                                    <p class="text-[#974A4A] font-semibold">
                                                        Topping :
                                                    </p>      
                                                </div>
                                                <div>
                                                    <p class="text-[#BD0707]">
                                                        @foreach ($cart['topping'] as $item)
                                                            {{ $item }}
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="flex flex-col justify-center gap-y-4 items-end">
                                        <div>
                                            <p class="text-[#BD0707]">
                                                Rp.{{ number_format($cart['price_product'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div x-data="{ show: false }">
                                            <a @click="show = true" class="flex cursor-pointer items-center gap-4">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10 17.2322C10.3236 17.2322 10.5859 16.9698 10.5859 16.6462V8.77869C10.5859 8.45509 10.3236 8.19275 10 8.19275C9.67641 8.19275 9.41406 8.45509 9.41406 8.77869V16.6462C9.41406 16.9698 9.67641 17.2322 10 17.2322Z" fill="#BD0707"/>
                                                    <path d="M6.77385 16.7012C6.80432 17.024 7.09084 17.26 7.41229 17.2295C7.73447 17.1991 7.97096 16.9132 7.94053 16.591L7.19764 8.72351C7.16721 8.40136 6.8819 8.1648 6.5592 8.19527C6.23701 8.2257 6.00053 8.51152 6.03096 8.83371L6.77385 16.7012Z" fill="#BD0707"/>
                                                    <path d="M12.588 17.2295C12.9098 17.2599 13.196 17.0237 13.2264 16.7013L13.9693 8.83373C13.9998 8.51154 13.7632 8.22572 13.4411 8.19529C13.1184 8.16467 12.8331 8.40139 12.8027 8.72354L12.0598 16.5911C12.0293 16.9132 12.2659 17.1991 12.588 17.2295Z" fill="#BD0707"/>
                                                    <path d="M2.25195 6.59668H2.60223L4.29941 19.4905C4.33777 19.7821 4.58629 20 4.88035 20H15.12C15.4141 20 15.6625 19.7821 15.7009 19.4905L17.3981 6.59668H17.7484C18.072 6.59668 18.3343 6.33434 18.3343 6.01074V3.44711C18.3343 3.12352 18.072 2.86117 17.7484 2.86117H12.7344V2.63027C12.7344 1.17996 11.5545 0 10.1042 0H9.89617C8.44586 0 7.2659 1.17996 7.2659 2.63027V2.86117H2.25195C1.92836 2.86117 1.66602 3.12352 1.66602 3.44711V6.01074C1.66602 6.33434 1.92832 6.59668 2.25195 6.59668V6.59668ZM14.6061 18.8281H5.39418L3.78422 6.59668H16.2161L14.6061 18.8281ZM8.43773 2.63027C8.43773 1.82613 9.09199 1.17188 9.89613 1.17188H10.1041C10.9083 1.17188 11.5625 1.82613 11.5625 2.63027V2.86117H8.43773V2.63027ZM2.83789 4.03305H17.1625V5.4248C17.0372 5.4248 2.99414 5.4248 2.83789 5.4248V4.03305Z" fill="#BD0707"/>
                                                </svg>                            
                                            </a>
                                            <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-[#000000] bg-opacity-25" x-show="show">
                                                <!-- Modal inner -->
                                                <div class="w-[300px] md:w-[500px] h-[220px] md:h-[250px] px-6 py-4 mx-auto text-left bg-[#fff] rounded shadow-lg" @click.away="show = false" x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                                                <div class="flex items-center">
                                                    <div class="bg-[#ff6e6e] rounded-[100px] p-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-[-4px]" width="18" height="18" fill="#a70202" viewBox="0 0 16 16">
                                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                        </svg>
                                                    </div>
                                                    <h5 class="ml-3 text-black max-w-none">Delete Cart</h5>
                                                </div>
                                                <!-- content -->
                                                <p class="text-[#666666] mt-3 px-4 md:px-8 text-[12px] md:text-[16px]">Are you sure you want to delete this product {{ $cart['name_product'] }}? All of your data will be permanently removed from our servers forever. This action cannot be undone</p>
                                                    <div class="flex justify-end mb-6 items-end mt-4 gap-3">
                                                    <button type="button" class="text-[#BD0707] border-[1px] hover:bg-[#fdfdfd] hover:text-[#bd0707c4] border-[#bd0707c4] px-4 py-2 rounded-[8px] text-[12px] md:text-[16px] text-center" @click="show = false">Cancel</button>
                                                    <form action="/cart/{{ $cart['id_cart'] }}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-[#BD0707] hover:bg-[#bd0707c4] text-[12px] md:text-[16px] text-[#fff] px-4 py-2 rounded-[8px] text-center">Delete</button>
                                                    </form>
                                                    </div>                       
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="flex mt-10 md:flex-row flex-col justify-between">
                            <div class="flex flex-col w-full text-[#BD0707]">
                                <div class="border-b-2 border-t-2 border-[#974A4A] py-5">
                                    <div class="flex flex-col ">
                                        <div class="flex justify-between">
                                            <div>
                                                <p>Subtotal</p>
                                            </div>
                                            <div>
                                                <p>Rp.{{ number_format($subTotal, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div>
                                                <p>Qty</p>
                                            </div>
                                            <div>
                                                <p>{{ $qty_transaction }}</p>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="py-5">
                                    <div class="flex justify-between font-bold">
                                        <div>
                                            <p>Total</p>
                                        </div>
                                        <div>
                                            <p>Rp.{{ number_format($subTotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div> 
                                </div>
                            </div>                                         
                        </div>
                    </div>
                    <div class="md:w-2/5 w-full px-10 pt-12"> 
                        <form action="/transaction" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-6">
                                <input type="text" name="name_transaction" class="form-control block w-full px-3 py-2 text-[#111] font-normal text-lg bg-[#E0C8C840] bg-clip-padding border-2 border-solid border-[#BD0707] rounded-md transition ease-in-out m-0" placeholder="Name" value="{{ old('name_transaction') }}" />
                            </div>

                            <div class="form-group mb-6">
                                <input type="email" name="email_transaction" class="form-control block w-full px-3 py-2 text-[#111] font-normal text-lg bg-[#E0C8C840] bg-clip-padding border-2 border-solid border-[#BD0707] rounded-md transition ease-in-out m-0" value="{{ old('email_transaction') }}" placeholder="Email address" />
                            </div>

                            <div class="form-group mb-6">
                                <input type="text" name="phone_transaction" class="form-control block w-full px-3 py-2 text-[#111] font-normal text-lg bg-[#E0C8C840] bg-clip-padding border-2 border-solid border-[#BD0707] rounded-md transition ease-in-out m-0" value="{{ old('phone_transaction') }}" placeholder="Phone" />
                            </div>

                            <div class="form-group mb-6">
                                <input type="text" name="postal_code_transaction" class="form-control block w-full px-3 py-2 text-[#111] font-normal text-lg bg-[#E0C8C840] bg-clip-padding border-2 border-solid border-[#BD0707] rounded-md transition ease-in-out m-0" value="{{ old('postal_code_transaction') }}" placeholder="Post Code" />
                            </div>
                            
                            <div class="form-group mb-6">
                                <textarea name="address_transaction" class="form-control block w-full px-3 py-2 text-[#111] font-normal text-lg bg-[#E0C8C840] bg-clip-padding border-2 border-solid border-[#BD0707] rounded-md transition ease-in-out m-0" rows="3" placeholder="Address"
                                >{{ old('address_transaction') }}</textarea>
                            </div>
                            <label x-data="imagePreview()" for="attach" class="w-full h-[10rem] cursor-pointer border-2 md:py-0 py-12 rounded-lg border-[#BD0707] bg-[#E0C8C840] flex flex-col items-center justify-center gap-y-2">
                                <template x-if="!imageUrl">
                                    <div class="flex flex-col items-center justify-center gap-y-2">
                                        <img src="/icons/icon_attach.svg" />                            
                                        <h2 class="text-[#68323280] text-center font-normal text-sm md:text-xl">Attache of Transaction</h2> 
                                    </div>                  
                                </template>
                                <template x-if="imageUrl">
                                    <img :src="imageUrl" class="w-full h-auto md:h-[10rem] object-cover" />
                                </template>
                                
                                <input type="file" id="attach" accept="image/jpg" @change="fileChosen" name="file" class="hidden" />
                            </label>
                            <button type="submit" class="w-full mt-8 px-6 py-2.5 bg-[#BD0707] text-white font-bold text-lg leading-tight rounded-md shadow-md hover:bg-[#a31b1b] hover:shadow-lg transition duration-150 ease-in-out">
                                Pay
                            </button>            
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="flex item-center mx-auto mt-4 justify-center md:w-[50%] md:h-[50%] w-[70%] h-[70%] md:mb-12 sm:mb-8 mb-4">
                <div class="flex flex-col">
                    <img src="/icons/icon_cart_empty.svg" class="object-cover"/>
                    <p class="text-[#BD0707] text-[14px] sm:text-[16px] md:text-[24px] md:mt-8 sm:mt-6 mt-4 font-semibold text-center">Sorry cart not found</p>
                </div>
            </div>
        @endif
    </div>
@endsection