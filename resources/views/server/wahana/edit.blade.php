@extends('layouts.app')
@section('title', 'Edit Wahana')
@section('heading', 'Edit Wahana')
@section('styles')
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 2;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d1d3e2;
            border-radius: .35rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #6e707e;
            line-height: 28px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            padding-left: 0;
            padding-right: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-top: -2px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + .75rem + 2px);
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="card shadow mb-4 mt-2">
        <form action="{{ route('wahana.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <input type="hidden" name="id" value="{{ $wahana->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $wahana->nama }}" id="name" name="nama"
                        placeholder="Name Wahana" required />
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $wahana->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="kode">Harga per Tiket</label>
                    <input type="number" class="form-control" value="{{ $wahana->harga }}" id="kode" name="harga"
                        placeholder="Rp, 15.000,-" required />
                </div>
                <div class="form-group">
                    <label for="kode">Stok</label>
                    <input type="number" class="form-control" value="{{ $wahana->stok }}" id="kode" name="stok"
                        placeholder="50 tiket" required />
                </div>
                <div class="form-group">
                    <label>Status</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="status_open" name="status" value="open"
                            checked>
                        <label class="form-check-label" for="status_open">Open</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="status_close" name="status" value="close">
                        <label class="form-check-label" for="status_close">Close</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dokumentasi">Dokumentasi</label>
                    <input type="file" class="form-control-file" id="dokumentasi" name="image" accept="image/*" />
                </div>
                <img src="{{ Storage::url($wahana->image) }}" alt="" style="max-width: 200px;">
            </div>
            <div class="card-footer">
                <a href="{{ route('wahana.index') }}" class="btn btn-warning mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        if (jQuery().select2) {
            $(".select2").select2();
        }

        function inputNumber(e) {
            const charCode = (e.which) ? e.which : w.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        };
    </script>
@endsection
