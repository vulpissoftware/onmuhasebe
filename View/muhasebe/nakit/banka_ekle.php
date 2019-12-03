<script>   var ANASAYFA = '<?php echo SITE; ?>'; </script>
<link href="<?php echo SKIN; ?>assets/muhasebe/css/musteri.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo SKIN; ?>assets/muhasebe/js/kasa.js" type="text/javascript"></script>
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
                                    class="caption-helper">KASA VE BANKALAR</span></a> / <span class="caption-helper">BANKA EKLE</span>
                    </div>

                    <div class="row">

                        <div class="portlet light bg-inverse form-fit">

                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?php SELF::go("nakit/banka_kaydet"); ?>" method="post"
                                      class="form-horizontal form-row-seperated">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><i class="fa fa-bank"></i>HESAP
                                                İSMİ</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="HESAP İSMİ" name="ad"
                                                       class="form-control input-large" required>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">BANKA</label>
                                            <div class="col-md-9">
                                                <select class="form-control input-medium" id="bankalar" name="banka">
                                                    <?php foreach ($cls->bankalar() as $value) { ?>
                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->ad; ?></option>
                                                    <?php } ?>

                                                </select>
                                                <a class="btn red btn-outline sbold" data-toggle="modal"
                                                   href="#modalbnk"> YENİ EKLE</a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modalbnk" tabindex="-1" role="basic"
                                             aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                        <h4 class="modal-title">YENİ BANKA EKLE</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Banka İsmi</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="bankayeni" placeholder=""
                                                                       class="form-control">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline"
                                                                data-dismiss="modal">Kapat
                                                        </button>
                                                        <button type="button" onclick="bankaekle();" class="btn green">
                                                            Kaydet
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">BANKA ŞUBESİ</label>
                                            <div class="col-md-9">
                                                <a style="float: left" class="btn btn-success"><i
                                                            class="fa fa-bank"></i></a>
                                                <input type="text" placeholder="BANKA ŞUBESİ"
                                                       class="form-control input-medium" name="sube">

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">HESAP NUMARASI</label>
                                            <div class="col-md-9">

                                                <a style="float: left" class="btn btn-success"><i
                                                            class="fa fa-tags"></i></a>
                                                <input type="text" placeholder="HESAP NUMARASI" name="hesap_no"
                                                       class="form-control input-medium">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">IBAN NUMARASI</label>
                                            <div class="col-md-9">

                                                <a style="float: left" class="btn btn-success"><i
                                                            class="fa fa-credit-card"></i></a>
                                                <input type="text" placeholder="IBAN NUMARASI" name="iban"
                                                       class="form-control input-medium">
                                                <span>  <hr> </span>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">AÇILIŞ BAKİYESİ TARİHİ</label>

                                            <div class="col-md-9 input-group">
                                                <a style="float: left" class="btn btn-success"><i
                                                            class="fa fa-calendar-check-o"></i></a>
                                                <input type="text" value="<?php echo date('d-m-Y') ?>"
                                                       class="form-control input-medium datepicker" readonly
                                                       name="acilis_tarih">

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
                                            <div class="col-md-12">
                                                <label class="control-label col-md-3">AÇILIŞ BAKİYESİ</label>


                                                <div class="col-md-3"><a style="float: left" class="btn btn-success"><i
                                                                class="fa fa-money"></i></a>
                                                    <div class="col-md-6 input-group input-medium">
                                                        <input type="text" data-type='currency' name="acilis_bakiyesi"
                                                               value="" class="form-control" placeholder="1.000">
                                                        <input type="hidden" id="fiyatkur" name="acilis_doviz"
                                                               value="TL">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn green" tabindex="-1"
                                                                    id="kurbtn"><i class="fa fa-try"></i></button>
                                                            <button type="button" class="btn green dropdown-toggle"
                                                                    data-toggle="dropdown" tabindex="-1"
                                                                    aria-expanded="false">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>


                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="javascript:pb('TL')">
                                                                        <i class="fa fa-try"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:pb('USD')">
                                                                        <i class="fa fa-usd"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:pb('EUR')">
                                                                        <i class="fa fa-eur"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:pb('GBP')">
                                                                        <i class="fa fa-gbp"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>


                                        </div>


                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-plus"></i> KAYDET
                                                </button>
                                                <button type="button" class="btn default" onclick="geri()"> VAZGEÇ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                                <script>
                                    function geri() {


                                        location.replace('<?php SELF::go('nakit/kasa_banka'); ?>');
                                        return false;
                                    }

                                </script>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
                