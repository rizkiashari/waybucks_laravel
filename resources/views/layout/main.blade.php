<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Waysbucks | {{ $title }}</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,500&family=Oswald:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

  <style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
</head>
<body style="font-family: 'Open Sans', 'Product Sans', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
  
  <div>
    @include('partials.navbar')

    <main class="mt-16">
      @yield('content')
    </main>
  </div>

  <script>
    const imagePreview = () => {
      return {
        imageUrl: '',

        fileChosen(event) {
          this.fileToDataUrl(event, src => this.imageUrl = src)
        },

        fileToDataUrl(event, callback) {
          if (!event.target.files.length) return

          let file = event.target.files[0],
              reader = new FileReader()

          reader.readAsDataURL(file)
          reader.onload = e => callback(e.target.result)
        },
      }
    }
  </script>
</body>
</html>