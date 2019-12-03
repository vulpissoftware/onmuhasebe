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
                        <span class="caption-subject font-green-haze bold uppercase">NAKİT İŞLEMLER</span> / <span
                                class="caption-helper">KASA VE BANKALAR</span>
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
                                <span class="caption-subject bold uppercase">BANKA VE KASALAR</span>
                            </div>


                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="sample_editable_1_new" onclick="ekleb();"
                                                    class="btn sbold blue-sharp"><i class="fa fa-bank"></i> BANKA EKLE

                                            </button>
                                            <span class="yamm-content"></span>
                                            <button id="sample_editable_1_new" onclick="eklek();"
                                                    class="btn sbold green"><i class="fa fa-money"></i> KASA EKLE

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
                                            <th class="">
                                                Sıra No
                                            </th>
                                            <th class=""> Tür</th>
                                            <th class=""> İsmi</th>
                                            <th class=""> Iban</th>
                                            <th class=""> Bakiye</th>
                                            <th class=""> Doviz Cinsi</th>

                                            <th class=""> İşlemler</th>
                                        </tr>
                                        </thead>
                                        <tbody id="sayfa">

                                        <?php
                                        $veri = $cls->banka_kasa_list();
                                        if ($veri->veri):
                                            $i = 0;
                                            foreach ($veri->veri as $banka_kasa):
                                                $i++;
                                                ?>
                                                <tr class="gradeX odd sil_<?php echo $banka_kasa->id; ?>" role="row">


                                                    <td>
                                                        <label>

                                                            <span><?php echo $i; ?></span>
                                                        </label>
                                                    </td>

                                                    <td>

                                                        <span>  <?php if ($banka_kasa->b_k == "KASA") {
                                                                echo "<i class=\"fa fa-money font-green-haze fa-lg\"></i>";
                                                            } else {
                                                                echo "<i class=\"fa fa-institution font-green-haze fa-lg\"></i>";
                                                            } ?>  </span>

                                                    </td>

                                                    <td class="sorting_1"><a
                                                                href="<?php SELF::go('nakit/bk_detay/id/' . $banka_kasa->id) ?>"><?php echo $banka_kasa->ad; ?> </a>
                                                    </td>
                                                    <td>

                                                        <span>  <?php echo $banka_kasa->iban; ?>  </span>

                                                    </td>

                                                    <td class="center">
                                                        <span>    <?php echo $banka_kasa->acilis_bakiye; ?>  </span>
                                                    </td>

                                                    <td>
                                                        <span>  <?php echo $banka_kasa->acilis_doviz; ?>  </span>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-expanded="false"> İşlem
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="<?php SELF::go('musteri/guncelle/id/' . $banka_kasa->id); ?>">
                                                                        <i class="icon-docs"></i> Güncelle </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:sil('<?php echo $banka_kasa->id; ?>')">
                                                                        <i class="icon-ban"></i> Sil </a>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>


                                            <?php endforeach;
                                        endif;
                                        ?>


                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                <h4 class="modal-title">Bu hizmet/ürün kaydını arşivlemek istediğinize
                                                    emin misiniz?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p> Arşivleme işleminin sonucunda:</p>
                                                <ul>
                                                    <li> Kayıt artık Hizmet ve Ürünler listelerinde görünmeyecek.
                                                    </li>
                                                    <li> Bu hizmet/ürün kaydını içeren faturalar etkilenmeyecek
                                                    </li>
                                                    <li> Eğer bu hizmet/ürün kaydı bir tekrarlama şablonunda
                                                        kullanılıyorsa,
                                                        şablon fatura haline geldiğinde hizmet/ürün kaydı arşivden
                                                        çıkarılacak.
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">
                                                    VAZGEÇ
                                                </button>
                                                <button onclick="arsiveal()" type="button" class="btn green">ARŞİVLE
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
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

            function ekleb() {
                location.replace('<?php SELF::go('nakit/banka_ekle'); ?>');
            }

            function eklek() {
                location.replace('<?php SELF::go('nakit/kasa_ekle'); ?>');
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

                $.post("<?php echo SITE; ?>/ajaxislemler/musterisayfalama", {sayfa: suankisayfa})
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

                    $.post("<?php echo SITE; ?>/ajaxislemler/musterisil", {id: id})
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


            function arsiveal() {
                uid = uid.trim();
                $('#basic').modal('toggle');
                $.post("<?php echo SITE; ?>/ajaxislemler/hizmeturunarsiv", {id: uid})
                    .done(function (data) {
                        var ff = data.trim();
                        if (ff == uid) {
                            $(".sil_" + uid).hide("slow");

                        } else {
                            alert("işlemin Sırasında sorun oluştu");
                        }
                    });

            }
        </script>