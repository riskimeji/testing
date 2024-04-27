@extends('layouts.app')
@section('title', 'Home')
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
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form method="GET" action="{{ route('mendetail') }}" class="user">
                        @csrf
                        <div class="form-group">
                            <label for="category">Wahana</label><br>
                            <select class="select2 form-control" id="category" name="wahana_id" required>
                                <option value="" disabled selected>-- Pilihg Wahana --</option>
                                @foreach ($wahana as $val)
                                    <option value="{{ $val->id }}">{{ $val->nama }} - ( {{ $val->harga }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start">Jadwal</label><br>
                            <select class="select2 form-control" id="start" name="jadwal_id" required>
                                <option value="" disabled selected>-- Pilih Jadwal --</option>
                                @foreach ($jadwal as $item)
                                    <option value="{{ $item->id }}">
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d', $item->date)->formatLocalized('%A, %d %B %Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="total-tiket">Jumlah Tiket</label>
                            <input type="number" class="form-control" id="total-tiket" name="jumlah_tiket" min="1"
                                required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="total-tiket">Total Harga</label>
                            <input type="number" class="form-control" value="0" readonly id="total-harga"
                                name="total-tiket" min="1" required>
                        </div> --}}
                        <button type="submit" class="btn btn-primary btn-user btn-block mt-4" style="font-size: 16px">
                            Pesan Tiket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        if (jQuery().select2) {
            $(".select2").select2();
        }
    </script>
@endsection
