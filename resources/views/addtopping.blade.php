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
    <div class="flex gap-20 items-center md:flex-row flex-col">
      <div class="flex flex-col w-full">
        <h1 class="md:mb-16 mb-12 font-extrabold md:text-[36px] sm:text-[24px] text-[16px] text-[#BD0707]" style="color: #BD0707">Topping</h1>
        <form class="mb-4" enctype="multipart/form-data"action="{{url()->current()}}" method="POST">
        @csrf
          <input class="mb-4 md:px-4 md:py-2 py-2 px-2 text-[14px] md:text-[16px] rounded-md w-full placeholder:text-[#BD0707] bg-[#eec4c440] border-2 border-[#f58181]" type="text" value="{{old('name_topping')}}" name="name_topping" placeholder="Name Topping" />
          <input class="mb-4 md:px-4 md:py-2 py-2 px-2 text-[14px] md:text-[16px] rounded-md w-full placeholder:text-[#BD0707] bg-[#eec4c440] border-2 border-[#f58181]" type="number" value="{{old('price_topping')}}" name="price_topping" placeholder="Price" />
    
          <div class="flex mb-4 px-4 py-2 relative rounded-md w-full bg-[#eec4c440] border-2 border-[#f58181]">
            <label for="filename" class="filename text-[#BD0707]">Photo Topping</label>
            <div class="absolute right-5 top-2">
              <label for="fileupload">
                <svg width="20" height="24" viewBox="0 0 19 30" class="cursor-pointer" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.375 30C4.20502 30 0 25.795 0 20.625V7.5C0 6.80878 0.560074 6.25008 1.24992 6.25008C1.94 6.25008 2.50008 6.80878 2.50008 7.5V20.625C2.50008 24.4151 5.5838 27.4999 9.375 27.4999C13.1662 27.4999 16.2499 24.4151 16.2499 20.625V6.87492C16.2499 4.46251 14.2875 2.50008 11.8751 2.50008C9.46243 2.50008 7.5 4.46251 7.5 6.87492V19.3751C7.5 20.4087 8.34114 21.2501 9.375 21.2501C10.4089 21.2501 11.25 20.4087 11.25 19.3751V7.5C11.25 6.80878 11.8101 6.25008 12.4999 6.25008C13.19 6.25008 13.7501 6.80878 13.7501 7.5V19.3751C13.7501 21.7875 11.7874 23.7499 9.375 23.7499C6.96259 23.7499 4.99992 21.7875 4.99992 19.3751V6.87492C4.99992 3.0851 8.08365 0 11.8751 0C15.6663 0 18.75 3.0851 18.75 6.87492V20.625C18.75 25.795 14.545 30 9.375 30Z" fill="#BD0707"/>
                </svg>  
              </label>
              <input type="file" name="file" id="fileupload" onchange="loadFile(event)" style="display: none; visibility: hidden">
            </div>
          </div>
          <button class="bg-[#BD0707] hover:bg-[#dd2727] my-4 w-full text-white font-bold py-2 px-4 rounded">Add Topping</button>
        </form>
      </div>
      <div class="md:w-[35rem] w-full md:mb-0 mb-8 rounded-lg md:h-[400px] h-[50%]">
        <img id="output" class="object-cover">
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $(function()
    {
      $("#fileupload").change(function(event){
      var x = event.target.files[0].name
        $(".filename").text(x)
      });
    });

    var loadFile = function(event){
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };

  </script>
@endsection