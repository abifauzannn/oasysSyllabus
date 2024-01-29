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



    <div class="container mx-auto px-10 py-9">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <div class="w-[1170px] h-[60px] flex-col justify-start items-start gap-2 inline-flex">
            <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Template Silabus</div>
            <div class="w-[549px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">Lorem ipsum dolor sit
                amet, consectetur adipiscing elit. Cras ultrices lectus sem.</div>
        </div>
    </div>

    <div class="flex container mx-auto px-10">
        <div class="w-[500px] h-full flex-col justify-start items-start gap-6 inline-flex">
            <form action="{{ route('generate-syllabus') }} " method="post">
                <!-- Input untuk Nama Silabus -->
                @csrf
                <div class="mb-4">
                    <label for="pelajaran"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal">Mata Pelajaran</label>
                    <input type="text" id="pelajaran" name="pelajaran" id="pelajaran"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Nama Silabus" required>
                </div>

                <!-- Input untuk Mata Pelajaran -->
                <div class="mb-4">
                    <label for="kelas"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal">Kelas</label>
                    <input type="text" id="kelas" name="kelas" id="kelas"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Mata Pelajaran" required>
                </div>

                <div class="mb-4">
                    <label for="notes"
                        class="text-gray-900 text-base font-medium font-['Inter'] leading-normal mb-[10px]">Deskripsi
                        Silabus:</label>
                    <textarea id="notes" name="notes"
                        class="w-full p-2 border rounded-md mt-[10px] text-gray-400 text-base font-normal font-['Inter'] leading-normal mr-5"
                        placeholder="Masukkan deskripsi poin silabus" maxlength="50" oninput="updateCharacterCount(this)" required></textarea>
                </div>
                <div class="flex justify-end -mt-2">
                    <div class="self-stretch justify-start items-end gap-5 inline-flex">
                        <div id="characterCount"
                            class="text-left text-gray-500 text-sm font-normal font-inter leading-snug">0/50</div>
                    </div>
                </div>
                <div class="flex justify-between py-6">
                    <button
                        class="h-12 px-6 bg-white rounded-lg justify-center items-center gap-2.5 inline-flex border border-gray-900">
                        <img src="{{ URL('images/x-circle.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-base font-medium font-['Inter'] leading-normal">Hapus
                        </div>
                    </button>
                    <button type="submit"
                        class="h-12 px-6 bg-blue-600 rounded-lg justify-center items-center gap-2.5 inline-flex">
                        <img src="{{ URL('images/glass.svg') }}" alt="" class="w-[20px] h-[20px]">
                        <div class="text-center text-white text-base font-medium font-['Inter'] leading-normal">Buat
                            Syllabus
                        </div>
                    </button>
                </div>


            </form>
        </div>

        <div class="flex-col justify-start items-start gap-6 inline-flex">
            <div class="w-full h-full overflow-y-scroll flex-col justify-start items-start gap-4 inline-flex">
                <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">Hasil</div>
                <div class="h-[91px] flex-col justify-start items-start gap-[3px] flex">
                    <div class="w-[788px] text-gray-500 text-sm font-normal font-['Inter'] leading-snug">
                        @isset($data)
                            <!-- Display the generated syllabus -->
                            <div>
                                <ul class="text-slate-800">
                                    <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px] py-2">
                                        Informasi Umum
                                    </div>
                                    <li><strong>Penyusun :</strong> {{ $data['informasi_umum']['penyusun'] }}</li>
                                    <li><strong>Instansi :</strong> {{ $data['informasi_umum']['instansi'] }}</li>
                                    <li><strong>Tahun Penyusunan : </strong>
                                        {{ $data['informasi_umum']['tahun_penyusunan'] }}
                                    <li><strong>Jenjang Sekolah : </strong> {{ $data['informasi_umum']['jenjang_sekolah'] }}
                                    <li><strong>Mata Pelajaran : </strong> {{ $data['informasi_umum']['mata_pelajaran'] }}
                                    <li><strong>Fase Kelas : </strong> {{ $data['informasi_umum']['fase_kelas'] }}
                                    <li><strong>Topik : </strong> {{ $data['informasi_umum']['topik'] }}
                                    <li><strong>Alokasi Waktu : </strong> {{ $data['informasi_umum']['alokasi_waktu'] }}
                                    <li><strong>Kompetensi Awal : </strong>
                                        {{ $data['informasi_umum']['kompetensi_awal'] }}
                                    </li>
                                    <!-- Add more details as needed -->
                                </ul>
                            </div>

                            <div>
                                {{-- Add your HTML and styling for the generated syllabus here --}}
                                <ul>
                                    <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px] py-2">
                                        Sarana dan Prasarana
                                    </div>
                                    <li><strong>Sumber Belajar : </strong>
                                        {{ $data['sarana_dan_prasarana']['sumber_belajar'] }}</li>
                                    <li><strong>Lembar Kerja Peserta Didik : </strong>
                                        {{ $data['sarana_dan_prasarana']['lembar_kerja_peserta_didik'] }}</li>
                                    <!-- Add more details as needed -->
                                </ul>
                            </div>

                            <div class="pt-2">
                                <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px]">
                                    Komponen Pembelajaran
                                </div>

                                <div>
                                    <div class="text-gray-900 text-md font-semibold font-['Inter'] leading-[30px]">
                                        Perlengkapan Peserta Didik
                                    </div>
                                    <ul>
                                        @foreach ($data['komponen_pembelajaran']['perlengkapan_peserta_didik'] as $key => $item)
                                            <li>{{ $key + 1 }}. {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div>
                                    <div class="text-gray-900 text-md font-semibold font-['Inter'] leading-[30px]">
                                        Perlengkapan Peserta Didik
                                    </div>
                                    <ul>

                                        @foreach ($data['komponen_pembelajaran']['perlengkapan_guru'] as $key => $item)
                                            <li>{{ $key + 1 }}. {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="pt-2">
                                {{-- Add your HTML and styling for the generated syllabus here --}}
                                <ul>
                                    <div class="text-gray-900 text-2xl font-semibold font-['Inter'] leading-[30px] py-2">
                                        Tujuan Kegiatan Pembelajaran
                                    </div>
                                    <li><div class="text-gray-900 text-md font-semibold font-['Inter'] leading-[30px]">Tujuan Pembelajaran Bab : </div>
                                        {{ $data['tujuan_kegiatan_pembelajaran']['tujuan_pembelajaran_bab'] }}</li>
                                    <ul>
                                        <div class="text-gray-900 text-md font-semibold font-['Inter'] leading-[30px]">
                                            Tujuan Pembelajaran Topik
                                        </div>
                                        @foreach ($data['tujuan_kegiatan_pembelajaran']['tujuan_pembelajaran_topik'] as $key => $item)
                                            <li>{{ $key + 1 }}. {{ $item }}</li>
                                        @endforeach
                                    </ul>
                                    <!-- Add more details as needed -->
                                </ul>
                            </div>


                        @endisset
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function updateCharacterCount(textarea) {
            var characterCountElement = document.getElementById('characterCount');
            var currentCount = textarea.value.length;
            characterCountElement.textContent = currentCount + '/50';
        }
    </script>



</body>

</html>
