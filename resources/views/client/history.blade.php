@extends('layouts.app')
@section('title', 'History')
@section('styles')
    <style>
        a:hover {
            text-decoration: none;
        }

        .card-body {
            padding: .5rem 1rem;
            border-bottom: 1px solid #e3e6f0;
        }

        .img-card {
            /* border: 1px solid #ddd; */
            /* border-radius: 4px; */
            /* padding: 5px; */
            width: 80px;
        }

        .custom-bg {
            background-color: #192b4f;
            border-radius: 4px;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12" style="margin-top: -15px">
            <a href="{{ url('/') }}" class="text-white btn"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
            <div class="row mt-2">
                @if ($history->count() > 0)
                    @foreach ($history as $data)
                        <div class="col-lg-6 mb-4">
                            <div class="card o-hidden border-0 shadow h-100">
                                <div class="card-body" data-toggle="modal" data-target="#exampleModal"
                                    data-bukti-pembayaran="{{ Storage::url($data->bukti_pembayaran) }}">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col font-weight-bold h5" style="margin: 0; color: #000;">
                                            {{ $data->wahana->nama }}
                                            @if ($data->status == 'pending')
                                                <span class="badge badge-warning ml-2">Sedang Diproses</span>
                                            @elseif ($data->status == 'sukses')
                                                <span class="badge badge-success ml-2">Sudah Dibayar</span>
                                            @else
                                                <span class="badge badge-danger ml-2">Dibatalkan</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p style="margin: 0; color:#000;">
                                        {{ date('l, d F Y H:i', strtotime($data->tanggal_pesan)) }} WIB</p>
                                </div>
                                @if ($data->status == 'sukses')
                                    <div class="card-footer">
                                        <div class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tiketModal"
                                            data-image-pembayaran="{{ Storage::url($data->wahana->image) }}"
                                            data-jadwal="{{ $data->jadwal->date }}" data-title="{{ $data->wahana->nama }}"
                                            data-kode-tiket="{{ $data->kode_tiket }}"
                                            data-kode-transaksi="{{ $data->kode_transaksi }}"
                                            data-tanggal-pesan="{{ date('l, d F Y H:i', strtotime($data->tanggal_pesan)) }}">
                                            Lihat
                                            Tiket</div>
                                    </div>
                                @else
                                    <div class="card-footer">
                                        <a href="{{ route('transaksi.show', $data->kode_transaksi) }}"
                                            class="btn btn-primary btn-sm disabled">Proses</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 mb-4">
                        <div class="card o-hidden border-0 shadow h-100 py-2">
                            <div class="card-body text-center">
                                <h3 class="text-gray-900 font-weight-bold">Tidak ada pemesanan</h3>
                                <p class="text-muted">Silahkan lakukan pemesanan ticket terlebih dahulu.</p>
                                <a href="{{ url('/') }}" class="btn btn-primary"
                                    style="font-size: 16px; border-radius: 10rem;">
                                    Cari Ticket
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="buktiPembayaran" src="" alt="Bukti Pembayaran" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tiketModal" tabindex="-1" role="dialog" aria-labelledby="tiketModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tiketModalLabel">Tiket Anda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-bg rounded container p-3">
                        <h5 id="title" class="text-center pt-2 text-uppercase font-weight-bold" style="color: #cab258;">
                        </h5>
                        <div class="row">
                            <div class="col-sm ml-5">
                                <img id="buktiPembayaran2" class="img-card" src="" alt="Bukti Pembayaran">
                            </div>
                            <div class="col-sm-8 text-white">
                                <span>Kode Transaksi: <span id="kode-transaksi"></span></span><br>
                                <span>Jadwal: <span id="jadwal"></span></span><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="barcode-container text-center">

                    </div>
                    <div class="text-center">
                        <button onclick="downloadBarcodes()" class="btn btn-primary mt-3">Download
                            Barcodes</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var buktiPembayaran = button.data(
                    'bukti-pembayaran');
                console.log(buktiPembayaran)
                var modal = $(this);
                modal.find('#buktiPembayaran').attr('src', buktiPembayaran);
            });
        });

        // $(document).ready(function() {
        //     $('#tiketModal').on('show.bs.modal', function(event) {
        //         var button = $(event.relatedTarget);
        //         var buktiPembayaran = button.data('image-pembayaran');
        //         var jadwal = button.data('jadwal');
        //         var kodeTiket = button.data('kode-tiket');
        //         var kodeTiketArray = kodeTiket.split(',');
        //         var barcodeContainer = modal.find('.barcode-container');
        //         barcodeContainer.empty();
        //         var kodeTransaksi = button.data('kode-transaksi');
        //         var title = button.data('title');
        //         var modal = $(this);
        //         kodeTiketArray.forEach(function(kode) {
        //             var canvas = document.createElement('canvas');
        //             JsBarcode(canvas, kode.trim(), {
        //                 format: 'CODE128',
        //                 displayValue: false
        //             });
        //             barcodeContainer.append(canvas);
        //         });
        //         modal.find('#kode-tiket').text(kodeTiket);
        //         modal.find('#buktiPembayaran2').attr('src', buktiPembayaran);
        //         modal.find('#jadwal').text(jadwal);
        //         modal.find('#title').text(title);
        //         modal.find('#kode-transaksi').text(kodeTransaksi);
        //     });
        // });
        $(document).ready(function() {
            $('#tiketModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var kodeTiket = button.data('kode-tiket');
                var kodeTiketArray = kodeTiket.split(',');
                var buktiPembayaran = button.data('image-pembayaran');
                var jadwalTimestamp = button.data('jadwal');
                var jadwalDate = new Date(jadwalTimestamp);
                var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                var namaHariIndonesia = namaHari[jadwalDate
                    .getDay()];
                var title = button.data('title');
                var kodeTransaksi = button.data('kode-transaksi');
                var modal = $(this);
                var barcodeContainer = modal.find('.barcode-container');
                barcodeContainer.empty();

                kodeTiketArray.forEach(function(kode) {
                    var canvas = document.createElement('canvas');
                    JsBarcode(canvas, kode.trim(), {
                        format: 'CODE128',
                        displayValue: false
                    });
                    barcodeContainer.append(canvas);
                });
                modal.find('#kode-tiket').text(kodeTiket);
                modal.find('#buktiPembayaran2').attr('src', buktiPembayaran);
                modal.find('#jadwal').text(namaHariIndonesia + ', ' + formatDate(jadwalDate));
                modal.find('#title').text(title);
                modal.find('#kode-transaksi').text(kodeTransaksi);
            });
        });

        function formatDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();

            // Tambahkan '0' di depan jika hari atau bulan hanya satu digit
            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }

            return day + '-' + month + '-' + year;
        }

        function downloadBarcodes() {
            var barcodeCanvases = document.querySelectorAll('.barcode-container canvas');
            var link = document.createElement('a');
            barcodeCanvases.forEach(function(canvas, index) {
                var imgData = canvas.toDataURL('image/png');
                link.href = imgData;
                link.download = 'barcode_' + (index + 1) + '.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }
    </script>

@endsection
