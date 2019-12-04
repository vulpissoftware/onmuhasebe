<?php

class nakit extends controller
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


    function ayhan()
    {

        $d = $this->sistem("pdf");
        var_dump($d);
    }
    function paracikisi()
    {
        $cls = $this->Model("nakit/anasayfa");
        $cikankasabanka = $cls->b_k($this->val->b_k_id);


        $gsonmiktar =  $cikankasabanka = $cikankasabanka->bakiye;


        $cikankasabanka = str_replace(array(".", ","), array("", "."), $cikankasabanka);
        $miktar = str_replace(array(".", ","), array("", "."), $this->val->miktar);

        $yenideger = $cikankasabanka - $miktar;
        $yenideger = number_format($yenideger, 2, ',', '.');
        $cls->b_k_bakiye_update($yenideger, $this->val->b_k_id);

        $data["cikis_b_k"] = $this->val->b_k_id;

        $data["cikan_hesap_son_miktar"] = $gsonmiktar;
        $data["cikan_miktar"] = $this->val->miktar;
        $data["cikis_doviz"] = $this->val->doviz;
        $data["tarih"] = date_format(date_create($this->val->tarih), "Y-m-d");
        $data["islem"] = "N_CIKIS";
        $data["aciklama"] = $this->val->aciklama;
        $id = $cls->kaydet("kasa_haraketleri", $data);

    }

    function paragirisi()
    {
        $cls = $this->Model("nakit/anasayfa");
        $cikankasabanka = $cls->b_k($this->val->b_k_id);


        $gsonmiktar =  $cikankasabanka = $cikankasabanka->bakiye;


        $cikankasabanka = str_replace(array(".", ","), array("", "."), $cikankasabanka);
        $girennmiktar = str_replace(array(".", ","), array("", "."), $this->val->giris_miktar);

        $yenideger = $cikankasabanka + $girennmiktar;
        $yenideger = number_format($yenideger, 2, ',', '.');
        $cls->b_k_bakiye_update($yenideger, $this->val->b_k_id);

        $data["giris_b_k"] = $this->val->b_k_id;

        $data["giris_hesap_son_miktar"] = $gsonmiktar;
        $data["giris_miktar"] = $this->val->giris_miktar;
        $data["giris_doviz"] = $this->val->giris_doviz;
        $data["tarih"] = date_format(date_create($this->val->transfer_trh), "Y-m-d");
        $data["islem"] = "N_GIRIS";
        $data["aciklama"] = $this->val->aciklama;
        $id = $cls->kaydet("kasa_haraketleri", $data);

    }


    function transefer()
    {

        $cls = $this->Model("nakit/anasayfa");


        $cikankasabanka = $cls->b_k($this->val->cikis_b_k);
        $cikankasabanka = $cikankasabanka->bakiye;
        $csonmiktar = $cikankasabanka;

        $cikankasabanka = str_replace(array(".", ","), array("", "."), $cikankasabanka);
        $cikanmiktar = str_replace(array(".", ","), array("", "."), $this->val->cikan_miktar);

        $yenideger = $cikankasabanka - $cikanmiktar;
        $yenideger = number_format($yenideger, 2, ',', '.');
        $cls->b_k_bakiye_update($yenideger, $this->val->cikis_b_k);

        // çıkan miktarı ana bakşyeden düş


        // giren miktarı ana bakıyeye ekle
        $girenkasabanka = $cls->b_k($this->val->giris_b_k);
        $girenkasabanka = $girenkasabanka->bakiye;
        $gsonmiktar = $girenkasabanka;


        $girenkasabanka = str_replace(array(".", ","), array("", "."), $girenkasabanka);
        $girenmiktar = str_replace(array(".", ","), array("", "."), $this->val->giris_miktar);


        $yenideger = "";
        $yenideger = $girenkasabanka + $girenmiktar;
        $yenideger = number_format($yenideger, 2, ',', '.');

        $cls->b_k_bakiye_update($yenideger, $this->val->giris_b_k);

        $data["cikis_b_k"] = $this->val->cikis_b_k;
        $data["giris_b_k"] = $this->val->giris_b_k;
        $data["cikan_hesap_son_miktar"] = $csonmiktar;
        $data["cikan_miktar"] = $this->val->cikan_miktar;
        $data["cikis_doviz"] = $this->val->cikis_doviz;

        $data["giris_hesap_son_miktar"] = $gsonmiktar;
        $data["giris_miktar"] = $this->val->giris_miktar;
        $data["giris_doviz"] = $this->val->giris_doviz;
        $data["tarih"] = date_format(date_create($this->val->transfer_trh), "Y-m-d");
        $data["islem"] = "TRANSFER";
        $data["aciklama"] = $this->val->aciklama;


        $id = $cls->kaydet("kasa_haraketleri", $data);


    }

    function banka_ekle()
    {
        $data["cls"] = $this->Model("nakit/anasayfa");
        $this->View("muhasebe/nakit/head", $data);
        $this->View("muhasebe/nakit/banka_ekle", $data);
        $this->View("muhasebe/nakit/footer");
    }

    function kasa_ekle()
    {
        $data["cls"] = $this->Model("nakit/anasayfa");
        $this->View("muhasebe/nakit/head", $data);
        $this->View("muhasebe/nakit/kasa_ekle", $data);
        $this->View("muhasebe/nakit/footer");
    }


    function banka_kaydet()
    {
        $cls = $this->Model("nakit/anasayfa");
        $veri["b_k"] = "BANKA";
        $veri["ad"] = $this->val->ad;
        $veri["banka"] = $this->val->banka;
        $veri["sube"] = $this->val->sube;
        $veri["hesap_no"] = $this->val->hesap_no;
        $veri["iban"] = $this->val->iban;
        $veri["acilis_bakiye"] = $this->val->acilis_bakiyesi;
        $veri["bakiye"] = $this->val->acilis_bakiyesi;
        $veri["acilis_doviz"] = $this->val->acilis_doviz;
        $veri["acilis_tarih"] = date_format(date_create($this->val->acilis_tarih), "Y-m-d");


        $id = $cls->kaydet("banka_kasa", $veri);


        $this->RedirectUrl("nakit/bk_detay/id/$id/kayit/ok");

    }

    function kasa_kaydet()
    {
        $cls = $this->Model("nakit/anasayfa");
        $veri["b_k"] = "KASA";
        $veri["ad"] = $this->val->ad;
        $veri["acilis_bakiye"] = $this->val->acilis_bakiyesi;
        $veri["acilis_doviz"] = $this->val->acilis_doviz;
        $veri["acilis_tarih"] = date_format(date_create($this->val->acilis_tarih), "Y-m-d");
        $id = $cls->kaydet("banka_kasa", $veri);

        $this->RedirectUrl("kasa/bk_detay/id/$id/kayit/ok");

    }


    function bk_detay()
    {
        if (isset($this->val->kayit) && $this->val->kayit == "ok") {
            $data["mesaj"] = "Kayıt İşlemi Başarılı";
        } else if (isset($this->val->kayit) && $this->val->kayit == "guncelleme") {
            $data["mesaj"] = "Güncelleme İşlemi Başarılı";
        } else {
            $data["mesaj"] = "";
        }
        $data["id"] = $this->val->id;
        $data["cls"] = $this->Model("nakit/anasayfa");
        $this->View("muhasebe/nakit/head", $data);
        $this->View("muhasebe/nakit/banka_detay", $data);
        $this->View("muhasebe/nakit/footer");
    }


    function kasa_banka()
    {

        //  $this->cache->start();
        $data["lang"] = ayhan::$dil;

        if (isset($this->val->kayit) == "ok") {

            $data["mesaj"] = "Kayıt İşlemi Başarılı";

        } else {

            $data["mesaj"] = "";

        }

        $data["cls"] = $this->Model("nakit/anasayfa");
        $this->View("muhasebe/nakit/head", $data);
        $this->View("muhasebe/nakit/banka_kasa_listesi", $data);
        $this->View("muhasebe/nakit/footer");

        // \controller_help::controller->deneme();
    }

    function musteri()
    {


        //  $this->cache->start();
        $data["lang"] = ayhan::$dil;


        $data["cls"] = $this->Model("musteri/anasayfa");

        $this->View("muhasebe/satis/head", $data);
        $this->View("muhasebe/satis/musteri", $data);
        $this->View("muhasebe/satis/footer");

        // \controller_help::controller->deneme();
    }

    function musteri_guncelle()
    {

        $cls = $this->Model("musteri/anasayfa");
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
        $cls->musteriupdate($this->val->id, $veri);


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


                if ($r == 1) $cls->kaydet("musteri_yetkili", $veri);

            }
        endif;

        if ($this->val->id >= 1) {
            $this->RedirectUrl("musteri/musteri_detay/id/" . $this->val->id . "/kayit/guncelleme");
        } else {

        }


    }

    function musteri_ekle()
    {

        $data["cls"] = $this->Model("musteri/anasayfa");
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


        $id = $data["cls"]->kaydet("musteri", $veri);


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


                if ($r == 1) $data["cls"]->kaydet("musteri_yetkili", $veri);

            }
        endif;

        if ($id >= 1) {
            $this->RedirectUrl("musteri/musteri_detay/id/$id/kayit/ok");
        } else {

        }


    }

    function musteri_detay()
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
        $data["cls"] = $this->Model("musteri/anasayfa");
        $this->View("muhasebe/satis/head", $data);
        $this->View("muhasebe/satis/musteri_detay", $data);
        $this->View("muhasebe/satis/footer");
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
        $data["cls"] = $this->Model("musteri/anasayfa");
        $this->View("muhasebe/satis/head", $data);
        $this->View("muhasebe/satis/musteri_guncelle", $data);
        $this->View("muhasebe/satis/footer");


    }

    function arsiveal(){
        echo $this->Model("nakit/anasayfa")->kasabankaarsiv($this->val->id);

    }
}

