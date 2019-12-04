<?php

class calisan extends controller
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

    function calisan_listesi()
    {

        //  $this->cache->start();         
        $data["lang"] = ayhan::$dil;

        if (isset($this->val->kayit) == "ok") {

            $data["mesaj"] = "Kayıt İşlemi Başarılı";

        } else {

            $data["mesaj"] = "";

        }

        $data["cls"] = $this->Model("calisan/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/calisan_listesi", $data);
        $this->View("muhasebe/gider/footer");

        // \controller_help::controller->deneme();
    }

    function calisan()
    {


        //  $this->cache->start();         
        $data["lang"] = ayhan::$dil;


        $data["cls"] = $this->Model("calisan/anasayfa");

        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/calisan", $data);
        $this->View("muhasebe/gider/footer");

        // \controller_help::controller->deneme();
    }

    function calisan_guncelle()
    {

        $cls = $this->Model("calisan/anasayfa");
        $veri = ARRAY();

        $veri["adi"] = $this->val->isim;
        $veri["mail"] = $this->val->mail;
        $veri["tc"] = $this->val->tc;
        $veri["iban"] = $this->val->iban;
        $veri["kategori"] = $this->val->kategori;

        $cls->calisanupdate($this->val->id, $veri);

        if ($this->val->id >= 1) {
            $this->RedirectUrl("calisan/calisan_detay/id/" . $this->val->id . "/kayit/guncelleme");
        } else {

        }

    }

    function calisan_ekle()
    {

        $data["cls"] = $this->Model("calisan/anasayfa");
        $veri = ARRAY();

        $veri["adi"] = $this->val->isim;
        $veri["mail"] = $this->val->mail;
        $veri["tc"] = $this->val->tc;
        $veri["iban"] = $this->val->iban;
        $veri["kategori"] = $this->val->kategori;
        $veri["bakiye"] = 0;
        $veri["genel_toplam"] = 0;

        $id = $data["cls"]->kaydet("calisan", $veri);
        if ($id >= 1) {
            $this->RedirectUrl("calisan/calisan_detay/id/$id/kayit/ok");
        } else {
        }


    }

    function calisan_detay()
    {
        $data["lang"] = ayhan::$dil;
        if(isset($this->val->kayit)){
            if ($this->val->kayit == "ok") {
                $data["mesaj"] = "Kayıt İşlemi Başarılı";
            } else if ($this->val->kayit == "guncelleme") {
                $data["mesaj"] = "Güncelleme İşlemi Başarılı";
            } else if ($this->val->kayit == "avans") {
                $data["mesaj"] = "Avans Eklendi.";
            } else if ($this->val->kayit == "maas") {
                $data["mesaj"] = "Maaş / Prim Eklendi.";
            } else {
                $data["mesaj"] = "";
            }
        }
        $data["id"] = $this->val->id;
        $data['kur']=$this->help("kur");
        $data['kur_ikon']=$this->help("ikonlar");
        $data["cls"] = $this->Model("calisan/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/calisan_detay", $data);
        $this->View("muhasebe/gider/footer");
    }
    function yeni_maas() {
        $data["lang"] = ayhan::$dil;
        $data["id"] = $this->val->id;
        $data["cls"] = $this->Model("calisan/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/yeni_maas", $data);
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
        $data["cls"] = $this->Model("calisan/anasayfa");
        $this->View("muhasebe/gider/head", $data);
        $this->View("muhasebe/gider/calisan_guncelle", $data);
        $this->View("muhasebe/gider/footer");


    }

    function calisan_avans(){
        $data["cls"] = $this->Model("calisan/anasayfa");
        $veri = ARRAY();

        $veri["calisan"] = $this->val->calisan;
        $veri["kasa"] = $this->val->kasa;
        $veri["miktar"] = $this->val->miktar;
        $veri["maas_id"] = $this->val->maas;
        $veri["aciklama"] = $this->val->aciklama;
        $veri["tarih"] = $this->val->tarih;
        $id=$this->val->calisan;
        $data["cls"]->kaydet("calisan_hareketler", $veri);
        $this->RedirectUrl("calisan/calisan_detay/id/$id/kayit/avans");

    }
    function yeni_maas_ekle(){

        $data["cls"] = $this->Model("calisan/anasayfa");
        $veri = ARRAY();

        $veri["calisan"] = $this->val->calisan;
        $veri["hak_edis_tarihi"] = date_format(date_create($this->val->hak_edis_tarihi), "Y-m-d");
        $veri["miktar"] = $this->val->miktar;
        $veri["odeme_durumu"] = $this->val->odeme_durum;
        $veri["kasa"] =  $this->val->kasa;
        $veri["aciklama"] = $this->val->aciklama;
        $veri["doviz"] = $this->val->doviz;
        $veri["etiketler"] =  "0";
        $veri["kategori"] =  0;

        if($veri["odeme_durumu"] == 0)
            $veri["tarih"]=date_format(date_create($this->val->odenecegi_tarih), "Y-m-d");
        else
            $veri["tarih"]=date_format(date_create($this->val->odenecegi_tarih), "Y-m-d");

        $id=$this->val->calisan;
        $data["cls"]->kaydet("calisan_maas", $veri);
        $this->RedirectUrl("calisan/calisan_detay/id/$id/kayit/maas");
    }
}
