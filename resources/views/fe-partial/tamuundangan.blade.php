
<!DOCTYPE html>
<html lang="en" data-theme="light" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan</title>

    <link rel="shortcut icon" href="{{ asset('/') }}assets/src/img/primary-background.jpg" type="image/x-icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Work+Sans:wght@100;300;400;600;700&display=swap"rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Countdown -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/src/css/simplyCountdown.theme.default.css" />
    <script src="{{ asset('/') }}assets/src/js/simplyCountdown.min.js"></script>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- <link href="dist/output.css" rel="stylesheet"> -->
    <link href="{{ asset('/') }}assets/src/css/build.css" rel="stylesheet">
</head>

<body class="font-workSans scrollbarStyle">
    <!-- Start Hero -->
    <section id="hero" class="w-full h-full min-h-screen p-3 mx-auto text-center flex justify-center items-center {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} bg-center bg-auto" style="background-image: url('{{ asset('/') }}assets/src/img/primary-background.jpg'); color: {{ $configs['warna teks'] ?? '#E91E63' }};">
        <div>
            <h4 class="text-lg sm:text-xl lg:text-3xl drop-shadow-md animate__animated animate__fadeInLeft">
                Kepada <span>{{ $undangan->pronoun ?? 'Bapak/Ibu/Saudara/i' }} {{ $undangan->nama ?? '' }},</span>
            </h4>
            <h1 class="my-3 font-sacramento text-5xl sm:text-7xl lg:text-8xl drop-shadow-md animate__animated animate__fadeInRight">{{ $configs['panggilan laki'] ?? 'Nama Laki-laki' }} & {{ $configs['panggilan perempuan'] ?? 'Nama perempuan' }}</h1>
            <p class="mb-3 text-base sm:text-lg lg:text-2xl drop-shadow-md animate__animated animate__fadeInLeft">Akan melangsungkan resepsi pernikahan dalam:</p>
            <div class="simply-countdown" id="simply-countdown"></div>
            <a href="#home" class="mt-10 inline-block px-3 py-1.5 rounded-lg shadow-sm shadow-bgPrimary bg-pinkPrimary text-base sm:text-lg lg:text-xl text-white hover:text-pinkPrimary hover:bg-white duration-200 transition animate__animated animate__pulse animate__infinite" onclick="enableScroll()">Lihat Undangan</a>
        </div>
    </section>
    <!-- End Hero -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif


    <!-- Start Navbar -->
    <div class="navbar bg-white/30 backdrop-blur-sm sticky top-0 lg:px-[5%] xl:px-[10%] py-4 z-50">
        <div class="navbar-start">
            <button class=" {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} btn btn-ghost normal-case text-4xl lg:text-5xl font-sacramento font-semibold hover:bg-transparent" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Wedding {{ $configs['panggilan laki'] ?? 'Nama Laki-laki' }} & {{ $configs['panggilan perempuan'] ?? 'Nama perempuan' }}</button>
        </div>
        <div class="navbar-end flex lg:hidden">
            <div class="dropdown dropdown-left">
                <!-- Mobile -->
                <label tabindex="0" onclick="my_modal_2.showModal()" class="btn btn-ghost block lg:hidden" id="hamburger">
                    <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
                </label>
                <dialog id="my_modal_2" class="modal modal-middle">
                <div class="modal-box">
                    <form method="dialog">
                        <button id="hamburger2" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <ul tabindex="0" class="flex justify-center items-center flex-col p-3 gap-y-3 text-base sm:text-lg">
                        <li><a href="#home" class="link link-hover">Home</a></li>
                        <li><a href="#info" class="link link-hover">Info</a></li>
                        <li><a href="#story" class="link link-hover">Story</a></li>
                        <li><a href="#gallery" class="link link-hover">Gallery</a></li>
                        <li><a href="#rsvp" class="link link-hover">RSVP</a></li>
                        <li><a href="#gifts" class="link link-hover">Gifts</a></li>
                    </ul>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button id="hamburger3">close</button>
                </form>
                </dialog>
            </div>
        </div>
        <!-- Desktop -->
        <div class="lg:navbar-center xl:navbar-end hidden lg:flex">
            <ul class="menu menu-horizontal px-1 uppercase text-lg">
                <li><a href="#home">Home</a></li>
                <li><a href="#info">Info</a></li>
                <li><a href="#story">Story</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#rsvp">RSVP</a></li>
                <li><a href="#gifts">Gifts</a></li>
            </ul>
        </div>
    </div>
    <!-- End Navbar -->

    <!-- Start Home -->
    <section id="home" class="bg-cover min-h-screen -mt-24 pt-60 pb-20" style="background-image: url({{ asset('/') }}assets/src/img/secondary-background.png);">
        <div class="container px-2 md:px-3 mx-auto">
            <div class="grid justify-center">
                <div class="grid-cols-8 md:grid-cols-12 text-center">
                    <h2 class="{{ $configs['warna teks'] ?? 'text-pinkPrimary' }} font-sacramento text-5xl sm:text-7xl lg:text-8xl font-bold animate__animated" id="home-title" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Acara Pernikahan</h2>
                    <h3 class="text-[#444] text-base sm:text-lg md:text-xl lg:text-2xl mb-4 animate__animated" id="home-subtitle">Diselenggarakan pada {{ \Carbon\Carbon::parse($configs['tanggal resepsi'])->translatedFormat('d F Y') }} di {{ $configs['kota'] ?? 'Nama Kota' }}, Provinsi {{ $configs['provinsi'] ?? 'Nama Provinsi' }}.</h3>
                    <p class="text-sm sm:text-base md:text-lg text-[#666] animate__animated" id="home-description">Oleh karena itu, dengan segala hormat, kami bermaksud untuk mengundang Bapak/Ibu/Saudara/i, untuk hadir pada acara pernikahan kami.</p>
                </div>
            </div>

            <div class="w-full items-center flex flex-col lg:flex-row lg:justify-between mt-24 gap-8">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="mr-3 sm:mr-5 xl:mr-10 text-right animate__animated" id="groom-info">
                            <h3 class="font-sacramento text-5xl {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} mb-1 md:mb-2" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">{{ $configs['laki'] ?? 'Nama Laki-laki' }}</h3>
                            <p class="text-sm sm:text-base md:text-lg mb-2 md:mb-4">{{ $configs['keterangan laki'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi ab quibusdam minima in asperiores maiores.' }}</p>
                            <p class="text-sm sm:text-base md:text-lg">Putra dari Bapak {{ $configs['nama bapak laki'] ?? 'Nama Bapak Laki-laki' }} <br> dan <br> Ibu {{ $configs['nama ibu laki'] ?? 'Nama Ibu Laki-laki' }}</p>
                        </div>
                        @if(!empty($configs['foto laki']))
                            <div class="animate__animated" id="groom-photo">
                                <img src="{{ asset('storage/' . ($configs['foto laki'])) }}" alt="Mempelai Laki-laki" class="rounded-full w-full">
                            </div>
                        @else
                            <div class="animate__animated" id="groom-photo">
                                <img src="{{ asset('/') }}assets/src/img/pp-1.jpg" alt="Mempelai Laki-laki" class="rounded-full w-full">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="hidden lg:flex items-center">
                </div>
                <div class="flex items-center">
                    <div class="flex items-center">
                        @if(!empty($configs['foto perempuan']))
                            <div class="animate__animated" id="bride-photo">
                                <img src="{{ asset('storage/' . ($configs['foto perempuan'])) }}" alt="Mempelai Perempuan" class="rounded-full w-full">
                            </div>
                        @else
                            <div class="animate__animated" id="bride-photo">
                                <img src="{{ asset('/') }}assets/src/img/pp-1.jpg" alt="Mempelai Perempuan" class="rounded-full w-full">
                            </div>
                        @endif
                        <div class="ml-3 sm:ml-5 xl:ml-10 text-left animate__animated" id="bride-info">
                            <h3 class="font-sacramento text-5xl {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} mb-1 md:mb-2" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">{{ $configs['perempuan'] ?? 'Nama Perempuan' }}</h3>
                            <p class="text-sm sm:text-base md:text-lg mb-2 md:mb-4">{{ $configs['keterangan perempuan'] ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi ab quibusdam minima in asperiores maiores.' }}</p>
                            <p class="text-sm sm:text-base md:text-lg">Putra dari Bapak {{ $configs['nama bapak perempuan'] ?? 'Nama bapak  Perempuan' }} <br> dan <br> Ibu {{ $configs['nama ibu perempuan'] ?? 'Nama Ibu Perempuan' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Home -->

    <!-- Start Info -->
    <section id="info" class="bg-bgPrimary text-white pt-40 pb-32">
        <div class="container mx-auto">
            <div class="text-center px-2 sm:px-10 xl:px-80">
                <h2 class="mb-10 {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} font-sacramento text-5xl sm:text-7xl lg:text-8xl font-bold animate__animated" id="info-title" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Informasi Acara</h2>
                <p class="text-sm sm:text-base md:text-lg animate__animated" id="info-description">{{ $configs['alamat'] ?? 'Nama Alamat' }} <br> {{ $configs['kota'] ?? 'Nama Kota' }}, Provinsi {{ $configs['provinsi'] ?? 'Nama Provinsi' }}</p>

                <!-- Menggunakan LeafletJS -->
                <!-- <div id="map" class="w-full h-[450px] my-5 rounded-2xl"></div> -->
                <!-- Menggunakan Google Maps -->
                <iframe class="w-full h-[450px] my-5 rounded-2xl animate__animated" id="info-map" src="{{ $configs['link embed google maps'] ?? 'google maps' }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                <a href="{{ $configs['link maps'] ?? 'maps' }}" target="_blank" class="btn btn-sm normal-case mb-5 hover:border-pinkPrimary hover:text-white hover:bg-pinkPrimary animate__animated" id="info-button">Klik untuk membuka peta</a>
                <p class="text-sm sm:text-base md:text-lg font-light animate__animated" id="info-note">Diharapkan tidak salah alamat dan tanggal. Manakala tiba-tiba ditujuan namun tidak ada tanda-tanda sedang dilangsungkan pernikahan, boleh jadi Anda salah jadwal atau tempat.</p>
            </div>

            <div class="mt-5 sm:mt-8 flex flex-wrap lg:flex-nowrap justify-center gap-x-6 gap-y-6 sm:gap-y-10 lg:gap-y-0 px-5">
                <div class="block rounded-lg bg-white/20 text-slate-50 text-center border border-white shadow-sm max-w-md md:max-w-lg xl:max-w-xl animate__animated" id="akad-info">
                    <div class="border-b-2 border-slate-50/40 px-6 py-3 uppercase tracking-widest">
                        Akad Nikah
                    </div>
                    <div class="p-6 text-base">
                        <div class="grid grid-cols-12 justify-center">
                            <div class="col-span-6">
                                <i class="ri-time-line text-xl block"></i>
                                <span>{{ $configs['jam akad'] ?? 'Jam Akad' }}</span>
                            </div>
                            <div class="col-span-6">
                                <i class="ri-calendar-todo-fill text-xl block"></i>
                                <span>{{ \Carbon\Carbon::parse($configs['tanggal akad'])->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t-2 border-slate-50/40 px-6 py-3 text-sm font-light">
                        Saat acara akad diharapkan untuk kondusif menjaga kekhidmatan dan kekhusyukan seluruh prosesi.
                    </div>
                </div>

                <div class="block rounded-lg bg-white/20 text-slate-50 text-center border border-white shadow-sm max-w-md md:max-w-lg xl:max-w-xl animate__animated" id="resepsi-info">
                    <div class="border-b-2 border-slate-50/40 px-6 py-3 uppercase tracking-widest">
                        Resepsi
                    </div>
                    <div class="p-6 text-base">
                        <div class="grid grid-cols-12 justify-center">
                            <div class="col-span-6">
                                <i class="ri-time-line text-xl block"></i>
                                <span>{{ $configs['jam resepsi'] ?? 'Jam Resepsi' }}</span>
                            </div>
                            <div class="col-span-6">
                                <i class="ri-calendar-todo-fill text-xl block"></i>
                                <span>{{ \Carbon\Carbon::parse($configs['tanggal resepsi'])->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t-2 border-slate-50/40 px-6 py-3 text-sm font-light">
                        Saat acara akad diharapkan untuk kondusif menjaga kekhidmatan dan kekhusyukan seluruh prosesi.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Info -->

    <!-- Start Story -->
    <section id="story" class="pt-40 pb-32">
        <div class="flex flex-col justify-center text-center px-2 sm:px-5 mb-5">
            <span class="uppercase text-[#666] text-sm tracking-[1px] mb-6 block">Bagaimana Cinta Kami Bersemi</span>
            <h2 class="mb-4 {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} font-sacramento text-5xl sm:text-7xl lg:text-8xl font-bold" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Cerita Kami</h2>
            <p class="text-base font-light">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam blanditiis molestias porro dicta adipisci officiis praesentium fugit illum? Repellendus, iure!</p>
        </div>

        <div class="flex justify-center lg:px-5 xl:px-0">
            <ul class="py-6 px-0 mt-4 relative before:top-0 before:bottom-0 before:absolute before:w-[1px] before:bg-[#ccc] before:left-1/2 sm:before:left-16 md:before:left-20 lg:before:left-1/2">
                @foreach($ceritaKamis as $index => $cerita)
                    <li class="mb-20 sm:mb-10 relative before:table after:table after:clear-both">
                        <div class="w-40 h-40 sm:w-36 sm:h-36 md:w-40 md:h-40 bg-[#ccc] sm:absolute sm:left-8 md:left-10 lg:left-1/2 top-4 lg:top-0 mx-auto mb-5 sm:mb-0 sm:ml-11 lg:ml-0 rounded-full sm:-translate-x-1/2 bg-cover bg-no-repeat bg-center {{ $index % 2 === 0 ? 'sm:arrow-story-inverted lg:arrow-story-inverted-lg' : 'sm:arrow-story-inverted' }}" style="background-image: url('{{ asset('storage/' . $cerita->foto) }}');"></div>
                        <div class="w-[90%] sm:w-[70%] lg:w-[40%] xl:w-[50%] mx-auto float-none sm:float-right {{ $index % 2 === 0 ? 'lg:float-left' : '' }} border border-[#ccc] rounded-lg p-3 sm:p-8 sm:relative bg-white {{ $index % 2 === 0 ? 'lg:arrow-story' : '' }} sm:right-4 md:right-7 lg:right-auto {{ $index % 2 === 0 ? 'xl:right-28' : 'xl:-right-28' }} text-center sm:text-left animate__animated {{ $index % 2 === 0 ? 'animate__fadeInLeft' : 'animate__fadeInRight' }}">
                            <div class="mb-2">
                                <h3 class="font-bold text-base sm:text-xl tracking-widest">{{ $cerita->judul }}</h3>
                                <span class="font-semibold text-sm sm:text-base text-[#666]">{{ \Carbon\Carbon::parse($cerita->tanggal)->format('j F Y') }}</span>
                            </div>
                            <div>
                                <p class="font-light text-[#444] text-sm sm:text-base">{{ $cerita->cerita }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- End Story -->

    <!-- Start Gallery -->
    <section id="gallery" class="pt-40 pb-32 bg-[#f5f5f5]">
        <div class="flex flex-col justify-center text-center px-2 sm:px-5 mb-5">
            <span class="uppercase text-[#666] text-sm tracking-[1px] mb-6 block">Memori Kisah Kami</span>
            <h2 class="mb-4 {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} font-sacramento text-5xl sm:text-7xl lg:text-8xl font-bold" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Galeri Foto</h2>
            <p class="text-base font-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores rem quod earum odit. Dolorem aspernatur, ea quidem necessitatibus fugit velit?</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 items-center justify-center gap-2 lg:gap-3 xl:gap-5 px-3 md:px-5 lg:px-10">
            @foreach ($galeris as $galeri)
                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Galeri Foto" class="w-full h-full rounded-lg hover:scale-105 transition">
            @endforeach
        </div>
    </section>




    <!-- End Gallery -->

    <!-- Start RSVP -->
    <section id="rsvp" class="bg-bgPrimary text-white pt-32 pb-32">
        <div class="flex flex-col justify-center text-center px-2 sm:px-5 mb-5">
            <h2 class="mb-5 sm:mb-10 {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} font-sacramento text-5xl md:text-6xl lg:text-7xl font-bold" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Konfirmasi Kehadiran</h2>
            <p class="text-sm sm:text-base md:text-lg text-white">Isi form di bawah ini untuk melakukan konfirmasi kehadiran.</p>
        </div>

        <form action="{{ route('kehadiran.store') }}" method="post" id="my-form" class="flex flex-col sm:flex-row justify-center items-center gap-x-3 px-5">
            @csrf
            <div class="form-control w-full max-w-xs">
                <label class="label" for="nama">
                    <span class="label-text text-lg text-white">Nama</span>
                </label>
                <input type="text" name="nama" id="nama" class="input input-bordered w-full max-w-xs text-black" required />
            </div>
            <div class="form-control w-full max-w-xs sm:w-24 sm:max-w-none">
                <label class="label" for="jumlah">
                    <span class="label-text text-lg text-white">Jumlah</span>
                </label>
                <input type="number" min="1" max="5" value="1" name="jumlah" id="jumlah" class="input input-bordered w-full max-w-xs sm:w-24 sm:max-w-none text-black" required />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label" for="status">
                    <span class="label-text text-lg text-white">Konfirmasi</span>
                </label>
                <select name="status" id="status" class="select select-bordered text-black" required>
                    <option disabled selected>Pilih Kehadiran!</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                </select>
            </div>
            <div class="form-control">
                <label class="label" for="status">
                    <span class="label-text text-lg text-transparent">Kehadiran</span>
                </label>
                <button type="submit" class="btn bg-pinkPrimary text-white border-pinkPrimary hover:text-pinkPrimary hover:bg-white hover:border-white">Kirim</button>
            </div>
        </form>

    </section>
    <!-- End RSVP -->

    <!-- Start Gifts -->
    <section id="gifts" class="pt-32 pb-32">
        <div class="flex flex-col justify-center text-center px-2 sm:px-5 mb-5">
            <span class="uppercase text-[#666] text-sm tracking-[1px] mb-6 block">Ungkapan Tanda Kasih</span>
            <h2 class="mb-4 {{ $configs['warna teks'] ?? 'text-pinkPrimary' }} font-sacramento text-5xl sm:text-7xl lg:text-8xl font-bold" style="color: {{ $configs['warna teks'] ?? '#E91E63' }};">Kirim Hadiah</h2>
            <p class="text-base font-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores rem quod earum odit. Dolorem aspernatur, ea quidem necessitatibus fugit velit?</p>
        </div>

        <div class="mx-5 sm:mx-auto rounded-md max-w-md md:max-w-xl lg:max-w-4xl border">
            <div class="overflow-x-auto">
                <table class="table text-center">
                    <tbody>
                        <tr class="border-b-0">
                            <th class="font-bold text-xl">{{ $configs['nama bank'] ?? 'Nama Bank' }}</th>
                        </tr>
                        <tr>
                            <th class="font-normal text-xl">{{ $configs['keterangan bank'] ?? 'Keterangan bank' }}</th>
                        </tr>

                        {{-- <tr class="border-b-0">
                            <th class="font-bold text-xl">Saweria</th>
                        </tr> --}}
                        {{-- <tr>
                            <th class="flex justify-center">
                                <img src="{{ asset('/') }}assets/src/img/saweria.png" alt="donasi saweria" class="w-[200px]">
                            </th>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- End Gifts -->

    <!-- Start Footer -->
    <footer class="footer footer-center p-10 bg-pinkPrimary text-white rounded">
        <nav class="grid grid-flow-col gap-4">
            <a href="#home" class="link link-hover">Home</a>
            <a href="#info" class="link link-hover">Info</a>
            <a href="#story" class="link link-hover">Story</a>
            <a href="#gallery" class="link link-hover">Gallery</a>
            <a href="#rsvp" class="link link-hover">RSVP</a>
            <a href="#gifts" class="link link-hover">Gifts</a>
        </nav>

        <aside>
            <p>2025 © All Rights Reserverd. Build with <span class="text-black">❤</span> by <a href="#" target="_blank" class="link link-hover font-semibold">Kami Wedding Organizer</a></p>
        </aside>
    </footer>
    <!-- End Footer -->

    <!-- Start Audio Player -->
    @php
        $audio = App\Models\Audio::getActiveAudio(); // Ambil audio yang aktif
    @endphp

    <div id="audio-container">
        <audio id="bgm" loop>
            @if($audio)
                <source src="{{ asset('storage/' . $audio->file_path) }}" type="audio/mp3">
            @else
                <source src="{{ asset('/') }}assets/src/audio/Boom Bap Flick - Quincas Moreira.mp3" type="audio/mp3">
            @endif
        </audio>

        <div id="icon-wrapper" class="w-16 h-16 text-6xl fixed bottom-10 right-8 cursor-pointer text-white opacity-50 mix-blend-difference animate-spin-slow origin-center justify-center items-center leading-[0] hidden">
            <i class="ri-disc-line"></i>
        </div>
    </div>

    <!-- End Audio Player -->

    <!-- <div class="h-[1000px]"></div> -->

    <script src="{{ asset('/') }}assets/src/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script Countdown -->
    <script>
        var tanggalResepsi = "{{ $configs['tanggal resepsi'] ?? '2024-01-01' }}";
        var tanggal = new Date(tanggalResepsi);

        simplyCountdown('.simply-countdown', {
            year: tanggal.getFullYear(),
            month: tanggal.getMonth() + 1,
            day: tanggal.getDate(),
            hours: 8,
            words: {
                days: { singular: 'hari', plural: 'hari' },
                hours: { singular: 'jam', plural: 'jam' },
                minutes: { singular: 'menit', plural: 'menit' },
                seconds: { singular: 'detik', plural: 'detik' }
            },
        });
    </script>

    <!-- Script lock scroll & audio -->
    <script>
        const rootElement = document.querySelector("html");
        const scrollbar = document.querySelector("body");
        const song = document.querySelector('#bgm');
        const iconWrapper = document.querySelector('#icon-wrapper');
        const iconAudio = document.querySelector('#icon-wrapper i');
        let isPlaying = false;

        function disableScroll() {
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

            window.onscroll = function() {
                window.scrollTo(scrollTop, scrollLeft);
            }
            rootElement.classList.remove("scroll-smooth");
            rootElement.classList.add("auto");

            scrollbar.classList.remove("scrollbarStyle");
            scrollbar.classList.add("scrollbar-none");
        }

        function enableScroll() {
            window.onscroll = function() {};
            rootElement.classList.remove("auto");
            rootElement.classList.add("scroll-smooth");

            scrollbar.classList.remove("scrollbar-none");
            scrollbar.classList.add("scrollbarStyle");

            playAudio();
        }

        function playAudio() {
            if (song) {
                song.volume = 0.2;
                song.play().catch(error => console.log("Autoplay gagal:", error));
                isPlaying = true;
                iconWrapper.classList.remove('hidden');
                iconWrapper.classList.add('flex');
            }
        }

        iconWrapper?.addEventListener("click", function() {
            if (song) {
                if (isPlaying) {
                    song.pause();
                    iconAudio.classList.remove('ri-disc-line');
                    iconAudio.classList.add('ri-pause-circle-line');
                } else {
                    song.play();
                    iconAudio.classList.remove('ri-pause-circle-line');
                    iconAudio.classList.add('ri-disc-line');
                }
                isPlaying = !isPlaying;
            }
        });

        // Aktifkan audio setelah halaman dimuat
        window.addEventListener("load", function() {
            if (song) {
                playAudio();
            }
        });

        // Nonaktifkan scroll saat pertama kali masuk
        disableScroll();

    </script>

    <!-- Script redirect form -->
    <script>
        window.addEventListener("load", function() {
            const form = document.getElementById('my-form');
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                const data = new FormData(form);
                const action = e.target.action;
                fetch(action, {
                    method: 'POST',
                    body: data,
                })
                .then(() => {
                    // alert("Konfirmasi kehadiran berhasil terkirim!");
                    Swal.fire({
                        icon: 'success',
                        title: 'Konfirmasi',
                        text: 'Konfirmasi kehadiran berhasil terkirim!',
                    })
                })
            });
        });
    </script>

    <!-- LeafletJS -->
    <script>
        // LeafletJS Map
        let map = L.map('map', { zoomControl: false }).setView([-7.3770262, 112.7413162], 20);
        L.tileLayer('https://api.maptiler.com/maps/bright-v2/{z}/{x}/{y}.png?key=ymJjhfOMl9vKscg4Yzu7', {
            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
        }).addTo(map);

        // map.touchZoom.disable();
        // map.doubleClickZoom.disable();
        // map.scrollWheelZoom.disable();
        // map.boxZoom.disable();
        map.keyboard.disable();

        let popup = L.popup({
                closeOnClick: false,
                autoClose: false,
                closeButton: false
            })
            .setLatLng([-7.3770262, 112.7413162])
            .setContent("GOR Soerokromo | Gedung Serba Guna")
            .openOn(map)
    </script>

    <!-- Script URL -->
    {{-- <script>
        const urlParams = new URLSearchParams(window.location.search);
        const nama = urlParams.get('n') || "";
        const pronoun = urlParams.get('p') || "Bapak/Ibu/Saudara/i";
        const namaSection = document.querySelector('#hero div h4 span');
        namaSection.innerText = `${pronoun} ${nama},` . replace(/ ,$/, ',');
        document.querySelector('#nama').value = nama;
    </script> --}}

    <script>
        document.addEventListener('scroll', function() {
            const homeSection = document.getElementById('home');
            const homeTitle = document.getElementById('home-title');
            const homeSubtitle = document.getElementById('home-subtitle');
            const homeDescription = document.getElementById('home-description');
            const groomInfo = document.getElementById('groom-info');
            const groomPhoto = document.getElementById('groom-photo');
            const brideInfo = document.getElementById('bride-info');
            const bridePhoto = document.getElementById('bride-photo');

            if (homeSection.getBoundingClientRect().top < window.innerHeight) {
                homeTitle.classList.add('animate__fadeInLeft');
                homeSubtitle.classList.add('animate__fadeInRight');
                homeDescription.classList.add('animate__fadeInLeft');
                groomInfo.classList.add('animate__fadeInLeft', 'animate__delay-1s');
                groomPhoto.classList.add('animate__zoomIn', 'animate__delay-1s');
                brideInfo.classList.add('animate__fadeInRight', 'animate__delay-1s');
                bridePhoto.classList.add('animate__zoomIn', 'animate__delay-1s');
            }
        });
    </script>

    <script>
        document.addEventListener('scroll', function() {
            const infoSection = document.getElementById('info');
            const infoTitle = document.getElementById('info-title');
            const infoDescription = document.getElementById('info-description');
            const infoMap = document.getElementById('info-map');
            const infoButton = document.getElementById('info-button');
            const infoNote = document.getElementById('info-note');
            const akadInfo = document.getElementById('akad-info');
            const resepsiInfo = document.getElementById('resepsi-info');

            if (infoSection.getBoundingClientRect().top < window.innerHeight) {
                infoTitle.classList.add('animate__fadeInLeft');
                infoDescription.classList.add('animate__fadeInRight');
                infoMap.classList.add('animate__zoomIn');
                infoButton.classList.add('animate__fadeInUp');
                infoNote.classList.add('animate__fadeInLeft');
                akadInfo.classList.add('animate__fadeInLeft', 'animate__delay-1s');
                resepsiInfo.classList.add('animate__fadeInRight', 'animate__delay-1s');
            }
        });
    </script>
    <script>
        document.addEventListener('scroll', function() {
            const storySection = document.getElementById('story');
            const storyItems = storySection.querySelectorAll('li > div:nth-child(2)');

            if (storySection.getBoundingClientRect().top < window.innerHeight) {
                storyItems.forEach((item, index) => {
                    item.classList.add(index % 2 === 0 ? 'animate__fadeInLeft' : 'animate__fadeInRight');
                });
            }
        });
    </script>
</body>

</html>
