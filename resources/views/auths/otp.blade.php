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

<body>
    <div class="container mx-auto flex items-center justify-center flex-col mt-10">
        <img src="{{ URL('images/Steps.png') }}" alt="" class="w-[206px] h-[84px]">
        <div class="w-[380px] sm:w-[412px] h-[358px] flex items-center justify-center flex-col mt-20 sm:mt-[88px]">
            <img src="{{ URL('images/envelope.svg') }}" alt="">
            <div class="text-gray-900 text-4xl font-['Inter'] font-bold mt-4 mb-4">OTP Email</div>
            <div class="text-center text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-12">Silakan
                cek kode OTP pada inbox email anda untuk </div>
            <form>
                <div class="flex gap-4 justify-between">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit1" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit2" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit3" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit4" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit5" oninput="handleInput(this)" placeholder="0">
                    <input type="text"
                        class="w-11 h-12 rounded-md text-center bg-gray-50 text-sky-600 text-xl font-medium font-['Inter'] leading-normal focus:outline-none focus:border-none p-2"
                        maxlength="1" id="digit6" oninput="handleInput(this)" placeholder="0">
                </div>
                <div class="flex justify-center mt-8">
                    <div class="text-black text-base font-normal font-['Inter'] leading-[30px] mr-2">Kirim ulang kode OTP</div>
                    <div id="countdown" class="text-blue-600 text-base font-normal font-['Inter'] leading-[30px]">2:00</div>
                    <button id="resendBtn"
                        class="hidden text-blue-400">Kirim
                        kODE</button>
                </div>
                <button id="confirmButton"
                    class="w-full h-12 px-6 py-3 rounded-[50px] justify-center items-center gap-2 inline-flex mt-8 bg-gray-200 text-white"
                    disabled>
                    <div class="text-center text-base font-medium font-['Inter'] leading-normal">Konfirmasi</div>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let totalSeconds = 2 * 60; // 2 menit
            let minutes, seconds;

            function updateCountdown() {
                minutes = Math.floor(totalSeconds / 60);
                seconds = totalSeconds % 60;

                document.getElementById('countdown').innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (totalSeconds <= 0) {
                    // Countdown selesai, tampilkan tombol "Kirim Ulang"
                    document.getElementById('countdown').classList.add('hidden');
                    document.getElementById('resendBtn').classList.remove('hidden');
                } else {
                    totalSeconds--;
                    setTimeout(updateCountdown, 1000); // Perbarui setiap 1 detik
                }
            }

            function restartCountdown() {
                // Reset nilai detik dan tampilkan countdown
                totalSeconds = 2 * 60;
                updateCountdown();
                document.getElementById('countdown').classList.remove('hidden');
                document.getElementById('resendBtn').classList.add('hidden');
            }

            // Tambahkan event listener untuk tombol "Kirim Ulang"
            document.getElementById('resendBtn').addEventListener('click', restartCountdown);

            // Mulai countdown pertama kali
            updateCountdown();
        });

        function handleInput(currentInput) {
            const maxLength = parseInt(currentInput.getAttribute('maxlength'));
            const currentLength = currentInput.value.length;

            if (currentLength >= maxLength) {
                const nextInput = currentInput.nextElementSibling;
                if (nextInput) {
                    nextInput.focus();
                }
            } else if (currentLength === 0) {
                const prevInput = currentInput.previousElementSibling;
                if (prevInput) {
                    prevInput.focus();
                }
            }

            // Memeriksa apakah semua input terisi
            const allInputsFilled = Array.from(document.querySelectorAll('input[type="text"]'))
                .every(input => input.value.length > 0);

            // Mengaktifkan atau menonaktifkan tombol berdasarkan kondisi
            const confirmButton = document.getElementById('confirmButton');
            confirmButton.disabled = !allInputsFilled;

            // Mengubah warna tombol berdasarkan kondisi
            confirmButton.classList.toggle('bg-gray-200', !allInputsFilled);
            confirmButton.classList.toggle('bg-blue-500', allInputsFilled);
        }
    </script>


</body>

</html>
