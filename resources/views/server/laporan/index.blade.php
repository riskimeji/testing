@extends('layouts.app')
@section('title', 'Transaksi')
@section('heading', 'Transaksi')
@section('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <style>
        thead>tr>th,
        tbody>tr>td {
            vertical-align: middle !important;
        }

        .card-title {
            float: left;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 0;
        }

        .card-text {
            clear: both;
        }

        small {
            font-size: 80%;
            font-weight: 400;
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode Pemesanan</td>
                            <td>Wahana</td>
                            <td>Penumpang</td>
                            <td>Jadwal</td>
                            <td>Status</td>
                            <td>Total Bayar</td>
                            <td>Kode Tiket</td>
                            <td>Pembayaran</td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h5 class="card-title">{!! DNS1D::getBarcodeHTML($data->kode_transaksi, 'C128', 2, 30) !!}</h5>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            {{ $data->kode_transaksi }}
                                        </small>
                                    </p>
                                </td>
                                <td>
                                    <h5 class="card-title">{{ $data->wahana->nama }}</h5>
                                    {{-- <p class="card-text">
                                        <small class="text-muted">
                                            {{ $data->rute->start }} - {{ $data->rute->end }}
                                        </small>
                                    </p> --}}
                                </td>
                                <td>
                                    <h5 class="card-title">{{ $data->user->name }}</h5>
                                    {{-- <p class="card-text">
                                        <small class="text-muted">
                                            Kode Kursi : {{ $data->kursi }}
                                        </small>
                                    </p> --}}
                                </td>
                                <td>
                                    <h5 class="card-title">{{ $data->jadwal->date }}</h5>
                                </td>
                                <td>
                                    @if ($data->status == 'sukses')
                                        <span class="badge badge-success">{{ $data->status }}</span>
                                    @elseif($data->status == 'batal')
                                        <span class="badge badge-danger">{{ $data->status }}</span>
                                    @else
                                        <span class="badge badge-primary">{{ $data->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <h5 class="card-title">{{ $data->total_bayar }}</h5>
                                </td>
                                <td>
                                    <h5 class="card-title">{{ $data->kode_tiket }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal"
                                        data-bukti-pembayaran="{{ Storage::url($data->bukti_pembayaran) }}">
                                        Bukti Pembayaran
                                    </button>
                                </td>
                                @if ($data->status == 'pending')
                                    <td>
                                        <a href="{{ route('update.acc', $data->kode_transaksi) }}"
                                            class="btn btn-success btn-circle">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('update.dec', $data->kode_transaksi) }}"
                                            class="btn btn-danger btn-circle">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                @else
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="buktiPembayaranModal" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var buktiPembayaranUrl = button.data(
                'bukti-pembayaran'); // Ambil URL gambar dari atribut data-bukti-pembayaran

            var modal = $(this);
            modal.find('#buktiPembayaranModal').attr('src',
                buktiPembayaranUrl); // Atur src gambar modal dengan URL bukti pembayaran
        });
    </script>

@endsection
