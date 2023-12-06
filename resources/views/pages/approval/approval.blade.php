@extends('layouts.app')

@section('title', 'approval')

@section('css')

    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="modal fade" id="tambahapproval" tabindex="-1" role="dialog" aria-labelledby="tambahapprovalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id="tambahapprovalLabel">Tambah approval</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <form action="{{ url('gaji-approval') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="nama_approval">Nama approval</label>
                                <input type="text" class="form-control" id="nama_approval" name="nama_approval">
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

        <div class="modal fade" id="ubahapproval" tabindex="-1" role="dialog" aria-labelledby="tambahapprovalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahapprovalLabel">Ubah approval</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('gaji-approval') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="nama_approval">Nama approval</label>
                                <input type="text" class="form-control" id="nama_approval" name="nama_approval">
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
                <h1 class="h3 mb-2 text-gray-800">Data approval</h1>
            </div>
            {{-- <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#tambahapproval">
                    Tambah approval
                </button>
            </div> --}}
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
                                        <th>Nama approval</th>
                                        <th>Tanggal </th>
                                        <th>Total Presensi </th>
                                        <th>Total Lembur </th>
                                        <th>Potongan Bpjs</th>
                                        <th>Potongan Absen</th>
                                        <th>Lembur</th>
                                        <th>Insentif </th>
                                        <th>status </th>
                                        <th>Total Gaji</th>
                                        <th width="40%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($gaji as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data['detailuser']['nama'] }}</td>
                                            <td>{{ $data['tanggal'] }}</td>
                                            <td>{{ $data['total_presensi'] }}</td>
                                            <td>{{ $data['total_lembur'] }}</td>
                                            <td>{{ $data['potongan'] }}</td>
                                            <td>{{ $data['potongan_absen'] }}</td>
                                            <td>{{ $data['lembur'] }}</td>
                                            <td>{{ $data['insentif'] }}</td>
                                            <td>{{ $data['status'] }}</td>
                                            <td>{{ $data['total_gaji'] }}</td>
                                            <td colspan="2">
                                              
                                                <form action="{{ url('gaji-approval/' . $data['id']) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="status" value="approval" hidden>
                                                    <button type="submit" class="btn btn-sm btn-success btn-success">
                                                        Approval
                                                    </button>
                                                </form>
                                                <form action="{{ url('gaji-approval/' . $data['id']) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="status" value="reject" hidden>
                                                    <button type="submit" class="btn btn-sm btn-warning btn-warning">
                                                        Rejeted
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
            $('#ubahapproval form').attr('action', "{{ url('gaji-approval') }}/" + data[0]);
            $('#ubahapproval .modal-body #nama_approval').val(data[1]);
        }
    </script>
@endsection
