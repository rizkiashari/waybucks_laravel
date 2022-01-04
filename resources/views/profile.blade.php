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
      <div class="bg-[#f8d7da] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
        <span class="absolute left-0 top-0 px-4 py-3">
          <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
        <div class="flex flex-col ml-4">
          <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('error') }}</strong>
        </div>
      </div>
    </div>
  @endif

  <div class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
    <div class="flex w-full flex-row md:gap-8 sm:gap-6 gap-4 justify-between flex-wrap">
      <div>
        <h3 class="font-bold text-[16px] sm:text-[20px] md:text-[24px] capitalize text-[#BD0707] md:mb-8 sm:mb-6 mb-4">My Profile</h3>
        <div class="flex gap-8">
          <div>
            <form class="flex flex-col" method="POST" action="/user/update/{{ $user->id }}" enctype="multipart/form-data">
              @csrf
              @if ($user->profile == null)
                <div x-data='imagePreview()' class="inline-block h-[100px] w-[100px] md:h-[150px] md:w-[150px] rounded-full ring-2 ring-zinc-500">
                  <template x-if="!imageUrl">
                    <label for="photo" class="cursor-pointer w-full h-full text-[#111827] uppercase ml-[0.5em] font-medium font-Oswald text-[4em] md:text-[6em]" >{{ substr($user->fullname , 0, 1) }}</label>
                  </template>
                  <template x-if="imageUrl">
                    <img :src="imageUrl" class="inline-block h-[100px]  w-[100px] object-cover md:h-[150px] md:w-[150px] rounded-full ring-2 ring-white" />
                  </template>
                  <input type="file" @change="fileChosen" class="hidden" name="profile" id="photo" />
                </div>
              @else
                <div x-data='imagePreview()'>
                  <label for="photo" class="cursor-pointer">
                    <template x-if="!imageUrl">
                      <img class="inline-block h-[100px] w-[100px] md:h-[150px] md:w-[150px] object-cover rounded-full ring-2 ring-white" src="<?php echo asset("storage/profile/$user->profile") ?>" alt="">
                    </template>
                    <template x-if="imageUrl">
                      <img :src="imageUrl" class="inline-block h-[100px] w-[100px] object-cover md:h-[150px] md:w-[150px] rounded-full ring-2 ring-white" />
                    </template>
                  </label>
                  <input type="file"  @change="fileChosen" class="hidden" name="profile" id="photo" />
                </div>
              @endif
              <button type="submit" class="bg-[#bd0707] text-[#fff] px-2 py-1 rounded-md text-[14px] mt-4 ml-4">Update Profile</button>
            </form>
          </div>
          <div>
            <div class="mb-4">
              <h3 class="capitalize text-[#613D2B] font-medium mb-2 text[12px] sm:text-[16px] md:text-[18px]">Full name</h3>
              <p class="capitalize mb-2 text[12px] sm:text-[16px] md:text-[18px]">{{ $user->fullname }}</p>
            </div>
            <div class="mb-4">
              <h3 class="capitalize text-[#613D2B] font-medium mb-2 text[12px] sm:text-[16px] md:text-[18px]">Email</h3>
              <p class="mb-2 text[12px] sm:text-[16px] md:text-[18px]">{{ $user->email }}</p>
            </div>
          </div>
        </div>
      </div>
      <div>
        <h3 class="font-bold text-[16px] sm:text-[20px] md:text-[24px] capitalize text-[#613D2B] md:mb-8 sm:mb-6 mb-4">My Transaction</h3>
        @foreach ($transactions as $transaction)
          <div class="bg-[#F6DADA] flex flex-col mb-4 justify-between w-full px-4 py-3">
            <div class="flex flex-col gap-4">
              @foreach ($detailTransactions as $detailTransaction)
                @if ($detailTransaction->transaction_id == $transaction->id)
                  <div class="flex gap-4">
                    <img class="w-[100px] object-cover rounded-lg" src="<?php echo asset("storage/images/$detailTransaction->PhotoProduct") ?>"/>
                    <div>
                      <h3 class="text-sm text-[#BD0707] mb-1 font-semibold">{{ $detailTransaction->NameProduct }}</h3>
                      <?php
                        $date = date_create($transaction->created_at);
                        $dateDay = date_format($date, 'l,');
                        $dateFull = date_format($date, 'd F Y');
                      ?>
                      <p class="text-[10px] text-[#BD0707] mb-2"><strong>{{ $dateDay }}</strong> {{ $dateFull }}</p>
                      <div class="flex items-center mb-2 gap-3">
                        <p class="text-[10px] text-[#BD0707]">Topping</p>
                        <p class="text-[#BD0707] text-[10px] font-semibold">
                          @foreach ($toppingTransaction as $item)
                          @if ($item->transaction_detail_id == $detailTransaction->id)
                          {{ $item->NameTopping }}
                          @endif
                          @endforeach
                        </p>
                      </div>
                      <div class="flex gap-x-3 items-center">
                        <p class="text-[#974A4A] text-[10px]">Price:</p>
                        <p class="text-[#974A4A] text-[10px]">{{ $detailTransaction->subTotal }}</p>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
            <div></div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
