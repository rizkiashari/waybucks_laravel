@extends('layout.main')

@section('content')

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
                  <tr class="border-b">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">1</td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                        Mark
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                        Cileungsi
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                        16820
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                        69.000
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r-2">
                        Waiting Approve
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                        <div class="flex gap-4 justify-center">
                            <button class="bg-[#BD0707] text-white font-semibold rounded-md w-24 py-1">
                                Cancel
                            </button>
                            <button class="bg-[#0ACF83] text-white font-semibold rounded-md w-24 py-1">
                                Approve
                            </button>
                        </div>
                    </td>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>


@endsection