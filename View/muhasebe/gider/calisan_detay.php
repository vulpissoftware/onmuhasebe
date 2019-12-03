<?php $musteri = $cls->calisan($id); ?>
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
                        / <span class="caption-helper">ÇALIŞAN DETAY</span>
                    </div>
                    <?php if ($mesaj): ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php echo $mesaj; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="portlet light bordered">
                        <div class="portlet-title">

                            <div class="caption">
                                <i class="fa fa-cubes font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase"><?php echo $musteri->adi; ?></span>

                            </div>

                            <div>

                                <link href="<?php echo SKIN; ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"
                                      rel="stylesheet" type="text/css"/>
                                <link href="<?php echo SKIN; ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css"
                                      rel="stylesheet" type="text/css"/>


                                <!-- BEGIN PAGE LEVEL PLUGINS -->
                                <script src="<?php echo SKIN; ?>assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"
                                        type="text/javascript"></script>
                                <script src="<?php echo SKIN; ?>assets/global/plugins/typeahead/handlebars.min.js"
                                        type="text/javascript"></script>
                                <script src="<?php echo SKIN; ?>assets/global/plugins/typeahead/typeahead.bundle.min.js"
                                        type="text/javascript"></script>
                                <!-- END PAGE LEVEL PLUGINS -->
                                <!-- BEGIN THEME GLOBAL SCRIPTS -->
                                <script src="<?php echo SKIN; ?>assets/global/scripts/app.min.js"
                                        type="text/javascript"></script>
                                <!-- END THEME GLOBAL SCRIPTS -->
                                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                                <!-- END PAGE LEVEL SCRIPTS -->
                            </div>
                            <div class="actions">
                                <div class="btn-group">
                                    <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;"
                                       data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> İşlemler
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">

                                        <li class="divider"></li>
                                        <li>
                                            <a href="<?php SELF::go('calisan/guncelle/id/' . $musteri->id); ?>"><i
                                                        class="fa fa-circle-o-notch"></i> Güncelle </a>
                                        </li>
                                        <li>
                                            <a href="javascript:sil('<?php echo $id; ?>');"><i
                                                        class="fa fa-trash-o"></i> Sil </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>


                        </div>

                        <div class="portlet-title portlet light bordered">
                            <div class="kb col-md-12">
                                <div class="col-md-4"><i class="fa fa-envelope-o"></i> : <?php echo $musteri->mail; ?>
                                </div>
                                <div class="col-md-4">
                                    <button onclick="tb()" type="button" class="btn green">Tüm Bilgileri Görüntüle
                                    </button>
                                </div>

                            </div>

                            <div class="tb col-md-12" style="display: none">


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


                                <div class="col-md-12">
                                    <button onclick="kb()" type="button" class="btn green">Tüm Bilgileri Gizle</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>


            </div>
            <div class="portlet-body">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#tab_2_3" data-toggle="tab"> FATURA HARAKETLERİ </a>
                    </li>
                    <li>
                        <a href="#tab_2_4" data-toggle="tab"> FATURA HARAKETLERİ </a>
                    </li>

                </ul>
                <div class="tab-content">

                    <div class="tab-pane fade in active" id="tab_2_3">
                        <p> tab_2_3 </p>
                    </div>
                    <div class="tab-pane fade" id="tab_2_4">
                        <p> tab_2_4 </p>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>
</div>            </div>


<script>
    function kb() {

        $('.tb').hide();
        $('.kb').show();

    }

    function tb() {

        $('.tb').show();
        $('.kb').hide();

    }

    function sil(id) {

        var x = confirm("Silmek istiyormusunuz ? ");
        if (x == true) {

            $.post("<?php echo SITE; ?>/ajaxislemler/calisansil", {id: id})
                .done(function (data) {
                    if (data == id) {

                        location.replace("<?php SELF::go('calisan/calisan_listesi'); ?>");

                    } else {
                        alert("Silme işleminde sorun oluştu");
                    }
                });
            // silme işlemini yap
        } else {
            alert("Silme işleminden vazgeçtiniz");
        }

    }

    var ANASAYFA = '<?php echo SITE; ?>';
</script>

<script src="<?php echo SKIN; ?>assets/muhasebe/js/musteridetay.js" type="text/javascript"></script>
</div>