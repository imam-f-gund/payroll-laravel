<?php

namespace App\Service\CalculateSalery;

class CalculateTotalGaji{

    public function CalculateTotalGaji($gaji_pokok, $tunjagan, $insentif, $lembur, $absen_nwnp, $bpjs){
        
        $sum = ($gaji_pokok + $tunjagan + $insentif + $lembur);
        // dd($insentif);
        $total = $sum - ($absen_nwnp + $bpjs);

        return $total;
    }
}