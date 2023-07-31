<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\DetailUser;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\requestPresensi;


class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $presensi = Presensi::with('detailUser')->get();
        $pegawai = DetailUser::all();
        
        return view('pages.presensi.presensi', compact('presensi','pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requestPresensi $request)
    {
        //
    //     $user = DetailUser::all();
    //     foreach ($user as $key => $value) {
            
        
    //     for ($i=3; $i <= 7; $i++) { 
    //         Presensi::create([
    //             'id_detail_user' => $value->id,
    //             'tanggal' => '2023/07/0'.$i,
    //             'jam_masuk' => $request->jam_masuk,
    //             'jam_keluar' => $request->jam_keluar,
    //         ]);
    //     }

    //     for ($i=10; $i <= 14; $i++) { 
    //         Presensi::create([
    //             'id_detail_user' => $value->id,
    //             'tanggal' => '2023/07/'.$i,
    //             'jam_masuk' => $request->jam_masuk,
    //             'jam_keluar' => $request->jam_keluar,
    //         ]);
    //     }
    //     for ($i=17; $i <= 21; $i++) { 
    //         Presensi::create([
    //             'id_detail_user' => $value->id,
    //             'tanggal' => '2023/07/'.$i,
    //             'jam_masuk' => $request->jam_masuk,
    //             'jam_keluar' => $request->jam_keluar,
    //         ]);
    //     }for ($i=24; $i <= 28; $i++) { 
    //         Presensi::create([
    //             'id_detail_user' => $value->id,
    //             'tanggal' => '2023/07/'.$i,
    //             'jam_masuk' => $request->jam_masuk,
    //             'jam_keluar' => $request->jam_keluar,
    //         ]);
    //     }
    //     for ($i=31; $i <= 31; $i++) { 
    //         Presensi::create([
    //             'id_detail_user' => $value->id,
    //             'tanggal' => '2023/07/'.$i,
    //             'jam_masuk' => $request->jam_masuk,
    //             'jam_keluar' => $request->jam_keluar,
    //         ]);
    //     }
    // }
    
        Presensi::create([
            'id_detail_user' => $request->id_detail_user,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ]);

        Alert::success('Berhasil', 'Data Presensi Berhasil Ditambahkan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            Presensi::where('id', $id)->update([
            'id_detail_user' => $request->id_detail_user,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
        ]);

        Alert::success('Berhasil', 'Data Presensi Berhasil Diubah');
        return back();
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

}
