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
                <div class="portlet-title">
                    <?php echo $musteri->adi; ?>
                </div>
            </div>
        </div>

    </div>
<script>
    var ANASAYFA = '<?php echo SITE; ?>';
</script>
</div>