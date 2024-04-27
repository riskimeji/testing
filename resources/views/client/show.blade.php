@extends('layouts.app')
@section('title', $wahana->nama)
@section('styles')
    <style>
        a:hover {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12" style="margin-top: -15px">
            <a href="{{ url('/') }}" class="text-white btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="card">
                        <img src="{{ Storage::url($wahana->image) }}" alt="">
                        <div class="card-body">
                            <h4 class="text-dark">{{ $wahana->nama }}</h4>
                            <p>{{ $wahana->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Total Harga: {{ $total_harga }}</h5>
                            <h5>Jumlah Tiket: {{ $jumlah_tiket }}</h5>
                            <form action="{{ route('bayar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="total_harga" value="{{ $total_harga }}">
                                <input type="hidden" name="jumlah_tiket" value="{{ $jumlah_tiket }}">
                                <input type="hidden" name="wahana_id" value="{{ $wahana->id }}">
                                <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                <div class="form-group">
                                    <label for="payment_method">Pilih Metode Pembayaran</label>
                                    <select class="form-control" id="payment_method" name="payment_id">
                                        @foreach ($payment as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                    <input type="file" class="form-control-file" id="bukti_pembayaran"
                                        name="bukti_pembayaran" accept="image/*" required />
                                </div>
                                <h5>Jumlah yang harus di bayar: {{ $total_harga }}</h5>
                                <button type="submit" class="btn btn-primary">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }
    </script>
@endsection
