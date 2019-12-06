<?php
$musteri = $cls->calisan($id);
$ensonay=$cls->ensonay($musteri->id);
if($ensonay){
    $maas=$ensonay->id;
    $meblag=$ensonay->bakiye;
}
else{
    $maas=0;
    $meblag="0,00";
}
$geciken=0;
$bugun_o=0;
$odenecek=0;
$bugun=date("Y-m-d");
$maaslar=$cls->maaslar($musteri->id);
if($maaslar){
    foreach ($maaslar as $row){
        $deger=str_replace(".", "", $row->bakiye);
        $deger=str_replace(",", ".", $deger);
        if($row->odenecek_tarih < $bugun)
            $geciken=$geciken+$deger;
        else if($row->odenecek_tarih > $bugun)
            $odenecek=$odenecek+$deger;
        else
            $bugun_o=$bugun_o+$deger;
    }
}
?>
<link href="<?php echo SKIN; ?>assets/muhasebe/css/calisan.css" rel="stylesheet" type="text/css"/>
<div class="page-container">
    <?php INCLUDE TEMA . '/muhasebe/sidebar.php'; ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-diamond font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">GİDERLER</span>
                        / <a href="<?php SELF::go("calisan/calisan_listesi"); ?>"><span class="caption-helper">ÇALIŞAN LİSTESİ</span></a>
                        / <span class="caption-helper">ÇALIŞAN DETAY</span>
                    </div>
                    <?php if(isset($mesaj)): ?>
                    <br />
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php echo $mesaj; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user font-green"></i>
                                <span class="caption-subject font-green bold uppercase"><?php echo $musteri->adi; ?></span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="<?php SELF::go('calisan/guncelle/id/' . $musteri->id); ?>"><i class="icon-pencil"></i></a>
                            </div>
                        </div>
                        <div class="portlet-content">
                            <div class="row">
                                <div class="control-label col-md-3 font-green-sharp">ADI</div>
                                <div class="col-md-3">
                                    <?php echo $musteri->adi; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-label col-md-3 font-green-sharp">E-POSTA ADRESİ</div>
                                <div class="col-md-3">
                                    <?php echo $musteri->mail; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-label col-md-3 font-green-sharp">TC KİMLİK NO</div>
                                <div class="col-md-3">
                                    <?php echo $musteri->tc; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-label col-md-3 font-green-sharp">IBAN NUMARASI</div>
                                <div class="col-md-3">
                                    <?php echo $musteri->iban; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="portlet light bordered">
                        <div class="btnnn">
                            <a class="btn btn-sm blue-hoki" href="<?php SELF::go('calisan/yeni_maas/id/'.$musteri->id); ?>" style="margin-right: 10px;margin-bottom: 15px;">YENİ MAAŞ / PRİM OLUŞTUR</a>
                            <button class="btn btn-sm blue" onclick="ac()" style="margin-bottom: 15px;">ÖDEME EKLE</button>
                        </div>
                        <div class="row padding-0-15 odeme" style="display: none;">
                            <form class="form-horizontal form-group-m0" action="<?php SELF::go("calisan/calisan_avans"); ?>" method="post">
                                <input type="hidden" value="<?php echo $musteri->id; ?>" name="calisan">
                                <input type="hidden" value="<?php echo $maas; ?>" name="maas">
                                <div class="form-group">
                                    <div class="col-md-3 padding-0">
                                        <label class="caption-subject font-green-sharp bold">Tarih *:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                            <input type="text" value="<?php echo date('d-m-Y') ?>" name="tarih" class="form-control input-small" readonly required="required">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="icon-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 padding-0">
                                        <label class="caption-subject font-green-sharp bold">Hesap *:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control" required="required" onchange="kg(this)" name="kasa">
                                            <option value="">Kasa Seçiniz</option>
                                            <?php foreach ($cls->tl_kasalar() as $kasa) { ?>
                                                <option value="<?php echo $kasa->id; ?>"><?php echo  $kur_ikon->kur_html($kasa->acilis_doviz)." / ".$kasa->ad; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group margin-lr0">
                                        <div class="col-md-3 padding-0">
                                            <label class="caption-subject font-green-sharp bold">Meblağ *:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <i class="fa fa-try font-green"></i>
                                                <input type="text" data-type='currency' value="<?php echo $meblag; ?>" name="miktar" onkeyup="doviz_sonuc(this)" class="form-control" placeholder="1.000" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 padding-0">
                                        <label class="caption-subject font-green-sharp bold">Açıklama:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Açıklama" class="form-control" name="aciklama" maxlength="200">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <center>
                                        <button type="button" onclick="kb()" class="btn btn-outline dark">Vazgeç</button>
                                        <button type="submit" class="btn green">ÖDEME EKLE</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                        <hr />
                        <?php
                        if($geciken != 0)
                            echo '<h5 class="liste font-red-thunderbird">Ödemesi Gecikmiş : <span> '.number_format($geciken, 2, ",", ".").' ₺</span></h5>';
                        if($bugun_o != 0)
                            echo '<h5 class="liste font-yellow-casablanca">Bugün Ödenecek : <span> '.number_format($bugun_o, 2, ",", ".").' ₺</span></h5>';
                        if($odenecek != 0)
                            echo '<h5 class="liste font-grey-cascade">Ödenecek Maaş : <span> '.number_format($odenecek, 2, ",", ".").' ₺</span></h5>';
                        ?>
                        <hr />
                        <h5 class="liste font-grey-mint">Toplam : <span><?php echo $musteri->bakiye; ?> ₺</span></h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
<script>
var ANASAYFA = '<?php echo SITE; ?>';
</script>

<script src="<?php echo SKIN; ?>assets/muhasebe/js/calisan.js" type="text/javascript"></script>
</div>