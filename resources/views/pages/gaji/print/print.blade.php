<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Gaji</title>
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <style>
            h5 {text-align: center;}
        </style>
</head>
<body>
    <div class="table-responsive text-nowrap" id="documentId">
        <h5>STRUK GAJI</h5>
        <table id="datatable" class="table table-hover table-bordered table-striped">
            
            <tbody class="table-border-bottom-0" id="isi">
            </tbody>
            <tbody class="table-border-bottom-0" id="acc">
            </tbody>
           
        </table> 
    </div>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>
    <script>
        function getData(url, token) {
            return $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                
                contentType: 'application/json; charset=utf-8',
            });
        }
    </script>   
    <script>
        var parms = location.search.split('?id_detail_user=');
        var id_detail_user = parms[1].split('&start_date=');
        var start_end = id_detail_user[1].split('&end_date=');

        var id = id_detail_user[0];
        var start_date = start_end[0];
        var end_date = start_end[1];
        
        var url = "{{ url('api/cek-gaji') }}";
        var urlGaji = "{{ url('api/cek-gaji-approval') }}";
                

        $(document).on("click", '#modalShow', function() {

        var id = $(this).attr("data-id");
        $('#isi').html('');
        console.log(id);
        $('#ubahGaji .modal-body #id_detail_user').val(id);
        $('#ubahGaji').modal('show');
        // });
        });

       
            getData(url + "?id_detail_user=" + id + "&start_date=" + start_date + "&end_date=" + end_date).done(function(response) {
               
            console.log(response);
                
                    isi = `
                        
                            <tr><td>Nama : </td><td>`+response.nama+`</td></tr>
                            <tr><td>Status : </td><td>`+response.status+`</td></tr>
                            <tr><td>Gaji Pokok : </td><td>`+response.gaji_pokok+`</td></tr>
                            <tr><td>Insentif : </td><td>`+response.insentif+`</td></tr>
                            <tr><td>Jam Lembur : </td><td>`+response.jumlah_jam_lembur+`</td></tr>
                            <tr><td>Lmbur : </td><td>`+response.lembur+`</td></tr>
                            <tr><td>Tunjangan : </td><td>`+response.tunjangan+`</td></tr>
                            <tr><td>Jumlah Absen : </td><td>`+response.jumlah_absen+`</td></tr>
                            <tr><td>Potongan Absen : </td><td>`+response.potongan_absen+`</td></tr>
                            <tr><td>Potongan Bpjs : </td><td>`+response.potongan_bpjs+`</td></tr>
                            <tr><td>Total Gaji : </td><td>`+response.total_gaji+`</td></tr> 
                       
                    `;

                    getData(urlGaji + "/"+id+"?tanggal=" + end_date).done(function(res) {
                        console.log(res);
                     if(res == null || res == ''){
                        $('#acc').html(`<td><b>SPV PAYROLL : </b></td><td><b>Belum Pengajuan Approval</b></td>`);
                     }else{
                        $('#acc').html(`<td><b>SPV PAYROLL : </b></td><td><b>`+res.status+`</b></td>`);
                     }
                    });
                
                $('#isi').html(isi);
                $('#btnShow').html('Cek Gaji');

                window.print();
            });
        
    </script>
</body>
</html>