@extends('layouts.app')
@section('title', 'Jadwal')
@section('heading', 'Jadwal')
@section('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm btn-add">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Status</td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->date }}</td>
                                <td>
                                    @if ($data->status == 'open')
                                        <span class="badge badge-success">{{ $data->status }}</span>
                                    @elseif($data->status == 'close')
                                        <span class="badge badge-danger">{{ $data->status }}</span>
                                    @else
                                        {{ $data->status }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('jadwal.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="javascript:void()" class="btn btn-warning btn-sm btn-circle btn-edit"
                                            data-id="{{ $data->id }}" data-name="{{ $data->date }}"><i
                                                class="fas fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm btn-circle"
                                            onclick="return confirm('Yakin');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name">Date</label>
                            <input type="date" class="form-control" id="name" name="date" required />
                        </div>
                        <div class="form-group">
                            <label>Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_open" name="status"
                                    value="open" checked>
                                <label class="form-check-label" for="status_open">Open</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_close" name="status"
                                    value="close">
                                <label class="form-check-label" for="status_close">Close</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Kembali
                        </button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
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

        $(".btn-add").click(function() {
            $("#modal").modal("show");
            $(".modal-title").html("Tambah Jadwal");
            $("#id").val("");
            $("#name").val("");
        });

        $("#dataTable").on("click", ".btn-edit", function() {
            let id = $(this).data("id");
            let name = $(this).data("name");
            let status = $(this).data("status");
            console.log(id);
            $("#modal").modal("show");
            $(".modal-title").html("Edit Jadwal");
            $("#id").val(id);
            $("#name").val(name);
            $("#status").val(status);
        });
    </script>
@endsection
