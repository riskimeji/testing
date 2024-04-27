@extends('landing_page.layout.app')
@section('title', 'Home')
@section('content')
    <div class="background-container">
        <div class="col-lg-6">
            <div class="content">
                <h1>Welcome to Wahana Bukit Cinangkiak</h1>
                <p>Welcome to the official website for booking tickets to Wahana Bukit Cinangkiak. We're delighted to
                    offer
                    you an easy and convenient way to reserve your tickets online. Explore our breathtaking attractions
                    and
                    plan your visit today!</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card bg-success p-3 text-white mx-5">
                <h2 class="text-center">Pesan Tiket</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="jenis-wahana">Jenis Wahana</label>
                        <select class="form-control" id="jenis-wahana" name="wahana_id">
                            @foreach ($wahana as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->harga }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <select class="form-control" id="jenis-wahana" name="jadwal_id">
                            @foreach ($jadwal as $item)
                                <option value="{{ $item->id }}">
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->formatLocalized('%A, %d %B %Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total-tiket">Jumlah Tiket</label>
                        <input type="number" class="form-control" id="total-tiket" name="total-tiket" min="1"
                            required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="total-tiket">Total Harga</label>
                        <input type="number" class="form-control" value="0" readonly id="total-harga"
                            name="total-tiket" min="1" required>
                    </div> --}}
                </form>
                <a href="/dashboard">
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </a>
            </div>
        </div>
    </div>
    <div class="mt-3 mx-5 text-center">
        <div class="card bg-success px-3 py-3 text-white shadow-lg rounded">
            <h4>Akses Informasi</h4>
            <p>Informasi terkait aplikasi Tiket Wahana Bukik Cinangkiak dapat dilihat pada laman instagram berikut.
            </p>
            <div class="row mx-auto">
                <button class="btn btn-info mr-2">Instagram</button>
                <button class="btn btn-info">WhatsApp</button>
            </div>
            <p class="mt-2">Surabaya Tourism Information Center
                Jl. Gubernur Suryo No. 15, Komplek Alun-alun Surabaya</p>
        </div>
    </div>
    <div class="mt-4 mx-5 mb-5">
        <h2 class="text-center">Jelajahi Wisata Bukik Cinangkiak</h2>
        @foreach ($wahana as $item)
            <div class="card" style="width: 18rem;">
                <a href="{{ route('detail-wahana', $item->id) }}">
                    <div class="card-img-top"
                        style="background-image: url('{{ Storage::url($item->image) }}'); height: 200px; background-size: cover;">
                    </div>
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama }}</h5>
                    <span class="badge {{ $item->status === 'open' ? 'badge-success' : 'badge-danger' }}">
                        {{ $item->status }}
                    </span>
                    <p class="card-text">{{ $item->deskripsi }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
