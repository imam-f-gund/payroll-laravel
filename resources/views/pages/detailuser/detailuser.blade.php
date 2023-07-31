@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('css')

    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="modal fade" id="tambahdetailpegawai" tabindex="-1" role="dialog" aria-labelledby="tambahdetailpegawaiLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahdetailpegawaiLabel">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('detailpegawai') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option selected value="">Pilih</option>
                                    <option value="tetap">Pria</option>
                                    <option value="kontrak">Wanita</option> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option selected value="">Pilih Status</option>
                                    <option value="tetap">tetap</option>
                                    <option value="kontrak">kontrak</option> 
                                    <option value="HL">HL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok">
                            </div>
                            <div class="form-group">
                                <label for="tunjangan">Tunjangan</label>
                                <input type="number" class="form-control" id="tunjangan" name="tunjangan">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                            </div>
                            <div class="form-group">
                                <label for="id_tambahan">Tambahan</label>
                                <select class="form-control" id="id_tambahan" name="id_tambahan">
                                    @foreach ($tambahan as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_tambahan }} - {{ $data->persentase_tambahan }}%</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_id">Jabatan</label>
                                <select class="form-control" id="jabatan_id" name="jabatan_id">
                                    @foreach ($jabatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_jabatan }}</option>
                                    @endforeach
                                </select>
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

        <div class="modal fade" id="ubahdetailpegawai" tabindex="-1" role="dialog" aria-labelledby="tambahdetailpegawaiLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahdetailpegawaiLabelUpdate">Ubah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('detailpegawai') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id_user" name="id_user">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option selected value="">Pilih</option>
                                    <option value="tetap">Pria</option>
                                    <option value="kontrak">Wanita</option> 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option selected value="">Pilih Status</option>
                                    <option value="tetap">tetap</option>
                                    <option value="kontrak">kontrak</option> 
                                    <option value="HL">HL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok">
                            </div>
                            <div class="form-group">
                                <label for="tunjangan">Tunjangan</label>
                                <input type="number" class="form-control" id="tunjangan" name="tunjangan">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                            </div>
                            <div class="form-group">
                                <label for="id_tambahan">Tambahan</label>
                                <select class="form-control" id="id_tambahan" name="id_tambahan">
                                    @foreach ($tambahan as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_tambahan }} - {{ $data->persentase_tambahan }}%</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_id">Jabatan</label>
                                <select class="form-control" id="jabatan_id" name="jabatan_id">
                                    @foreach ($jabatan as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="upsimpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="row mb-3">
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Data Pegawai</h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#tambahdetailpegawai">
                    Tambah Pegawai
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
                                        <th>Status</th>
                                        <th>Gaji Pokok</th>
                                        <th>Tunjangan</th>
                                        <th>Tanggal Masuk</th>
                                        <th width="30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($detailpegawai as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>{{ $data->gaji_pokok }}</td>
                                            <td>{{ $data->tunjangan }}</td>
                                            <td>{{ $data->tanggal_masuk }}</td>
                                        
                                            <td colspan="2">
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    onclick="fungsiEdit('{{ $data->id }}|{{ $data->nama }}|{{ $data->user->email }}|{{ $data->tempat_lahir }}|{{ $data->tanggal_lahir }}|{{ $data->jenis_kelamin }}|{{ $data->id_user }}|{{ $data->status }}|{{ $data->gaji_pokok }}|{{ $data->tunjangan }}|{{ $data->tanggal_masuk }}|{{ $data->id_tambahan }}|{{ $data->user->jabatan_id }}')"
                                                    data-toggle="modal" data-target="#ubahdetailpegawai">
                                                   Ubah
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm"
                                                    onclick="fungsiDetail('{{ $data->id }}|{{ $data->nama }}|{{ $data->user->email }}|{{ $data->tempat_lahir }}|{{ $data->tanggal_lahir }}|{{ $data->jenis_kelamin }}|{{ $data->id_user }}|{{ $data->status }}|{{ $data->gaji_pokok }}|{{ $data->tunjangan }}|{{ $data->tanggal_masuk }}|{{ $data->id_tambahan }}|{{ $data->user->jabatan_id }}')"
                                                    data-toggle="modal" data-target="#ubahdetailpegawai">
                                                    Detail
                                                </button>
                                                <form action="{{ url('detailpegawai/' . $data->id) }}" class="d-inline"
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
         $('#upsimpan').show();
        function fungsiEdit(data) {
            $('#tambahdetailpegawaiLabelUpdate').text('Detail Pegawai');
            console.log(data);
            var data = data.split('|');
            $('#ubahdetailpegawai form').attr('action', "{{ url('detailpegawai') }}/" + data[0]);
            $('#ubahdetailpegawai .modal-body #nama').val(data[1]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #email').val(data[2]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #tempat_lahir').val(data[3]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #tanggal_lahir').val(data[4]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #jenis_kelamin').val(data[5]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #id_user').val(data[6]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #status').val(data[7]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #gaji_pokok').val(data[8]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #tunjangan').val(data[9]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #tanggal_masuk').val(data[10]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #id_tambahan').val(data[11]).attr("disabled",false);
            $('#ubahdetailpegawai .modal-body #jabatan_id').val(data[12]).attr("disabled",false);
            $('#upsimpan').show();
        }
        function fungsiDetail(data) {
            console.log(data);

            var data = data.split('|');
            $('#ubahdetailpegawai form').attr('action', "{{ url('detailpegawai') }}/" + data[0]);
            $('#ubahdetailpegawai .modal-body #nama').val(data[1]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #email').val(data[2]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #tempat_lahir').val(data[3]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #tanggal_lahir').val(data[4]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #jenis_kelamin').val(data[5]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #id_user').val(data[6]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #status').val(data[7]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #gaji_pokok').val(data[8]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #tunjangan').val(data[9]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #tanggal_masuk').val(data[10]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #id_tambahan').val(data[11]).attr("disabled", true);
            $('#ubahdetailpegawai .modal-body #jabatan_id').val(data[12]).attr("disabled", true);
            $('#upsimpan').hide();
            $('#tambahdetailpegawaiLabelUpdate').text('Detail Pegawai');
        }
    </script>
@endsection
