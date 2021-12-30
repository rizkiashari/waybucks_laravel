@extends('layout.main')
@section('content')
<div class="px-24">
  <div class="grid grid-cols-2 gap-2">
    <div>
      <form class="mb-4" enctype="multipart/form-data"action="{{url()->current()}}" method="POST">
      @csrf
      <h1 class="mb-5" style="color: #BD0707">Topping</h1>
      <input class="form-control mb-4" type="text" value="{{old('name_topping')}}" name="name_topping" placeholder="Name Topping" style="background: #eec4c440; padding:5px; border: 2px solid #f58181; width:300px">
      <input class="form-control mb-4" type="number" value="{{old('price_topping')}}" name="price_topping" placeholder="Price" style="background: #eec4c440; padding:5px; border: 2px solid #f58181; width:300px">
  
      <div class="d-flex bd-highlight form-control mb-4 h-9 w-72" style="background: #eec4c440; border: 2px solid #f58181">
        <label for="filename" class="flex-grow-1 bd-highlight filename">Photo Topping</label>
        <div class="custom-file bd-highlight">
          <label for="fileupload"  class="float-right" >
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
            <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
            </svg>
          </label>
          <input type="file" name="file" id="fileupload" onchange="loadFile(event)" style="display: none; visibility: hidden">
        </div>
      </div>
      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Add Topping</button>
      </form>
    </div>
    <img id="output" style="width: 15vw">
  </div>
  @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
              @foreach ($errors->all() as $errors)
              <li><strong>{{ $errors }}</strong></li>
              @endforeach
          </ul>
      </div>
      @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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