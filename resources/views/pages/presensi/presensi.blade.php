@extends('layouts.app')

@section('title', 'Presensi')

@section('css')

    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="modal fade" id="tambahPresensi" tabindex="-1" role="dialog" aria-labelledby="tambahPresensiLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPresensiLabel">Tambah Presensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('presensi') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="id_detail_user">Nama Pegawai</label>
                                <select class="form-control" id="id_detail_user" name="id_detail_user">
                                    @foreach ($pegawai as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }} - {{ $data->user->jabatan->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" value="08:00:20">
                            </div>

                             <div class="form-group">
                                <label for="jam_keluar">Jam Keluar</label>
                                <input type="text" class="form-control" id="jam_keluar" name="jam_keluar" value="17:23:20">
                            </div>
                            
                         </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ubahPresensi" tabindex="-1" role="dialog" aria-labelledby="tambahPresensiLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPresensiLabel">Ubah Presensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('presensi') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="nama_Presensi">Nama Presensi</label>
                                <input type="text" class="form-control" id="nama_Presensi" name="nama_Presensi">
                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="row mb-3">
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Data Presensi</h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#tambahPresensi">
                    Tambah Presensi
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead class="bg-primary text-white text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama pegawai</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($presensi as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data['detailUser']['nama'] }}</td>
                                            <td>{{ $data['tanggal'] }}</td>
                                            <td>{{ $data['jam_masuk'] }}</td>
                                            <td>{{ $data['jam_keluar'] }}</td>
                                            {{-- <td colspan="3">
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    onclick="fungsiEdit('{{ $data['id'] }}|{{ $data['nama_Presensi'] }}|')"
                                                    data-toggle="modal" data-target="#ubahPresensi">
                                                   Ubah
                                                </button>

                                                <form action="{{ url('Presensi/' . $data['id']) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function fungsiEdit(data) {
            var data = data.split('|');
            $('#ubahPresensi form').attr('action', "{{ url('presensi') }}/" + data[0]);
            $('#ubahPresensi .modal-body #nama_Presensi').val(data[1]);
        }
    </script>
@endsection
