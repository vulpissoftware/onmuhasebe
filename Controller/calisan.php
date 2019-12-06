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
        $veri["bakiye"] = "0";

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

        $id=$this->val->calisan;
        $veri["calisan"] = $this->val->calisan;
        $veri["maas_id"] = $this->val->maas;
        $veri["tarih"] = date_format(date_create($this->val->tarih), "Y-m-d");
        $veri["kasa"] = $this->val->kasa;
        $veri["miktar"] = $this->val->miktar;
        $veri["aciklama"] = $this->val->aciklama;
        $veri["islem_id"] = $this->val->maas;
        if($this->val->maas == 0)
            $veri["islem"] = "c_avans";
        else
            $veri["islem"] = "c_odeme";
        $calisan=$data["cls"]->calisan($id);
        $toplam=str_replace(".", "", $calisan->bakiye);
        $toplam=str_replace(",", ".", $toplam);
        $odenen=str_replace(".", "", $veri['miktar']);
        $odenen=str_replace(",", ".", $odenen);
        $toplam=$toplam-$odenen;
        $maas_cek=$data["cls"]->maas_cek($this->val->maas);
        if($maas_cek){
            $maas=str_replace(".", "", $maas_cek->bakiye);
            $maas=str_replace(",", ".", $maas);
            if($maas > $odenen){
                $maas_son=$maas-$odenen;
                $maas_son=number_format($maas_son, 2, ",", ".");
                $veri1["bakiye"] = $maas_son;
                $data["cls"]->maasupdate($veri["maas_id"], $veri1);
            }
            else if($maas == $odenen){
                $maas_son=0;
                $maas_son=number_format($maas_son, 2, ",", ".");
                $veri1["bakiye"] = $maas_son;
                $veri1["odeme_durumu"] = 1;
                $data["cls"]->maasupdate($veri["maas_id"], $veri1);
            }
            else{
                $maas_son=0;
                $maas_son=number_format($maas_son, 2, ",", ".");
                $veri1["bakiye"] = $maas_son;
                $veri1["odeme_durumu"] = 1;
                $data["cls"]->maasupdate($veri["maas_id"], $veri1);
                $odenen=$odenen-$maas;
                $ay_maaslar=$data["cls"]->ay_maaslar($veri["calisan"], $veri["maas_id"]);
                if($ay_maaslar){
                    foreach ($ay_maaslar as $ay_maas) {
                        $maas=str_replace(".", "", $ay_maas->bakiye);
                        $maas=str_replace(",", ".", $maas);
                        if($maas > $odenen){
                            $maas_son=$maas-$odenen;
                            $maas_son=number_format($maas_son, 2, ",", ".");
                            $veri1["bakiye"] = $maas_son;
                            $veri1["odeme_durumu"] = 0;
                            $data["cls"]->maasupdate($ay_maas->id, $veri1);
                            break;
                        }
                        else if($maas == $odenen){
                            $maas_son=0;
                            $maas_son=number_format($maas_son, 2, ",", ".");
                            $veri1["bakiye"] = $maas_son;
                            $veri1["odeme_durumu"] = 1;
                            $data["cls"]->maasupdate($ay_maas->id, $veri1);
                            break;
                        }
                        else{
                            $maas_son=0;
                            $maas_son=number_format($maas_son, 2, ",", ".");
                            $veri1["bakiye"] = $maas_son;
                            $veri1["odeme_durumu"] = 1;
                            $data["cls"]->maasupdate($ay_maas->id, $veri1);
                            $odenen=$odenen-$maas;
                        }
                    }
                }
            }
        }
        $veri2["bakiye"]=number_format($toplam, 2, ",", ".");
        $data["cls"]->calisanupdate($id, $veri2);
        $data["cls"]->kaydet("calisan_hareketler", $veri);
        $this->RedirectUrl("calisan/calisan_detay/id/$id/kayit/avans");

    }
    function yeni_maas_ekle(){

        $data["cls"] = $this->Model("calisan/anasayfa");
        $veri = ARRAY();

        $veri["calisan"] = $this->val->calisan;
        $veri["hak_edis_tarihi"] = date_format(date_create($this->val->hak_edis_tarihi), "Y-m-d");
        $veri["miktar"] = $this->val->miktar;
        $veri["bakiye"] = $this->val->miktar;
        $veri["odeme_durumu"] = $this->val->odeme_durum;
        $veri["aciklama"] = $this->val->aciklama;
        $veri["etiketler"] =  "0";
        $veri["kategori"] =  0;
        $veri["tarih"] = date("Y-m-d");
        if($veri["odeme_durumu"] == 0) {
            $veri["odenecek_tarih"] = date_format(date_create($this->val->odenecegi_tarih), "Y-m-d");
            $veri["kasa"] =  0;
        }
        else {
            $veri["odenecek_tarih"] = date_format(date_create($this->val->odendigi_tarih), "Y-m-d");
            $veri["kasa"] =  $this->val->kasa;
        }

        $id=$this->val->calisan;
        $id2=$data["cls"]->kaydet("calisan_maas", $veri);

        $veri2["calisan"] = $this->val->calisan;
        $veri2["kasa"] = 0;
        $veri2["miktar"] = $this->val->miktar;
        $veri2["maas_id"] = $id2;
        $veri2["islem"] = $this->val->islem;
        $veri2["islem_id"] = $this->val->islemid;
        $veri2["aciklama"] = "Çalışana Maaş Oluşturuldu.";
        $veri2["tarih"] = date("Y-m-d");

        $data["cls"]->kaydet("calisan_hareketler", $veri2);

        $this->RedirectUrl("calisan/calisan_detay/id/$id/kayit/maas");
    }
}
