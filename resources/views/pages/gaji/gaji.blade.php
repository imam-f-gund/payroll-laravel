@extends('layouts.app')

@section('title', 'Gaji')

@section('css')

    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="modal fade" id="tambahGaji" tabindex="-1" role="dialog" aria-labelledby="tambahGajiLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahGajiLabel">Tambah Gaji</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('gaji') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="nama_Gaji">Nama Gaji</label>
                                <input type="text" class="form-control" id="nama_Gaji" name="nama_Gaji">
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

        <div class="modal fade" id="ubahGaji" tabindex="-1" role="dialog" aria-labelledby="tambahGajiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahGajiLabel">Detail Gaji</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id='form' method="POST">
                        @csrf
                        
                       
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id_detail_user" name="id_detail_user">
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <input type="text" id="id_detail_user" name="id_detail_user" hidden>
                            <input type="text" id="id_user" hidden>
                            <input type="text" id="tanggal" name="tanggal" hidden>
                            <input type="text" id="total_presensi" name="total_presensi" hidden>
                            <input type="text" id="total_lembur" name="total_lembur" hidden>
                            <input type="text" id="insentif" name="insentif" hidden>
                            <input type="text" id="lembur" name="lembur" hidden>
                            <input type="text" id="potongan" name="potongan" hidden>
                            <input type="text" id="total_gaji" name="total_gaji" hidden>
                            <div class="table-responsive text-nowrap" id="documentId">
                            
                                <table id="datatable" class="table table-hover table-bordered table-striped">
                                    
                                 <tbody class="table-border-bottom-0" id="isi">
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="showSaved" class="btn btn-success" >Minta Approved</button> 
                            <button type="button" onclick="print();" id="btnprint" class="btn btn-secondary" >Print</button>
                            <button type="button" class="btn btn-primary" id="btnShow">Cek Gaji</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="row mb-3">
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800">Data Gaji</h1>
            </div>
            {{-- <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#tambahGaji">
                    Tambah Gaji
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
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Tunjangan</th>
                                        {{-- <th>Lembur</th> --}}
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $items)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $items['nama'] }}</td>
                                            <td>{{ $items['status'] }}</td>
                                            <td>{{ $items['jabatan'] }}</td>
                                            <td>{{ $items['gaji_pokok'] }}</td>
                                            <td>{{ $items['tunjangan'] }}</td>
                                            {{-- <td>{{ $items['lembur'] }}</td> --}}
                                            <td colspan="1">
                                                <button type="button" class="btn btn-info btn-sm" data-id="{{ $items['id'] }}"
                                                    id="modalShow"
                                                    data-toggle="modal" data-target="#ubahGaji">
                                                    Detail
                                                </button>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>

    <script>
        var url = "{{ url('api/cek-gaji') }}";
        var urlGaji = "{{ url('gaji') }}";
    
                let print = () => {
                   id = $('#id_user').val();
                  
                    window.location.href = "{{ url('print-gaji') }}?id_detail_user=" + $('#id_user').val() + "&start_date=" + $('#start_date').val() + "&end_date=" + $('#end_date').val();
                }
                

        $(document).on("click", '#modalShow', function() {
            $('#showSaved').hide();
            $("#showSaved").html('Minta Approved');
            $('#btnprint').attr('disabled', true);
            var id = $(this).attr("data-id");
            $('#isi').html('');
            console.log(id);
            $('#ubahGaji .modal-body #id_detail_user').val(id);
            $('#id_user').val(id);
            $('#ubahGaji').modal('show');
            // });
            });

            $("#btnShow").click(function(){
                $('#btnShow').html('Loading...');
            
                    id = $('#id_detail_user').val(); 
                console.log(id);
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                
                getData(url + "?id_detail_user=" + id + "&start_date=" + start_date + "&end_date=" + end_date).done(function(response) {
                    isi  = ``;
                    console.log(response);
                        
                        isi += `
                            
                                <tr><td><th>Nama : </td><td></th>`+response.nama+`</td></tr>
                                <tr><td><th>Status : </td><td></th>`+response.status+`</td></tr>
                                <tr><td><th>Gaji Pokok : </td><td></th>`+response.gaji_pokok+`</td></tr>
                                <tr><td><th>Insentif : </td><td></th>`+response.insentif+`</td></tr>
                                <tr><td><th>Jam Lembur : </td><td></th>`+response.jumlah_jam_lembur+`</td></tr>
                                <tr><td><th>Lmbur : </td><td></th>`+response.lembur+`</td></tr>
                                <tr><td><th>Tunjangan : </td><td></th>`+response.tunjangan+`</td></tr>
                                <tr><td><th>Jumlah Absen : </td><td></th>`+response.jumlah_absen+`</td></tr>
                                <tr><td><th>Potongan Absen : </td><td></th>`+response.potongan_absen+`</td></tr>
                                <tr><td><th>Potongan Bpjs : </td><td></th>`+response.potongan_bpjs+`</td></tr>
                                <tr><td><th>Total Gaji : </td><td></th>`+response.total_gaji+`</td></tr>

                        `;

                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = today.getFullYear();

                        if (end_date == null || end_date == '') {
                            end_date = yyyy + '-' + mm + '-' + dd;
                            $('#tanggal').val(end_date);
                        
                        }
                        
                        $('#id_detail_user').val(response.id_detail_user);
                        $('#tanggal').val(end_date);
                        $('#total_presensi').val(response.total_presensi);
                        $('#total_lembur').val(response.jumlah_jam_lembur);
                        $('#insentif').val(response.insentif);
                        $('#lembur').val(response.lembur);
                        $('#potongan').val(response.potongan_bpjs);
                        $('#absen').val(response.potongan_absen);
                        $('#total_gaji').val(response.total_gaji);
                        

                    $('#isi').html(isi);
                    
                    $('#btnprint').attr('disabled', false);
                    $('#btnShow').html('Cek Gaji');
                    $('#showSaved').show();
                });
            });

            $("#showSaved").click(function(){
                form = $('#form');
                token = '';
                postData(urlGaji, token, form).done(function(response, responseText, xhr) {
                    console.log(response);
                    if (response.kode === 200) {
                        
                      
                        $("#showSaved").html('sukses');
                        $("#showSaved").attr('disabled', true);
                       
                    }
                    // successAlert(data.message);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                   
                });
            });

        
        
    </script>
@endsection
