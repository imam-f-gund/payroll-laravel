@extends('layouts.app')

@section('title', 'Tambahan')

@section('css')

    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="modal fade" id="tambahTambahan" tabindex="-1" role="dialog" aria-labelledby="tambahTambahanLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTambahanLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('tambahan') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="nama_tambahan">Nama Data</label>
                                <input type="text" class="form-control" id="nama_tambahan" name="nama_tambahan">
                            </div>
                            <div class="form-group">
                                <label for="persentase_tambahan">Persentase Potongan</label>
                                <input type="number" class="form-control" id="persentase_tambahan" name="persentase_tambahan">
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

        <div class="modal fade" id="ubahTambahan" tabindex="-1" role="dialog" aria-labelledby="tambahTambahanLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTambahanLabel">Ubah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('tambahan') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="nama_tambahan">Nama Data</label>
                                <input type="text" class="form-control" id="nama_tambahan" name="nama_tambahan">
                            </div>
                            <div class="form-group">
                                <label for="persentase_tambahan">Persentase Potongan</label>
                                <input type="number" class="form-control" id="persentase_tambahan" name="persentase_tambahan">
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
                <h1 class="h3 mb-2 text-gray-800">Data Tambahan</h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#tambahTambahan">
                    Tambah Tambahan
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
                                        <th>Nama</th>
                                        <th>Potongan</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($tambahan as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data['nama_tambahan'] }}</td>
                                            <td>{{ $data['persentase_tambahan'].'%' }}</td>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    onclick="fungsiEdit('{{ $data['id'] }}|{{ $data['nama_tambahan'] }}|{{ $data['persentase_tambahan'] }}')"
                                                    data-toggle="modal" data-target="#ubahTambahan">
                                                   Ubah
                                                </button>

                                                <form action="{{ url('tambahan/' . $data['id']) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                        Hapus
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
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function fungsiEdit(data) {
            var data = data.split('|');
            $('#ubahTambahan form').attr('action', "{{ url('tambahan') }}/" + data[0]);
            $('#ubahTambahan .modal-body #nama_tambahan').val(data[1]);
            $('#ubahTambahan .modal-body #persentase_tambahan').val(data[2]);
        }
    </script>
@endsection
