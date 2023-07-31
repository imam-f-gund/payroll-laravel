<?php

namespace App\Service\CalculateSalery;

class CalculateBpjs{

    public function CalculateBpjs($gaji_pokok,$tunjangan,$persen){
        $persentase = ($gaji_pokok + $tunjangan)/100*$persen;
        $potongan = $persentase;

        return $potongan;
    }
}