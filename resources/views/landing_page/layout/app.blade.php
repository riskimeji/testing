<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wahana Bukik Cinangkiak - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .background-container {
            width: 100%;
            height: 700px;
            /* Atur tinggi div sesuai kebutuhan */
            background-image: url('https://images.unsplash.com/photo-1678579436758-3cbdb5e602db?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            background-color: #f2f2f2;
        }

        .content {
            color: white;
            text-align: center;
            margin-right: 80px;
            margin-left: 80px;
        }

        .contact-info {
            list-style: none;
            padding: 0;
        }

        .contact-info-item {
            margin-bottom: 10px;
        }

        .contact-info-item i {
            margin-right: 5px;
        }

        .shadow-css {
            /* Shadow dengan ukuran default */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Horizontal-offset Vertical-offset Blur Spread-color */

            /* Atau gunakan shadow dengan ukuran yang disesuaikan */
            /* box-shadow: h-shadow v-shadow blur spread color; */
            /* h-shadow: Panjang bayangan pada sumbu X (horizontal). Positif berarti bayangan di sebelah kanan elemen, negatif berarti bayangan di sebelah kiri elemen. */
            /* v-shadow: Panjang bayangan pada sumbu Y (vertical). Positif berarti bayangan di bawah elemen, negatif berarti bayangan di atas elemen. */
            /* blur: Opsional. Jumlah blur. Semakin besar nilai, semakin blur bayangan. */
            /* spread: Opsional. Jumlah ekspansi bayangan. */
            /* color: Warna bayangan. */

            /* Contoh bayangan dengan penyesuaian */
            /* box-shadow: 2px 2px 8px 0 rgba(0, 0, 0, 0.2); */
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success p-3 shadow-css">
        <a class="navbar-brand text-white font-weight-bold ml-5" href="/landing-page">Bukik Cinangkak</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav mr-5">
                <li class="nav-item mr-3">
                    <a class="nav-link font-weight-bold {{ request()->is('landing-page') ? 'text-dark' : 'text-white' }}"
                        href="/landing-page">Beranda</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link font-weight-bold {{ request()->is('faq') ? 'text-dark' : 'text-white' }}"
                        href="faq">FAQ</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link font-weight-bold {{ request()->is('kontak-kami') ? 'text-dark' : 'text-white' }}"
                        href="kontak-kami">Kontak Kami</a>
                </li>
                @auth
                    <li class="nav-item mr-3">
                        <a class="btn btn-secondary px-3" href="/history">Pesanan Saya</a>
                    </li>
                @else
                    <li class="nav-item mr-3">
                        {{-- <button type="button" class="btn btn-secondary px-3">Login</button> --}}
                        <a class="btn btn-secondary px-3" href="/login">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </nav>
    <div>
        @yield('content')
    </div>
    <footer class="footer bg-success">
        <div class="container py-3 text-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-center">Tentang Kami</h5>
                    <p>Deskripsi singkat tentang wahana Bukit Cinangkiak. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-center">Sosial Media</h5>
                    <div class="social-icons text-center mt-5 ml-4">
                        <i class="fab fa-instagram fa-2x mr-4"></i>
                        <i class="fab fa-whatsapp fa-2x mr-4"></i>
                        <i class="fab fa-facebook fa-2x mr-4"></i>
                    </div>
                </div>
            </div>
            <div class="">
                <h5>Kontak</h5>
                <div class="contact-info">
                    <div class="contact-info-item"><i class="fas fa-envelope"></i> Email: example@example.com</div>
                    <div class="contact-info-item"><i class="fas fa-phone"></i> Nomor HP: 1234567890</div>
                    <div class="contact-info-item"><i class="fas fa-map-marker-alt"></i> Alamat: Jl. Contoh No. 123,
                        Kota Contoh</div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>
