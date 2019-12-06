<?php $musteri = $cls->calisan($id); ?>
<div class="page-container">
    <?php INCLUDE TEMA . '/muhasebe/sidebar.php'; ?>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-diamond font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">GİDERLER</span>
                        / <a href="<?php SELF::go("calisan/calisan_listesi"); ?>"><span class="caption-helper">ÇALIŞAN LİSTESİ</span></a>
                        / <span class="caption-helper">Yeni Maaş / Prim</span>
                    </div>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="row" id="hata" style="display: none;">
                    <div class="col-sm-2"></div>
                    <div class="col-md-4">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <strong>Hata ! </strong><span id="hata_ic"></span>
                        </div>
                    </div>
                </div>
                <br />
                <form class="form-horizontal" id="yenimaas_form" action="<?php SELF::go("calisan/yeni_maas_ekle"); ?>" method="post">
                    <input type="hidden" value="<?php echo $musteri->id; ?>" name="calisan" />
                    <input type="hidden" value="c_maas" name="islem" />
                    <input type="hidden" value="<?php echo $musteri->id; ?>" name="islemid" />
                <div class="portlet-content">
                    <div class="form-group">
                        <label class="col-md-2 control-label">ÇALIŞAN</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"  value="<?php echo $musteri->adi; ?>" disabled />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">AÇIKLAMA</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="aciklama" maxlength="200" />
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">HAKEDİŞ TARİHİ</label>
                            <div class="col-md-6">
                                <div class="input-group date date-picker input-medium" data-date-format="dd-mm-yyyy">
                                    <input type="text" value="<?php echo date('d-m-Y') ?>" class="form-control" name="hak_edis_tarihi" readonly required="required">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="icon-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">TOPLAM TUTAR</label>
                            <div class="col-md-6">
                                <div class="input-group input-medium">
                                    <input type="text" data-type='currency' value="" class="form-control" name="miktar" placeholder="1.000" required="required">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn green" tabindex="-1" id="kurbtn"><i class="fa fa-try"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group">
                            <label class="col-md-2 control-label">ÖDEME DURUMU</label>
                            <div class="col-md-6">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="odeme_durum" value="0" checked> Ödenecek
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="odeme_durum" value="1"> Ödendi
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="odenecek">
                            <label class="col-md-2 control-label">ÖDENECEĞİ TARİH</label>
                            <div class="col-md-6">
                                <div class="input-group date date-picker input-medium" data-date-format="dd-mm-yyyy">
                                    <input type="text" value="<?php echo date('d-m-Y') ?>" name="odenecegi_tarih" class="form-control" readonly required="required">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="icon-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="odendi" style="display: none;">
                            <label class="col-md-2 control-label">ÖDENDİĞİ TARİH ve HESAP</label>
                            <div class="col-md-6">
                                <div class="col-md-4" style="padding: 0px;">
                                    <div class="input-group date date-picker input-medium" data-date-format="dd-mm-yyyy">
                                        <input type="text" value="<?php echo date('d-m-Y') ?>" class="form-control" name="odendigi_tarih" readonly required="required">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="icon-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control input-medium" name="kasa" >
                                        <?php foreach ($cls->kasalar() as $kasa) { ?>
                                            <option value="<?php echo $kasa->id; ?>"><?php echo $kasa->ad; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                    <hr />
                <div class="portlet-footer0" style="padding-left: 140px;">
                        <button type="button" onclick="window.history.go(-1); return false;"class="btn btn-outline dark" style="margin-right: 15px;">Vazgeç</button>
                        <button type="submit" class="btn green">Kaydet</button>
                </div>
                </form>
            </div>
        </div>

    </div>
<script>
    var ANASAYFA = '<?php echo SITE; ?>';
</script>
<script src="<?php echo SKIN; ?>assets/muhasebe/js/calisan.js" type="text/javascript"></script>
</div>