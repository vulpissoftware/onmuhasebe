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

        $id = $data["cls"]->kaydet("calisan", $veri);
        if ($id >= 1) {
            $this->RedirectUrl("calisan/calisan_detay/id/$id/kayit/ok");
        } else {
        }


    }

    function calisan_detay()
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
        $this->View("muhasebe/gider/calisan_detay", $data);
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
}
