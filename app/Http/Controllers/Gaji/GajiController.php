<?php

namespace App\Http\Controllers\Gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\CalculateSalery\CalculateInsentif;
use App\Service\CalculateSalery\CalculateLembur;
use App\Service\CalculateSalery\CalculateNWNP;
use App\Service\CalculateSalery\CalculateBpjs;
use App\Service\CalculateSalery\CalculateTotalGaji;
use App\Service\Presensi\ApiPresensi;
use App\Models\Gaji;
use App\Models\DetailUser;
use Carbon\Carbon;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $insentif = new CalculateInsentif();
        $lembur = new CalculateLembur();
        
        $pegawai = DetailUser::with('user.jabatan')->get();
      
        $data = [];
        
        foreach ($pegawai as $key => $value) {
           
        $data[] = [
            'id' => $value->id,
            'nama' => $value->nama,
            'status' => $value->status,
            'jabatan' => $value->user->jabatan->nama_jabatan,
            'gaji_pokok' => $value->gaji_pokok,
            'tunjangan' => $value->tunjangan,
        ];
    }
        return view('pages.gaji.gaji', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         //createOrUpdate


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        Gaji::updateOrCreate([
            'id_detail_user' => $request->id_detail_user,
            'tanggal' => $request->tanggal,
            'total_presensi' => $request->total_presensi,
            'total_lembur' => $request->total_lembur,
            'insentif' => $request->insentif,
            'lembur' => $request->lembur,
            'potongan' => $request->potongan,
            'potongan_absen' => $request->potongan_absen,
            'total_gaji' => $request->total_gaji,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Data berhasil disimpan', 'kode'=> 200], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
        
        if(Gaji::where('id_detail_user',$id)->first() == null){
            $gaji = false;
        }else if($request->tanggal !=null){
            $gaji = Gaji::where('id_detail_user',$id)->where('tanggal',$request->tanggal)->first();
        
        }else{
            $gaji = Gaji::where('id_detail_user',$id)->first();
        }
        return response()->json($gaji, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cek_gaji(Request $request){
        
        //total hari kerja dalam sebulan
        if($request->start_date != null || $request->end_date != null){

            $date = Carbon::now();
            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $totalDays = $end->diffInDaysFiltered(function(Carbon $date) {
                return !$date->isWeekend();
            }, $start);
            $totalDays = $totalDays +1;
           
        }else{
            $date = Carbon::now();
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $totalDays = $end->diffInDaysFiltered(function(Carbon $date) {
                return !$date->isWeekend();
            }, $start);
           
        }
        
        $apipresensi = new ApiPresensi();
        $insentif = new CalculateInsentif();
        $lembur = new CalculateLembur();
        $nwmp = new CalculateNWNP();
        $bpjs = new CalculateBpjs();
        $total = new CalculateTotalGaji();
        
        $pegawai = DetailUser::where('id',$request->id_detail_user)->with('tambahan')->first();

        $getpresensi = $apipresensi->getPresensi($request->id_detail_user,null,null);
        $presensi = json_decode($getpresensi->content(), true);
        
        $presensi_masuk = count($presensi); //total masuk
        $jam_lembur = 1;
        $absen = $totalDays - $presensi_masuk; //total tidak masuk
       
        $data = [];
        $cek_potongan_bpjs = 0;
        $gaji = Gaji::where('id_detail_user', $pegawai->id)->first();
        
        $lembur_hasil = $lembur->calculatelembur($pegawai->status, $pegawai->tunjangan, $pegawai->gaji_pokok, $jam_lembur);
        $cek_potongan_nwnp = $nwmp->CalculateNWNP($absen, $pegawai->gaji_pokok);

        if($pegawai->id_tambahan == 1){
            $cek_potongan_bpjs = $bpjs->CalculateBpjs($pegawai->gaji_pokok, $pegawai->tunjangan,$pegawai->tambahan->persentase_tambahan);
        }
        $result = $insentif->calculate($pegawai->tanggal_masuk);
        
        
        if($pegawai->status == 'tetap'){
            $total_gaji = $total->CalculateTotalGaji($pegawai->gaji_pokok, $pegawai->tunjangan,$result[0]['insentif'], $lembur_hasil[0]['lembur'], $cek_potongan_nwnp, $cek_potongan_bpjs);
            $data = [
                'id' => $pegawai->id,
                'nama' => $pegawai->nama,
                'status' => $pegawai->status,
                'gaji_pokok' => 'Rp.'.number_format($pegawai->gaji_pokok, 2, ',', '.'),
                'tunjangan' => 'Rp.'.number_format($pegawai->tunjangan, 2, ',', '.'),
                'lembur' => 'Rp.'.number_format($lembur_hasil[0]['lembur'], 2, ',', '.'),
                'insentif' => 'Rp.'.number_format($result[0]['insentif'], 2, ',', '.'),
                'jumlah_jam_lembur' =>$jam_lembur.' jam',
                'jumlah_absen' =>$absen.' hari',
                'total_presensi' => $presensi_masuk,
                'potongan_absen' =>'Rp.'.number_format($cek_potongan_nwnp, 2, ',', '.'),  
                'potongan_bpjs' =>'Rp.'.number_format($cek_potongan_bpjs, 2, ',', '.'),
                'total_gaji' =>'Rp.'.number_format($total_gaji, 2, ',', '.'),
                'gaji_pokok_number' => $pegawai->gaji_pokok,
                'tunjangan_number' => $pegawai->tunjangan,
                'lembur_number' => $lembur_hasil[0]['lembur'],
                'insentif_number' => $result[0]['insentif'],
                'potongan_absen_number' =>$cek_potongan_nwnp,  
                'potongan_bpjs_number' =>$cek_potongan_bpjs,
                'total_gaji_number' =>$total_gaji,
            ];
        }else{
            $total_gaji = $total->CalculateTotalGaji($pegawai->gaji_pokok, $pegawai->tunjangan,0, $lembur_hasil[0]['lembur'], $cek_potongan_nwnp, $cek_potongan_bpjs);
            $data = [
                'id' => $pegawai->id,
                'nama' => $pegawai->nama,
                'status' => $pegawai->status,
                'gaji_pokok' => 'Rp.'.number_format($pegawai->gaji_pokok, 2, ',', '.'),
                'tunjangan' =>'Rp.'.number_format($pegawai->tunjangan, 2, ',', '.'),
                'lembur' => 'Rp.'.number_format($lembur_hasil[0]['lembur'], 2, ',', '.'),
                'insentif' => 'Rp.0',
                'jumlah_jam_lembur' =>$jam_lembur.' jam',
                'jumlah_absen' =>$absen.' hari',
                'total_presensi' => $presensi_masuk,
                'potongan_absen' =>'Rp.'.number_format($cek_potongan_nwnp, 2, ',', '.'),
                'potongan_bpjs' =>'Rp.'.number_format($cek_potongan_bpjs, 2, ',', '.'),
                'total_gaji' =>'Rp.'.number_format($total_gaji, 2, ',', '.'),
                'gaji_pokok_number' => $pegawai->gaji_pokok,
                'tunjangan_number' => $pegawai->tunjangan,
                'lembur_number' => $lembur_hasil[0]['lembur'],
                'insentif_number' => $result[0]['insentif'],
                'potongan_absen_number' =>$cek_potongan_nwnp,  
                'potongan_bpjs_number' =>$cek_potongan_bpjs,
                'total_gaji_number' =>$total_gaji,
            ];
        }
        
        return response()->json($data, 200);
    }
}
