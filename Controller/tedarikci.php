<?php

class tedarikci extends controller
{

    private $run;
    public $request, $session, $cache;

    function __construct($run)
    {
        ayhan::language();
        global $sreq;

        if (empty($sreq)) {
            $this->request = array("1" => "1");
        } else {
            $this->request = $sreq;
        }

        $this->session = $this->help("session");
        $this->cache = $this->help("cache");
        $this->cache->dakika = 2;

        parent::__construct($run);


    }

    function tedarikci_listesi()
    {

        //  $this->cache->start();         
        $data["lang"] = ayhan::$dil;

        if (isset($this->val->kayit) == "ok") {

            $data["mesaj"] = "Kayıt İşlemi Başarılı";

        } else {

            $data["mesaj"] = "";

        }

        $data["cls"] = $this->Model("tedarikci/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/tedarikci_listesi", $data);
        $this->View("muhasebe/gider/footer");

        // \controller_help::controller->deneme();
    }

    function tedarikci()
    {


        //  $this->cache->start();         
        $data["lang"] = ayhan::$dil;


        $data["cls"] = $this->Model("tedarikci/anasayfa");

        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/tedarikci", $data);
        $this->View("muhasebe/gider/footer");

        // \controller_help::controller->deneme();
    }

    function tedarikci_guncelle()
    {

        $cls = $this->Model("tedarikci/anasayfa");
        $veri = ARRAY();

        $veri["unvan"] = $this->val->unvan;
        $veri["kisa_ad"] = $this->val->kisa_ad;
        $veri["firma_kategori_id"] = $this->val->firma_kategori_id;
        $veri["fl_id"] = $this->val->fl_id;
        $veri["eposta"] = $this->val->eposta;
        $veri["telefon"] = $this->val->telefon;
        $veri["fax"] = $this->val->fax;
        $veri["iban_1"] = $this->val->iban_1;


        if (isset($this->val->ibanlar) != ""):

            $ibanlar = explode(",", $this->val->ibanlar);

            foreach ($ibanlar as $ibn) {
                $is = "iban_" . $ibn;
                if (isset($this->val->$is)) $veri[$is] = $this->val->$is;
            }
        endif;

        if (isset($this->val->adres_yd)):
            $veri["adres_yd"] = $this->val->adres_yd;
        endif;


        if (isset($this->val->il)) $veri["il"] = $this->val->il;
        if (isset($this->val->ilce)) $veri["ilce"] = $this->val->ilce;
        $veri["adres"] = $this->val->adres;
        $veri["turu"] = $this->val->turu;
        $veri["vkn_tckn"] = $this->val->vkn_tckn;
        $veri["vergi_dairesi"] = $this->val->vergi_dairesi;
        $veri["doviz_a_s"] = $this->val->doviz_a_s;

        if (isset($this->val->acilisbakiyesivarmi) == 1):
            $veri["acilis_bakiyesi_tarih"] = date_format(date_create($this->val->acilis_bakiyesi_tarih), "Y-m-d");
            $veri["acilis_bakiyesi"] = $this->val->acilis_bakiyesi;
            $veri["acilis_bakiyesi_kur"] = $this->val->acilis_bakiyesi_kur;
            $veri["acilis_bakiyesi_durum"] = $this->val->acilis_bakiyesi_durum;
        endif;


        if (isset($this->val->yetkililer_adet) != "") {
            $yadet = explode(",", $this->val->yetkililer_adet);
            $veri["yetkili_adet"] = count($yadet);
        }


        // update işlemi yapılacak
        // yetkiller silinecek
        $cls->yetkilisi($this->val->id);
        $cls->tedarikciupdate($this->val->id, $veri);


        if (isset($this->val->yetkililer_adet) && $this->val->id >= 1):
            $yetkili_adet = explode(",", $this->val->yetkililer_adet);
            foreach ($yetkili_adet as $x) {


                $veri = ARRAY();

                $veri["musteri_id"] = $this->val->id;

                $is = "yad_" . $x;
                if (isset($this->val->$is)) {
                    $r = 1;
                    $veri["ad"] = $this->val->$is;
                } else {
                    $r = 0;
                }

                $is = "yposta_" . $x;
                if (isset($this->val->$is)) $veri["eposta"] = $this->val->$is;

                $is = "ytel_" . $x;
                if (isset($this->val->$is)) $veri["telefon"] = $this->val->$is;

                $is = "ynot_" . $x;
                if (isset($this->val->$is)) $veri["notu"] = $this->val->$is;


                if ($r == 1) $cls->kaydet("tedarikci_yetkili", $veri);

            }
        endif;

        if ($this->val->id >= 1) {
            $this->RedirectUrl("tedarikci/tedarikci_detay/id/" . $this->val->id . "/kayit/guncelleme");
        } else {

        }


    }

    function tedarikci_ekle()
    {

        $data["cls"] = $this->Model("tedarikci/anasayfa");
        $veri = ARRAY();

        $veri["unvan"] = $this->val->unvan;
        $veri["kisa_ad"] = $this->val->kisa_ad;
        $veri["firma_kategori_id"] = $this->val->firma_kategori_id;
        $veri["fl_id"] = $this->val->fl_id;
        $veri["eposta"] = $this->val->eposta;
        $veri["telefon"] = $this->val->telefon;
        $veri["fax"] = $this->val->fax;
        $veri["iban_1"] = $this->val->iban_1;


        if (isset($this->val->ibanlar) != ""):

            $ibanlar = explode(",", $this->val->ibanlar);

            foreach ($ibanlar as $ibn) {
                $is = "iban_" . $ibn;
                if (isset($this->val->$is)) $veri[$is] = $this->val->$is;
            }
        endif;

        if (isset($this->val->adres_yd)):
            $veri["adres_yd"] = $this->val->adres_yd;
        endif;

        $veri["il"] = $this->val->il;
        $veri["ilce"] = $this->val->ilce;
        $veri["adres"] = $this->val->adres;
        $veri["turu"] = $this->val->turu;
        $veri["vkn_tckn"] = $this->val->vkn_tckn;
        $veri["vergi_dairesi"] = $this->val->vergi_dairesi;
        $veri["doviz_a_s"] = $this->val->doviz_a_s;

        if (isset($this->val->acilisbakiyesivarmi) == 1):
            $veri["acilis_bakiyesi_tarih"] = date_format(date_create($this->val->acilis_bakiyesi_tarih), "Y-m-d");
            $veri["acilis_bakiyesi"] = $this->val->acilis_bakiyesi;
            $veri["acilis_bakiyesi_kur"] = $this->val->acilis_bakiyesi_kur;
            $veri["acilis_bakiyesi_durum"] = $this->val->acilis_bakiyesi_durum;
        endif;


        if (isset($this->val->yetkililer_adet) != "") {
            $yadet = explode(",", $this->val->yetkililer_adet);
            $veri["yetkili_adet"] = count($yadet);
        }


        $id = $data["cls"]->kaydet("tedarikciler", $veri);


        if (isset($this->val->yetkililer_adet) && $id >= 1):
            $yetkili_adet = explode(",", $this->val->yetkililer_adet);
            foreach ($yetkili_adet as $x) {


                $veri = ARRAY();

                $veri["musteri_id"] = $id;

                $is = "yad_" . $x;
                if (isset($this->val->$is)) {
                    $r = 1;
                    $veri["ad"] = $this->val->$is;
                } else {
                    $r = 0;
                }

                $is = "yposta_" . $x;
                if (isset($this->val->$is)) $veri["eposta"] = $this->val->$is;

                $is = "ytel_" . $x;
                if (isset($this->val->$is)) $veri["telefon"] = $this->val->$is;

                $is = "ynot_" . $x;
                if (isset($this->val->$is)) $veri["notu"] = $this->val->$is;


                if ($r == 1) $data["cls"]->kaydet("tedarikci_yetkili", $veri);

            }
        endif;

        if ($id >= 1) {
            $this->RedirectUrl("tedarikci/tedarikci_detay/id/$id/kayit/ok");
        } else {
        }


    }

    function tedarikci_detay()
    {
        $data["lang"] = ayhan::$dil;
        if (isset($this->val->kayit) && $this->val->kayit == "ok") {
            $data["mesaj"] = "Kayıt İşlemi Başarılı";
        } else if (isset($this->val->kayit) && $this->val->kayit == "guncelleme") {
            $data["mesaj"] = "Güncelleme İşlemi Başarılı";
        } else {
            $data["mesaj"] = "";
        }

        $data["id"] = $this->val->id;
        $data["cls"] = $this->Model("tedarikci/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/tedarikci_detay", $data);
        $this->View("muhasebe/gider/footer");
    }


    function guncelle()
    {
        $data["lang"] = ayhan::$dil;
        if (isset($this->val->kayit) && $this->val->kayit == "ok") {
            $data["mesaj"] = "Kayıt İşlemi Başarılı";
        } else if (isset($this->val->kayit) && $this->val->kayit == "guncelleme") {
            $data["mesaj"] = "Güncelleme İşlemi Başarılı";
        } else {
            $data["mesaj"] = "";
        }


        $data["id"] = $this->val->id;
        $data["cls"] = $this->Model("tedarikci/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/tedarikci_guncelle", $data);
        $this->View("muhasebe/gider/footer");


    }
}
