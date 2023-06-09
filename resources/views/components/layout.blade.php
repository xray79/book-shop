<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- css --}}
    <link rel="stylesheet" href="/style.css">

    {{-- flowbite cdn --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    {{-- tailwind cdn --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- alpine cdn --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- sweet alert cdn and init --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script> --}}

    {{-- font awesome cdn --}}
    <script src="https://kit.fontawesome.com/e3c33cee74.js" crossorigin="anonymous"></script>

    <title>Book Shop</title>
</head>

<body class="relative">
    <x-navbar.index />
        {{ $slot }}
    <x-footer />

    <x-popup-container>            
        @if (session()->has('success'))
            <x-popup>
                {{ session('success') }}
            </x-popup>
        
        @elseif (session()->has('failure'))
            <x-failure-popup>
                {{ session('failure') }}
            </x-failure-popup>
        @endif
    </x-popup-container>
</body>
</html>
