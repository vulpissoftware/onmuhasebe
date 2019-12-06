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
                        <span class="caption-subject font-green-haze bold uppercase">GİDERLER</span> / <span
                                class="caption-helper">ÇALIŞAN LİSTESİ</span>
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
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">Çalışan Listesi</span>
                            </div>


                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="sample_editable_1_new" onclick="ekle();"
                                                    class="btn sbold green"> Ekle
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn green  btn-outline dropdown-toggle"
                                                    data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:yazdir();">
                                                        <i class="fa fa-print"></i> Print </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                                <div class="row">

                                    <div class="col-md-6 col-sm-6">
                                        <div id="sample_1_filter" class="dataTables_filter">
                                            <label>Search:<input type="search"
                                                                 class="form-control input-sm input-small input-inline"
                                                                 placeholder="" aria-controls="sample_1">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
                                           id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                        <tr role="row">
                                            <th width="20px"></th>
                                            <th class=""> Adı</th>
                                            <th width="180px"> İşlemler</th>
                                        </tr>
                                        </thead>
                                        <tbody id="sayfa">

                                        <?php
                                        $veri = $cls->calisanlar();
                                        $i = 0;
                                        foreach ($veri->veri as $musteriler):
                                            $i++;
                                            ?>
                                            <tr class="gradeX odd sil_<?php echo $musteriler->id; ?>" role="row">
                                                <td>
                                                    <label>
                                                        <span><?php echo $i; ?></span>
                                                    </label>
                                                </td>
                                                <td class="sorting_1"><a
                                                            href="<?php SELF::go('calisan/calisan_detay/id/' . $musteriler->id) ?>"><?php echo $musteriler->adi; ?> </a>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                                                data-toggle="dropdown" aria-expanded="false"> İşlem
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="<?php SELF::go('calisan/guncelle/id/' . $musteriler->id); ?>">
                                                                    <i class="icon-docs"></i> Güncelle </a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript:sil('<?php echo $musteriler->id; ?>')">
                                                                    <i class="icon-ban"></i> Sil </a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>


                                        <?php endforeach; ?>


                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">

                                    <div class="col-md-12 col-sm-12">
                                        <!--
                                        // sayfalamada kullanılacak js ve css yuklmesi

                                        -->
                                        <link rel="stylesheet"
                                              href="<?php echo SKIN; ?>assets/pagination/css/style.css">
                                        <script src="<?php echo SKIN; ?>assets/pagination/js/index.js"></script>
                                        <div class="block-pagination" style="text-align: center">

                                            <div class="clear"></div>

                                            <?php if ($veri->toplam >= 1): ?>
                                                <ul class="pagination">
                                                    <div class="pagination content_detail__pagination cdp" actpage="1">
                                                        <a href="#!-1" onclick="sirala('e');" class="cdp_i">prev</a>
                                                        <?php for ($i = 1; $i <= $veri->sayfa; $i++) { ?>

                                                            <a href="#!<?php echo $i; ?>"
                                                               onclick="sirala(<?php echo $i; ?>);"
                                                               class="cdp_i"><?php echo $i; ?></a>

                                                        <?php } ?>

                                                        <a href="#!+1" onclick="sirala('a');" class="cdp_i">next</a>


                                                    </div>


                                                </ul>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>

            </div>
        </div>


        <script>

            var uid = "";

            function arsivid(id) {
                uid = id;

            }

            function ekle() {
                location.replace('<?php SELF::go('calisan/calisan'); ?>');
            }

            var suankisayfa = 1;

            function sirala(d) {

                if (d == "a") {
                    suankisayfa += 1;
                }
                if (d == "e") {
                    suankisayfa -= 1;
                } else {
                    suankisayfa = d;
                }

                $.post("<?php echo SITE; ?>/ajaxislemler/calisansayfalama", {sayfa: suankisayfa})
                    .done(function (data) {

                        $("#sayfa").html(data);

                    });


            }

            function yazdir() {
                var element = $("#sayfa").html();
                window.print();

            }


            function sil(id) {
                id = id.trim();
                var x = confirm("Silmek istiyormusunuz ? ");
                if (x == true) {

                    $.post("<?php echo SITE; ?>/ajaxislemler/calisansil", {id: id})
                        .done(function (data) {
                            var c = data.trim();
                            if (c == id) {

                                $(".sil_" + id).hide("slow");

                            } else {
                                alert("Silme işleminde sorun oluştu");
                            }
                        });
                    // silme işlemini yap
                } else {
                    alert("Silme işleminden vazgeçtiniz");
                }

            }


        </script>