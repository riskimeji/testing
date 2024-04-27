@extends('landing_page.layout.app')
@section('title', 'Kontak Kami')
@section('content')
    <div class="text-center mt-3">
        <h5>Kontak Kami</h5>
        <p>Informasi kontak admin Tiket Wahana Bukik Cinangkak dan form feedback yang dapat dilihat oleh admin.</p>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row m-3 bg-white shadow-css">
            <div class="col-md-8 p-4">
                <h5>Kirim Pesan</h5>
                <form>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan Nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan Email Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Masukkan Pesan Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
            <div class="col-md-4 bg-success text-white p-4">
                <h5 class="card-title text-center">Informasi Kontak</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> Alamat: Jl. Contoh No. 123, Kota Contoh</li>
                    <li><i class="fas fa-phone mt-3"></i> Nomor HP: 1234567890</li>
                    <li><i class="fas fa-envelope mt-3"></i> Email: example@example.com</li>
                </ul>
                <div class="">
                    <h5 class="card-title text-center mt-4">Sosial Media</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
