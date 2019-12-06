<?php
class islemaciklamalar_help
{
    public $db;

    function __construct()
    {
        global $database;
        $this->db = $database;

    }

    function islemler($islem)
    {
        if($islem == "TRANSFER") {
            $data["key"] = 1;
            $data["value"] =  "TRANSFER";
        }
        else if($islem == "N_GIRIS"){
            $data["key"] = 1;
            $data["value"] = "NAKİT GİRİŞ";
        }
        else if($islem == "N_CIKIS"){
            $data["key"] = 1;
            $data["value"] =  "NAKİT ÇIKIŞ";
        }
        else if($islem == "B_SABITLE"){
            $data["key"] = 1;
            $data["value"] =  "BAKİYE SABİTLEME";
        }

        else if($islem == "N_TAHSILAT"){
            $data["key"] = 2;
            $data["value"] =  "NAKİT TAHSİLAT";
        }

        else if($islem == "C_TAHSILAT"){
            $data["key"] = 2;
            $data["value"] =  "ÇEK TAHSİLAT";
        }

        else if($islem == "C_ODEME"){
            $data["key"] = 2;
            $data["value"] =  "ÇEK ÖDEME";
        }

        else if($islem == "N_ODEME"){
            $data["key"] = 2;
            $data["value"] =  "NAKİT ÖDEME";
        }

        else if($islem == "CALISAN_ODEME"){
            $data["key"] = 2;
            $data["value"] =  "ÇALIŞAN ÖDEME";
        }

        else if($islem == "F_ODEME"){
            $data["key"] = 2;
            $data["value"] =  "FATURA ÖDEME";
        }

        else if($islem == "F_TAHSILAT"){
            $data["key"] = 2;
            $data["value"] =  "FATURA TAHSİLAT";
        }



        return $data;
    }



}
