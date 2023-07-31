<?php

namespace App\Service\CalculateSalery;

class CalculateNWNP{

    public function CalculateNWNP($absen, $gaji_pokok){
        
        $potongan = $absen*$gaji_pokok/30;

        return $potongan;
    }
}