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
                        / <a href="<?php SELF::go("nakit/kasa_banka"); ?>"><span class="caption-helper">KASA VE BANKALAR</span></a> / <span class="caption-helper">
                            <?php if ($b_k->b_k == "KASA") echo "KASA HESABI"; else echo "BANKA"; ?></span>
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

                <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true"
                     style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true"></button>
                                <h4 class="modal-title">
                                <?php if($b_k->bakiye == 0 || $b_k->bakiye == ""): ?>
                                    Bu kasa/banka kaydını arşivlemek istediğinize emin misiniz?
                                 <?php else: ?>
                                    Kayıt arşivlenemiyor
                                 <?php endif; ?>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <?php if($b_k->bakiye == 0 || $b_k->bakiye == ""): ?>
                                <p> Arşivleme işleminin sonucunda:</p>
                                <ul>
                                   <li> Kayıt artık Kasa ve Bankalar listelerinde görünmeyecek.</li>
                                   <li> Bu kasa/banka'ya işlenmiş kayıtlar etkilenmeyecek.</li>
                                </ul>
                                <?php else: ?>
                                    <p> Bu kasa/banka hesabı kaydı aşağıdaki sebep(ler)den ötürü arşivlenemiyor:</p>
                                    <ul>
                                        <li> Hesabın bakiyesi Sıfır değil..</li>

                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
                                    KAPAT
                                </button>
                                <?php if($b_k->bakiye == 0 || $b_k->bakiye == ""): ?>
                                <button onclick="arsiveal(<?php echo $id; ?>)" type="button" class="btn green">ARŞİVLE</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>


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


                                <table class="table table-striped responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">İşlem türü</th>
                                        <th scope="col">İşlem Tarihi</th>
                                        <th scope="col">İlgili Hesap</th>
                                        <th scope="col">Açıklama</th>
                                        <th scope="col">Meblağ</th>
                                        <th scope="col">Bakiye</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($b_k->acilis_bakiye): ?>
                                    <tr>
                                        <td><?php echo "AÇILIŞ BAKİYESİ" ?></td>
                                        <td><?php echo date_format(date_create($b_k->acilis_tarih), "d-m-Y"); ?></td>
                                        <td><?php ?></td>
                                        <td><?php echo "Hesap açılış Bakiyesi"; ?></td>
                                        <td><?php echo $b_k->acilis_bakiye; ?></td>
                                        <td><?php echo $b_k->acilis_bakiye; ?></td>
                                    </tr>

                                  <?php endif;  $veri = $cls->hesapharaketleri($id);
                                    if ($veri->veri):

                                    foreach ($veri->veri as $haraketler):
                                     ?>

                                    <tr>

                                        <td>
                         <?php $bk = 0;
                         if($haraketler->islem == "TRANSFER") {
                             $bk = 1;
                             echo "TRANSFER";
                         }
                         else if($haraketler->islem == "N_GIRIS"){
                             $bk = 1;
                                   echo "NAKİT GİRİŞ";
                         }
                         else if($haraketler->islem == "N_CIKIS"){
                             $bk = 1;
                                   echo "NAKİT ÇIKIŞ";
                         }
                         ?>
                                        </td>
                                        <td><?php echo date_format(date_create($haraketler->tarih), "d-m-Y"); ?></td>


                                        <td>
                                        <?php
                                            if($bk==1 && $id != $haraketler->cikis_b_k){
                                              echo  $cls->b_k_ad($haraketler->cikis_b_k);
                                            }
                                            elseif ($bk==1 && $id != $haraketler->giris_b_k) {
                                                echo  $cls->b_k_ad($haraketler->giris_b_k);
                                            }
                                         ?>

                                        </td>
                                        <td>
                                            <?php if($bk==1 && !$haraketler->aciklama){
                                                echo    "<span class=\"caption-subject font-green bold uppercase\" >".$cls->b_k_ad($haraketler->cikis_b_k) ." <i class=\"fa fa-long-arrow-right \" aria-hidden=\"true\"></i> ".$cls->b_k_ad($haraketler->giris_b_k) ."</span>";
                                            } else echo $haraketler->aciklama; ?>  </td>
                                        <td><?php

                                            if($haraketler->cikis_b_k == $id){

                                                echo "- $haraketler->cikan_miktar";
                                            } else if($haraketler->giris_b_k == $id)
                                            echo  $haraketler->giris_miktar ;

                                            ?></td>
                                        <td><?php

                                            if($haraketler->cikis_b_k == $id){

                                                echo  $haraketler->cikan_hesap_son_miktar;
                                            } else if($haraketler->giris_b_k == $id)
                                              echo  $haraketler->giris_hesap_son_miktar;

                                            ?></td> </tr>

                                <?php  endforeach;  endif; ?>
                                    <tr><td colspan="5"></td><td colspan="1"><h5><?php if($b_k->bakiye) echo  $b_k->bakiye  ." " .$b_k->acilis_doviz; ?></h5></td></tr>
                                      </tbody>
                                </table>






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

                                <button type="button"  data-toggle="modal" href="#basic" class="btn yellow-crusta">Hesabı Arşivle</button>

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
                                                <button type="submit" onclick="paragirisiekle();return false;" class="btn green">
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
                                                <button type="submit" onclick="paracikisiekle(); return false;" class="btn green">
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