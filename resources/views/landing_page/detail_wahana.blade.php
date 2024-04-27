@extends('landing_page.layout.app')
@section('title', 'Detail Wahana')
@section('content')
    <div class="container">
        <div class="row pt-5 mb-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="shadow-css img-fluid" src="{{ Storage::url($wahana->image) }}" alt="">
                    </div>
                    <div class="col-lg-12">
                        <div class="p-3 bg-white">
                            <h4>{{ $wahana->nama }}</h4>
                            <p class="mt-2">{{ $wahana->deskripsi }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-lg-3 border-right text-center">
                                    <h6>Jam Buka</h6>
                                    <h5>--</h5>
                                </div>
                                <div class="col-lg-3 border-right text-center">
                                    <h6>Jam Tutup</h6>
                                    <h5>--</h5>
                                </div>
                                <div class="col-lg-3 border-right text-center">
                                    <h6>Status</h6>
                                    <h5>{{ $wahana->status }}</h5>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <h6>Harga Tiket</h6>
                                    <h5>Rp. {{ $wahana->harga }},-</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-lg-4 mr-5">
                                    <span class="badge badge-dark p-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span class="text-sm">Harga tiket dapat berubah sewaktu-waktu</span>
                                    </span>
                                </div>
                                <div class="col-lg-4">
                                    <span class="badge badge-dark p-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span class="text-sm">Obyek wisata dapat tutup sewaktu-waktu</span>
                                    </span>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <span class="badge badge-dark p-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span class="text-sm">Jam operasional dapat berubah sewaktu-waktu</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <a href="/login"><button class="btn btn-primary">Pesan</button></a>
                {{-- <div class="card bg-success p-3 text-white">
                    <h2 class="text-center">Pesan Tiket</h2>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="jenis-wahana">Jenis Wahana</label>
                            <select class="form-control" id="jenis-wahana" name="jenis-wahana">
                                <option value="wahana-1">Wahana 1</option>
                                <option value="wahana-2">Wahana 2</option>
                                <option value="wahana-3">Wahana 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <select class="form-control" id="jenis-wahana" name="jenis-wahana">
                                <option value="wahana-1">Wahana 1</option>
                                <option value="wahana-2">Wahana 2</option>
                                <option value="wahana-3">Wahana 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="total-tiket">Total Tiket</label>
                            <input type="number" class="form-control" id="total-tiket" name="total-tiket" min="1"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Pesan Tiket</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>

@endsection
