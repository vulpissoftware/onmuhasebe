<script>   var ANASAYFA = '<?php echo SITE; ?>'; </script>
<link href="<?php echo SKIN; ?>assets/muhasebe/css/musteri.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo SKIN; ?>assets/muhasebe/js/musteri.js" type="text/javascript"></script>
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
                        <i class="icon-diamond font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">GİDERLER</span>
                        / <a href="<?php SELF::go("calisan/calisan_listesi"); ?>"><span class="caption-helper">ÇALIŞAN LİSTESİ</span></a>
                        / <span class="caption-helper">ÇALIŞAN KAYDET</span>
                    </div>


                        <div class="portlet light bg-inverse form-fit">

                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?php SELF::go("calisan/calisan_ekle"); ?>" method="post"
                                      class="form-horizontal form-row-seperated">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ADI SOYADI *</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="ADI SOYADI *" name="isim"
                                                       class="form-control" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">E-POSTA ADRESİ</label>
                                            <div class="col-md-9">
                                                <input type="email" placeholder="E-POSTA ADRESİ" name="mail"
                                                       class="form-control input-medium">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">TC KİMLİK NO</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="TC KİMLİK NO" name="tc"
                                                       class="form-control input-medium">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">IBAN NUMARASI</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="IBAN NUMARASI" name="iban"
                                                       class="form-control input-medium">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">KATEGORİ</label>
                                            <div class="col-md-9">
                                                <select class="form-control input-medium" id="frmktgr"
                                                        name="kategori">
                                                    <option value="0">Kategorisiz</option>
                                                    <?php foreach ($cls->calisankategori() as $value) { ?>
                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->isim; ?></option>
                                                    <?php } ?>

                                                </select>
                                                <a class="btn red btn-outline sbold" data-toggle="modal"
                                                   href="#modalfkc"> YENİ EKLE</a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modalfkc" tabindex="-1" role="basic"
                                             aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                        <h4 class="modal-title">Çalışan Kategori Ekleme</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Kategori İsmi</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="ktgyeni" placeholder=""
                                                                       class="form-control">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn dark btn-outline"
                                                                data-dismiss="modal">Kapat
                                                        </button>
                                                        <button type="button" onclick="calisankatedoriekle();"
                                                                class="btn green">Kaydet
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">
                                            <i class="fa fa-plus"></i> KAYDET
                                        </button>
                                        <button type="button" class="btn default" onclick="geri()"> VAZGEÇ</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <!-- END FORM-->
                            <script>
                                function geri() {


                                    location.replace('<?php SELF::go('calisan/calisan_listesi'); ?>');
                                    return false;
                                }

                            </script>
                        </div>


                </div>
            </div>
        </div>
    </div>

</div>
                