<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailUser;
use App\Models\User;
use App\Models\Tambahan;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\requestDetailUser;

class DetailUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $detailpegawai = DetailUser::with(['user.jabatan','tambahan'])->get();
            $user = User::all();
            $tambahan = Tambahan::all();
            $jabatan = Jabatan::all();
            return view('pages.detailuser.detailuser', compact('detailpegawai', 'user', 'tambahan', 'jabatan'));
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
    public function store(requestDetailUser $request)
    {
        //
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => hash::make(12345678),
            'jabatan_id' => $request->jabatan_id,
        ]);
        
        DetailUser::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => $user->id,
            'status' => $request->status,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_tambahan' => $request->id_tambahan,
            
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
    public function update(requestDetailUser $request, $id)
    {
        
        //
        $detailuser = DetailUser::find($id);
        
        $detailuser->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_tambahan' => $request->id_tambahan,
        ]);

        $user = User::find($detailuser->id_user);
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'jabatan_id' => $request->jabatan_id,
        ]);
        
        Alert::success('Berhasil', 'Data Berhasil Diubah');
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
        
        $detailuser = DetailUser::find($id);
        $user = User::find($detailuser->id_user);
        $detailuser->delete();
        $user->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return back();
    }
}
