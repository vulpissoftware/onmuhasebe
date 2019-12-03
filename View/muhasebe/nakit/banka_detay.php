<?php $b_k = $cls->b_k($id); ?>
<script>
    var sayfakur = '<?php echo $b_k->acilis_doviz; ?>';

    var ANASAYFA = '<?php echo SITE; ?>'; </script>
<!-- BEGIN CONTAINER -->
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
                        <i class="fa fa-bank font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">NAKİT İŞLEMLER</span>
                        / <a href="<?php SELF::go("nakit/kasa_banka"); ?>"><span
                                    class="caption-helper">KASA VE BANKALAR</span></a> / <span class="caption-helper"><?php

                            if ($b_k->b_k == "KASA") echo "KASA HESABI"; else echo "BANKA"; ?></span>
                    </div>
                    <?php if ($mesaj): ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php echo $mesaj; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="page-footer"></div>
            <div class="row">


                <div class="col-md-8">
                    <div class="portlet light form-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">


                                <?php if ($b_k->b_k == "KASA") echo "<i class=\"fa fa-money font-green\"></i>"; else echo "<i class=\"fa fa-bank font-green\"></i>"; ?>


                                <span class="caption-subject font-green bold uppercase"><?php echo $b_k->ad; ?></span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-cloud-upload"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                    <i class="icon-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="mt-clipboard-container">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis luctus elit, in
                                    auctor libero suscipit id. Nulla efficitur purus ac rutrum efficitur.
                                    <span id="mt-target-4" class="mt-highlight bg-yellow-lemon">Donec hendrerit, ipsum sit amet maximus dignissim</span>,
                                    erat est porttitor leo, ac porttitor sem ex sit amet odio. Suspendisse bibendum
                                    rhoncus tortor, luctus placerat nibh convallis in.</p>
                                <a href="javascript:;" class="btn green-turquoise mt-clipboard"
                                   data-clipboard-action="copy" data-clipboard-target="#mt-target-4">
                                    <i class="icon-note"></i> Copy Highlighted Text</a>
                                <a href="javascript:;" class="btn purple-seance mt-clipboard"
                                   data-clipboard-action="copy"
                                   data-clipboard-text="You found me! Just because you can't see me doesn't mean you can't copy me.">
                                    <i class="icon-note"></i> Copy Hidden Text</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-green"></i>
                                <span class="caption-subject font-green bold uppercase">İşlemler</span>
                            </div>
                            <div class="actions">

                                <button type="button" class="btn purple-plum">Bakiye Sabitle</button>

                                <button type="button" class="btn yellow-crusta">Hesabı Arşivle</button>

                                <button type="button" class="btn red-sunglo"><i class="icon-trash"></i> Hesabı Sil
                                </button>


                            </div>
                        </div>


                        <div class="portlet-body form">
                            <div class="mt-clipboard-container">


                                <style>
                                    .eh {
                                        display: none;
                                    }

                                    .dh {
                                        display: none;
                                    }

                                    .gh {
                                        display: none;
                                    }

                                    .dhty {
                                        display: none;
                                    }

                                    .pge {
                                        display: none;
                                    }

                                    .pce {
                                        display: none;
                                    }
                                </style>

                                <input type="hidden" id="cikan_kasa_id" value="<?php echo $id; ?>" ></input>

                                    <!--  Diğer hesaba  hesaplar arası transfer işlemi  -->
                                    <div class="form-body dhty">



                                    <div class="caption-subject font-green bold uppercase">
                                        <p><i class="fa fa-share"></i> DİĞER HESABA TRANSFER</p>

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4">TRANSFER HESAP</label>
                                        <div class="col-md-8">

                                            <select data-show-subtext="true" class="form-control input-medium"
                                                    id="frmktgr"
                                                    onchange="if(this.value) {diger_hesap(this.value); $('#digerhesapsec').show();} else {$('#digerhesapsec').hide();}"
                                                    name="diger_hesap">
                                                <option value="">KASA / BANKA SEÇİNİZ</option>
                                                <?php foreach ($cls->digerb_k($id) as $value) { ?>
                                                    <option value="<?php echo $value->id; ?>">
                                                        <?php if ($value->acilis_doviz == "TL"): ?>
                                                            &#8378;
                                                        <?php elseif ($value->acilis_doviz == "USD"): ?>
                                                            &dollar;
                                                        <?php elseif ($value->acilis_doviz == "EUR"): ?>
                                                            &#8364;
                                                        <?php elseif ($value->acilis_doviz == "GBP"): ?>
                                                            &pound;
                                                        <?php endif; ?>

                                                        <?php echo $value->ad; ?></option>
                                                <?php } ?>

                                            </select>

                                        </div>
                                    </div>

                                    <div id="digerhesapsec" style="display: none">


                                        <div class="form-group">
                                            <label class="control-label col-md-4">TARİHİ</label>

                                            <div class="col-md-8 input-group" style="padding-left: 15px;">
                                                <input type="text" id="transfer_trh" value="<?php echo date('d-m-Y') ?>"
                                                       class="form-control input-medium datepicker" readonly
                                                       name="acilis_tarih">

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-4">MEBLAĞ</label>


                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" data-type='currency' name="t_meblag" id="t_meblag"
                                                       value="" class="form-control" placeholder="0,00">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1" id="kasa_kur">

                                                        <?php if ($b_k->acilis_doviz == "TL"): ?>

                                                            <i class="fa fa-try"></i>

                                                        <?php elseif ($b_k->acilis_doviz == "USD"): ?>
                                                            <i class="fa fa-usd"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                            <i class="fa fa-euro"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                            <i class="fa fa-gbp"></i>
                                                        <?php endif; ?>

                                                    </button>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group th">
                                            <label class="control-label col-md-4">DOVİZ KURU</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" id="tl_kur" name="tl_kur" value=""
                                                       class="form-control" placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <?php if ($b_k->acilis_doviz == "USD"): ?>
                                                            <i class="fa fa-usd"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                            <i class="fa fa-euro"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                            <i class="fa fa-gbp"></i>
                                                        <?php endif; ?> / <i class="fa fa-try"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group th">
                                            <label class="control-label col-md-4">TL KARŞILIĞI</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" data-type='currency' id="tl_meblag" name="tl_meblag"
                                                       value="" class="form-control" placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <i class="fa fa-try"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group dh">
                                            <label class="control-label col-md-4">DOVİZ KURU</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" id="dolar_kur" name="dolar_kur" value=""
                                                       class="form-control" placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <?php if ($b_k->acilis_doviz == "TL"): ?>

                                                            <i class="fa fa-try"></i>

                                                        <?php elseif ($b_k->acilis_doviz == "USD"): ?>
                                                            <i class="fa fa-usd"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                            <i class="fa fa-euro"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                            <i class="fa fa-gbp"></i>
                                                        <?php endif; ?> / <i class="fa fa-usd"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group dh">
                                            <label class="control-label col-md-4">USD KARŞILIĞI</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" data-type='currency' id="dolar_meblag"
                                                       name="dolar_meblag" value="" class="form-control"
                                                       placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <i class="fa fa-usd"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group eh">
                                            <label class="control-label col-md-4">DOVİZ KURU</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" id="eur_kur" name="eur_kur" value=""
                                                       class="form-control" placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <?php if ($b_k->acilis_doviz == "TL"): ?>

                                                            <i class="fa fa-try"></i>

                                                        <?php elseif ($b_k->acilis_doviz == "USD"): ?>
                                                            <i class="fa fa-usd"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                            <i class="fa fa-euro"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                            <i class="fa fa-gbp"></i>
                                                        <?php endif; ?> / <i class="fa fa-euro"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group eh">
                                            <label class="control-label col-md-4">EURO KARŞILIĞI</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" data-type='currency' id="eur_meblag"
                                                       name="eur_meblag" value="" class="form-control"
                                                       placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <i class="fa fa-euro"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group gh">
                                            <label class="control-label col-md-4">DOVİZ KURU</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" name="gbp_kur" id="gbp_kur" value=""
                                                       class="form-control" placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <?php if ($b_k->acilis_doviz == "TL"): ?>

                                                            <i class="fa fa-try"></i>

                                                        <?php elseif ($b_k->acilis_doviz == "USD"): ?>
                                                            <i class="fa fa-usd"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                            <i class="fa fa-euro"></i>
                                                        <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                            <i class="fa fa-gbp"></i>
                                                        <?php endif; ?> / <i class="fa fa-gbp"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group gh">
                                            <label class="control-label col-md-4">GBP KARŞILIĞI</label>

                                            <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                                <input type="text" data-type='currency' id="gbp_meblag"
                                                       name="gbp_meblag" value="" class="form-control"
                                                       placeholder="0,00">

                                                <div class="input-group-btn">
                                                    <button type="button" class="btn green" tabindex="-1">


                                                        <i class="fa fa-gbp"></i>


                                                    </button>

                                                </div>
                                            </div>


                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-4">AÇIKLAMA</label>
                                            <div class="col-md-8">


                                                <input type="text" placeholder="AÇIKLAMA" name="aciklama" id="trfaciklama"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <br>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <p onclick="dghsbtryap(); return false;" class="btn green">
                                                        <i class="fa fa-plus"></i> KAYDET
                                                    </p>
                                                    <button type="button" class="btn default" onclick="dhty()"> VAZGEÇ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>




                                    <div class="form-body pge">
                                    <div class="caption-subject font-green bold uppercase">
                                        <p><i class="fa fa-level-down"></i> PARA GİRİŞİ EKLE</p>

                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-4">TARİHİ</label>

                                        <div class="col-md-8 input-group" style="padding-left: 15px;">
                                            <input type="text" value="<?php echo date('d-m-Y') ?>"
                                                   class="form-control input-medium datepicker" readonly
                                                   name="pge_tarih">

                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-4">MEBLAĞ</label>


                                        <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                            <input type="text" data-type='currency' name="pge_meblag" value=""
                                                   class="form-control" placeholder="0,00">
                                            <input type="hidden" name="pge_meblag_doviz"
                                                   value="<?php echo $b_k->acilis_doviz ?>>">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn green" tabindex="-1">

                                                    <?php if ($b_k->acilis_doviz == "TL"): ?>

                                                        <i class="fa fa-try"></i>

                                                    <?php elseif ($b_k->acilis_doviz == "USD"): ?>
                                                        <i class="fa fa-usd"></i>

                                                    <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                        <i class="fa fa-eur"></i>

                                                    <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                        <i class="fa fa-gbp"></i>

                                                    <?php endif; ?>


                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">AÇIKLAMA</label>
                                        <div class="col-md-8">


                                            <input type="text" placeholder="AÇIKLAMA" name="pge_aciklama"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <br>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-plus"></i> KAYDET
                                                </button>
                                                <button type="button" class="btn default" onclick="pge()"> VAZGEÇ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                    <div class="form-body pce">
                                    <div class="caption-subject font-green bold uppercase">
                                        <p><i class="fa fa-level-up"></i> PARA ÇIKIŞI EKLE</p>

                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-4">TARİHİ</label>

                                        <div class="col-md-8 input-group" style="padding-left: 15px;">
                                            <input type="text" value="<?php echo date('d-m-Y') ?>"
                                                   class="form-control input-medium datepicker" readonly
                                                   name="pce_tarih">

                                        </div>

                                    </div>

                                    <script>

                                        $(window).load(function () {
                                            $('.datepicker').datepicker({
                                                format: 'dd-mm-yyyy',
                                                language: 'tr',
                                                autoclose: true
                                            });
                                        });
                                    </script>


                                    <div class="form-group">
                                        <label class="control-label col-md-4">MEBLAĞ</label>


                                        <div class="col-md-8 input-group input-medium " style="padding-left: 15px;">
                                            <input type="text" data-type='currency' name="pce_meblag" value=""
                                                   class="form-control" placeholder="0,00">
                                            <input type="hidden" name="pce_meblag_doviz"
                                                   value="<?php echo $b_k->acilis_doviz ?>>">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn green" tabindex="-1">

                                                    <?php if ($b_k->acilis_doviz == "TL"): ?>

                                                        <i class="fa fa-try"></i>

                                                    <?php elseif ($b_k->acilis_doviz == "USD"): ?>
                                                        <i class="fa fa-usd"></i>

                                                    <?php elseif ($b_k->acilis_doviz == "EUR"): ?>
                                                        <i class="fa fa-eur"></i>

                                                    <?php elseif ($b_k->acilis_doviz == "GBP"): ?>
                                                        <i class="fa fa-gbp"></i>

                                                    <?php endif; ?>


                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">AÇIKLAMA</label>
                                        <div class="col-md-8">


                                            <input type="text" placeholder="AÇIKLAMA" name="pce_aciklama"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <br>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-plus"></i> KAYDET
                                                </button>
                                                <button type="button" class="btn default" onclick="pce();return false;"> VAZGEÇ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>


                        <div id="butonlar">
                            <button type="button" onclick="dhty('b')" class="btn blue-hoki">Diğer Hesaba Transfer Yap
                            </button>

                            <button type="button" onclick="pge('b')" class="btn blue-madison">Para Girişi Ekle</button>

                            <button type="button" onclick="pce('b')" class="btn green-meadow">Para Çıkışı Ekle</button>
                        </div>


                    </div>
                </div>
            </div>

        </div>

        <script src="<?php echo SKIN; ?>assets/muhasebe/js/kasa.js" type="text/javascript"></script>
        <script>kurcek();</script>

    </div>

</div>
</div>