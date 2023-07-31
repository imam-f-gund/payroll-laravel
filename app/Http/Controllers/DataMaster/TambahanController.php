<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tambahan;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\requestTambahan;


class TambahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tambahan = Tambahan::all();
        return view('pages.datamaster.tambahan', compact('tambahan'));
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
    public function store(requestTambahan $request)
    {
        
        Tambahan::create([
            'nama_tambahan' => $request->nama_tambahan,
            'persentase_tambahan' => $request->persentase_tambahan,
        ]);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
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
    public function update(requestTambahan $request, $id)
    {
    
        Tambahan::where('id', $id)->update([
            'nama_tambahan' => $request->nama_tambahan,
            'persentase_tambahan' => $request->persentase_tambahan,
        ]);

        Alert::success('Berhasil', 'Data Berhasil Ditambahkan');
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
        Tambahan::where('id', $id)->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return back();
    }
}
