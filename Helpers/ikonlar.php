<?php

class ikonlar_help
{
    function __construct(){ }
    public function kur_ikonlar($kur){
        if ($kur == "TL"):
            $deger='<i class="fa fa-try"></i>';
        elseif ($kur == "USD"):
            $deger='<i class="fa fa-usd"></i>';
        elseif ($kur == "EUR"):
            $deger='<i class="fa fa-euro"></i>';
        elseif ($kur == "GBP"):
            $deger='<i class="fa fa-gbp"></i>';
        endif;
        return $deger;
    }
    public function kur_html($kur){
        if ($kur == "TL"):
            $deger='&#8378;';
        elseif ($kur == "USD"):
            $deger='&dollar;';
        elseif ($kur == "EUR"):
            $deger='&#8364;';
        elseif ($kur == "GBP"):
            $deger='&pound;';
        endif;
        return $deger;
    }
}
   
