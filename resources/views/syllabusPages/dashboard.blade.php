<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- Styles -->
</head>

<body class="">

    <x-nav></x-nav>

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif


    @php
        $accessToken = session('token.access_token');
        $userData = session('user_data');
    @endphp

    <div class="container mx-auto px-10 py-9">
        <div class="w-full h-[134px]">
            <div class="bg-gray-900 py-4 px-4 md:py-7 md:px-[51px] gap-3 rounded-2xl mb-[37px]">
                <div class=" text-white text-2xl md:text-[32px] font-bold font-['Inter'] leading-[49.99px]">Selamat
                    datang</div>
                <div class=" text-white text-xs font-normal font-['Inter'] leading-tight">Oasys syllabus
                    merupakan aplikasi AI Text Generation untuk kebutuhan administrasi dan akademik</div>
            </div>
            <a href="/syllabus">
                <div
                    class="w-full md:w-[303px]  p-4 rounded-lg shadow border border-gray-300 flex-col justify-start items-start gap-2 inline-flex">
                    <img src="{{ URL('images/book-open.svg') }}" alt="" class="w-6 h-6 relative">
                    <div class=" text-gray-900 text-lg font-bold font-['Inter'] leading-normal">Templat Silabus</div>
                    <div class=" text-black text-xs font-normal font-['Inter'] leading-normal">Gunakan template silabus
                        untuk sekolah</div>
                </div>
            </a>

        </div>
    </div>



</body>

</html>
