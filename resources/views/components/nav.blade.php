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
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
    </head>

    <body class="">

        @php
            $accessToken = session('token.access_token');
            $userData = session('user_data');
        @endphp

        <div class="container w-full mx-auto px-4 py-3 justify-center bg-white border-b border-zinc-200">
            <div class="flex justify-between h-45 items-center">
                <div>
                    <a href="/dashboard"><img src="{{ URL('images/Frame22.png') }}" alt=""></a>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="hidden md:block">
                        <button
                            class="w-[30px] h-[30px] bg-white rounded-[5px] border border-zinc-200 justify-center items-center inline-flex">
                            <img src="{{ URL('images/alarm.svg') }}" alt="">
                        </button>
                        <button
                            class="w-[30px] h-[30px] bg-gray-100 rounded-[5px] border border-zinc-200 justify-center items-center inline-flex">
                            <img src="{{ URL('images/chat-alt-6.svg') }}" alt="">
                        </button>
                    </div>

                    <div class="flex-col items-start hidden md:block">
                        <div class="text-gray-900 text-base font-medium  font-['Inter']">{{ $userData['name'] }}</div>
                        <div class="text-gray-500 text-sm font-normal  font-['Inter']">{{ $userData['email'] }}</div>
                    </div>
                    <img src="{{ URL('images/Avatar.png') }}" alt="">
                    <div x-data="{ open: false }" x-ref="dropdown">
                        <img src="{{ URL('images/dropdown.svg') }}" alt="" @click="open = !open"
                            class="cursor-pointer">
                        <div x-show="open" x-cloak
                            class="absolute right-3 mt-[30px] border bg-white divide-y divide-gray-100 rounded-lg shadow p-3"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90">
                            <div class="md:hidden">
                                <div class="text-gray-900 text-base font-medium leading-normal font-['Inter']">
                                    {{ $userData['name'] }}

                                </div>
                                <div class="text-gray-500 text-sm font-normal leading-snug font-['Inter'] mb-1">
                                    {{ $userData['email'] }}
                                </div>
                            </div>
                            <ul class="py-2">
                                <li>
                                    <a href="#"
                                        class="block px-2 py-2 text-sm hover:bg-gray-100 hover:rounded-lg ">Profile</a>
                                </li>
                                <li class="md:hidden">
                                    <a href="#"
                                        class="block px-2 py-2 text-sm  hover:bg-gray-100 hover:rounded-lg">Notification</a>
                                </li>
                                <li class="md:hidden">
                                    <a href="#"
                                        class="block px-2 py-2 text-sm  hover:bg-gray-100 hover:rounded-lg">Message</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="get">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-start block px-2 py-2 text-sm  hover:bg-gray-100 hover:rounded-lg">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>



    </body>

    </html>
