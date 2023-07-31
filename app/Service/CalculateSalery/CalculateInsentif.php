<?php
namespace App\Service\CalculateSalery;

class CalculateInsentif
{
    public function calculate($tanggal_mulai_kerja)
    {   
        $date_now = date('Y-m-d');
        $data = [];
        $insentif = 0;
        $nilai_insentif = 1000000;
        $tambah = 100000;

        // menghitung tahun mulai kerja dan tahun sekarang
        $tahun_mulai_kerja = date('Y', strtotime($tanggal_mulai_kerja));
        $tahun_sekarang = date('Y', strtotime($date_now));

        // menghitung selisih tahun
        $selisih_tahun = $tahun_sekarang - $tahun_mulai_kerja;

        // menghitung insentif
        if($selisih_tahun < 1){
            $insentif = $nilai_insentif;

            $result = [
                'tahun_mulai' => $tahun_mulai_kerja,
                'tahun_sekarang' => $tahun_sekarang,
                'selisih_tahun' => $selisih_tahun,
                'nilai_tambah' => 0,
                'insentif' => $insentif,
            ];
            array_push($data,$result);
        }else{
            for ($i = 0; $i < $selisih_tahun; $i++) {
                
                    $insentif = $nilai_insentif;
                    $nilai_insentif += $tambah;
                
                
            }   
            $result = [
                'tahun_mulai' => $tahun_mulai_kerja,
                'tahun_sekarang' => $tahun_sekarang,
                'selisih_tahun' => $selisih_tahun,
                'nilai_tambah' => $tambah,
                'insentif' => $nilai_insentif,
            ];

            array_push($data,$result);
        }
        return $data;
    }
}