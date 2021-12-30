<div class="w-full text-gray-700 mt-4 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
  <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
    <div class="p-4 flex flex-row items-center justify-between">
      <a href="/" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        <img src="/logobrand.png" alt="brand" class="w-16" />
      </a>
      <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
        <svg fill="#BD0707" viewBox="0 0 20 20" class="w-6 h-6">
          <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    
    <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden gap-4 md:flex md:justify-end md:flex-row">
        @if ($active!=null)
          <div @click.away="open = false" class="relative" x-data="{ open: false }">
            <button @click="open = !open">
              @if (Auth::user()->profile == null)
                <div class="inline-block h-10 w-10 md:ml-4 ml-4 md:my-0 my-4 rounded-full ring-2 ring-[#111aaa]">
                  <p class="mt-[8px] uppercase">{{ substr(Auth::user()->fullname , 0, 1) }}</p>
                </div>
              @else
                <img class="inline-block h-10 w-10 md:ml-4 ml-4 md:my-0 my-4 rounded-full ring-2 ring-white" src="{{url('storage/images/'.Auth::user()->profile)}}" alt="profile user"> 
              @endif
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
              <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                @if (Auth::user()->role_id == 1)
                  <div class="flex gap-x-4 items-center px-4 py-2 mt-2 text-sm font-medium rounded-lg md:mt-0 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    <img class="w-6 h-8" src="/icons/icon_add_product.png"/>
                    <a class="text-[16px]" href="/addproduct">
                      Add Product
                    </a>
                  </div>
                  <div class="flex gap-x-4 items-center px-4 py-2 mt-2 text-sm font-medium rounded-lg md:mt-0 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    <img class="w-7 h-8" src="/icons/icon_add_topping.png" />
                    <a class="text-[16px]" href="/addtopping">
                      Add Topping
                    </a> 
                  </div>
                @else
                  <div class="flex gap-x-4 items-center px-4 py-2 mt-2 text-sm font-medium rounded-lg md:mt-0 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    <img class="w-7 h-8" src="/icons/icon_profile.png" />
                    <a class="text-[16px]" href="/user/profile">
                      Profile
                    </a> 
                  </div>
                @endif
                <div class="border-t-[1px] w-full my-2 border-t-[#c0c0c0]"></div>
                <div class="flex gap-x-2 items-center px-4 py-2 mt-2 text-sm font-medium rounded-lg md:mt-0 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                  <img class="w-7 h-8" src="/icons/icon_logout.png" />
                  <a class="text-[16px]" href="{{url('logout')}}">
                    Logout
                  </a>
                </div>
              </div>
            </div>
          </div>
        @else
          <a class="border-[2px] border-[#BD0707] hover:border-[#a31b1b] py-1 text-[#BD0707] w-[110px] font-bold px-8 rounded-md text-sm" href="{{url('login')}}">Login</a>
          <a class="px-6 md:px-[26px] py-[5px] text-sm bg-[#BD0707] w-[110px] text-[#f2f2f2] font-bold rounded-md hover:bg-[#910707]" href="{{url('register')}}">Register</a>
        @endif
    </nav>
  </div>
</div>
