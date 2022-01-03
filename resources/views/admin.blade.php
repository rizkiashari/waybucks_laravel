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
    <div class="flex flex-col w-full px-10 pt-10">
        <h2 class="text-[#BD0707] md:mb-8 mb-4 font-bold text-3xl">Income transaction</h2>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full border">
                <thead class="border-b bg-[#E5E5E5] text-center">
                  <tr>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4 border-r-2 border-gray-300">
                        No
                    </th>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4 border-r-2 border-gray-300">
                        Name
                    </th>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4 border-r-2 border-gray-300">
                        Address
                    </th>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4 border-r-2 border-gray-300">
                        Postcode
                    </th>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4 border-r-2 border-gray-300">
                        Income
                    </th>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4 border-r-2 border-gray-300">
                        Status
                    </th>
                    <th scope="col" class="text-sm font-extrabold text-gray-900 px-6 py-4">
                        Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $key => $transaction)
                    <tr class="border-b">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $key+=1 }}</td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->name_transaction }}
                      </td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->address_transaction }}
                      </td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->postal_code_transaction }}
                      </td>
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                          69.000
                      </td>
                      @if ($transaction->status_transaction == "Waiting Approve")
                        <td class="text-sm text-[#BD0707] font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->status_transaction }}
                        </td>
                      @endif
                      @if ($transaction->status_transaction == "Success")
                        <td class="text-sm text-[#78A85A] font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->status_transaction }}
                        </td>
                      @endif
                      @if ($transaction->status_transaction == "Cancel")
                        <td class="text-sm text-[#E83939] font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->status_transaction }}
                        </td>
                      @endif
                      @if ($transaction->status_transaction == "On The Way")
                        <td class="text-sm text-[#00D1FF] font-light px-6 py-4 whitespace-nowrap border-r-2">
                          {{ $transaction->status_transaction }}
                        </td>
                      @endif
                      <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        @if ($transaction->status_transaction == "Waiting Approve")
                          <div class="flex gap-4 justify-center">
                            <form action="/transaction/{{ $transaction->uuid_transaction }}/cancel" method="POST">
                              @csrf
                              <button class="bg-[#BD0707] text-white font-semibold rounded-md w-24 py-1">
                                Cancel
                              </button>
                            </form>
                            <form action="/transaction/{{ $transaction->uuid_transaction }}/onTheWay" method="POST">
                              @csrf
                              <button class="bg-[#0ACF83] text-white font-semibold rounded-md w-24 py-1">
                                Approve
                              </button>
                            </form>
                          </div>
                        @endif
                        @if ($transaction->status_transaction == "Success" || $transaction->status_transaction == "On The Way")
                          <div class="flex justify-center items-center">
                            <img src="/icons/icon_success.png" class="w-[24px]" />
                          </div>
                        @endif
                        @if ($transaction->status_transaction == "Cancel")
                        <div class="flex justify-center items-center">
                          <img src="/icons/icon_cancel.png" class="w-[24px]" />
                        </div>
                      @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{ $transactions->links() }}
 </div>


@endsection