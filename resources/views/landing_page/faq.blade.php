@extends('landing_page.layout.app')
@section('title', 'Kontak Kami')
@section('content')
    <div class="text-center mt-3">
        <h5>Frequently Asked Questions</h5>
        <p>Daftar pertanyaan dari pengguna Tiket Wahana Bukik Cinangkiak yang sering ditanyakan beserta jawabannya.</p>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row m-3">
            <div class="col-md-4 mb-5 text-center">
                <img src="https://tiketwisata.surabaya.go.id/assets/front/images/faq.svg" alt="" width="350x">
            </div>
            <div class="col-md-8 bg-success p-4 shadow-css">
                <h5 class="card-title text-center text-white">FAQ</h5>
                <div class="accordion" id="faqAccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bagaimana cara memesan tiket wahana?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#faqAccordion">
                            <div class="card-body text-dark">
                                Anda dapat memesan tiket wahana melalui situs web kami dengan mengklik tombol "Pesan Tiket"
                                dan mengisi formulir pemesanan.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apakah saya dapat membatalkan pemesanan tiket?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                            <div class="card-body text-dark">
                                Ya, Anda dapat membatalkan pemesanan tiket dengan menghubungi layanan pelanggan kami paling
                                lambat 24 jam sebelum waktu keberangkatan yang terjadwal.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
