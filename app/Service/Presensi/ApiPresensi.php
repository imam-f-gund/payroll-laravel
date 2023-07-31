<?php

namespace  App\Service\Presensi;

use App\Models\Presensi;

class ApiPresensi
{
    public function getPresensi($id, $start_date, $end_date)
    {
   
        $presensi = Presensi::where('id_detail_user', $id)->where(function ($query) use ($start_date, $end_date) {
            if (!is_null($start_date) && !is_null($end_date)) {
                $query->whereBetween('tanggal', [$start_date, $end_date]);
            }
        })->get();
     
        return response()->json($presensi);
    }
}