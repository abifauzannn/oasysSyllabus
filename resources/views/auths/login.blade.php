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

<body class="antialiased">
    <div class="container mx-auto flex items-center justify-center mt-10 sm:h-screen sm:mt-0 xl:gap-48 lg:gap-20">
        <div class="hidden lg:block">
            <img class="w-[612px] h-[612px] object-cover" src="{{ URL('images/onboarding.png') }}" />
        </div>
        <div class="w-[340px] sm:w-[352px] h-[515px] flex flex-col">
            <div class="justify-center items-center gap-4 inline-flex mb-12">
                <img src="{{ URL('images/Logo.svg') }}" alt="" class="w-[50px] h-[39px]">
                <div class="text-center text-gray-900 text-2xl font-bold font-['Inter'] leading-normal">Brainys
                </div>
            </div>
            <div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email"
                            class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                            placeholder="email@contoh.com" required>
                    </div>

                    <div class="relative mb-4">
                        <label for="password"
                            class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[30px]">Password:</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                            placeholder="Masukkan Password Anda">
                        <button id="togglePassword" type="button"
                            class="absolute right-0 top-[48px] flex items-center mr-3 focus:outline-none">
                            <img src="{{ URL('images/group.svg') }}" alt="">
                        </button>
                    </div>

                    <button type="submit"
                        class="w-full h-12 px-6 py-3 bg-blue-600 rounded-[50px] justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/arrow.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Login
                        </div>
                    </button>
                </form>

            </div>
            <div class="flex items-center justify-between mt-[44px] mb-8">
                <div class="flex items-center justify-center gap-1">
                    <hr class="border-t border-gray-300 w-[151px] h-0 z-0 pt-0.5">
                    <span class="text-gray-500 text-sm font-medium font-['Roboto'] pb-[2px]">
                        ATAU
                    </span>
                    <hr class="border-t border-gray-300 w-[156px] h-0 z-0">
                </div>
            </div>
            <button type="submit"
                class="w-full h-12 inline-flex gap-[92px] pt-3 pb-[11px] bg-white rounded-[50px] shadow border border-neutral-200 mb-8">
                <img src="{{ URL('images/google.svg') }}" alt="" class="w-[18px] h-[18px] ml-6">
                <div class="text-black text-opacity-50 text-base font-medium font-['Roboto']">Sign in with Google</div>
            </button>

            <div class="h-6 justify-center items-center gap-2 inline-flex">
                <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal">Belum punya
                    akun?</div>
                <div class="text-center text-blue-600 text-base font-medium font-['Inter'] leading-normal"><a
                        href="">Register</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>
</body>

</html>
