<?php

namespace App\Service\CalculateSalery;

class CalculateLembur{

    public function calculatelembur($status, $tunjagan, $gaji_pokok, $jumlah_lembur){
        $data = [];
        $lembur = 0;
       $hittunjangan = $tunjagan;
        //lembur perjam
        if($status == 'tetap' || $status == 'kontrak'){
            $lemburs = $gaji_pokok + $hittunjangan;
            $res_lembur =$lemburs/173;
           
            for ($i = 0; $i < $jumlah_lembur; $i++) {

                if ($jumlah_lembur <= 4) {
                    $lembur += $res_lembur;
                }else{
                    $lembur += $res_lembur * 2;
                }

                $result = [
                    'tunjangan' => $hittunjangan,
                    'gaji_pokok' => $gaji_pokok,
                    'status' => $status,
                    'jumlah_lembur' => $jumlah_lembur,
                    'lembur' => $lembur,
                ];
            array_push($data,$result);
            }
           
            
        }else{
            $res_lembur = $gaji_pokok / 200;

            for ($i = 0; $i < $jumlah_lembur; $i++) {

                if ($jumlah_lembur <= 4) {
                    $lembur += $res_lembur;
                }else{
                    $lembur += $res_lembur * 2;
                }

                $result = [
                    'tunjangan' => $hittunjangan,
                    'gaji_pokok' => $gaji_pokok,
                    'status' => $status,
                    'jumlah_lembur' => $jumlah_lembur,
                    'lembur' => $lembur,
                ];
            array_push($data,$result);
            }
        
        }

        return $data;
    }
}