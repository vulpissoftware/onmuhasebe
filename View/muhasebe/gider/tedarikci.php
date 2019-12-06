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
                        / <a href="<?php SELF::go("tedarikci/tedarikci_listesi"); ?>"><span class="caption-helper">TEDARİKÇİ LİSTESİ</span></a>
                        / <span class="caption-helper">TEDARİKÇİ KAYDET</span>
                    </div>


                        <div class="portlet light bg-inverse form-fit">

                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?php SELF::go("tedarikci/tedarikci_ekle"); ?>" method="post"
                                      class="form-horizontal form-row-seperated">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">FİRMA UNVANI</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="FİRMA UNVANI" name="unvan"
                                                       class="form-control" required>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">KISA İSİM</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="KISA İSİM" name="kisa_ad"
                                                       class="form-control input-medium">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">KATEGORİ</label>
                                            <div class="col-md-9">
                                                <select class="form-control input-medium" id="frmktgr"
                                                        name="firma_kategori_id">
                                                    <option value="0">Kategorisiz</option>
                                                    <?php foreach ($cls->musterikategori() as $value) { ?>
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
                                                        <h4 class="modal-title">Firma Kategori Ekleme</h4>
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
                                                        <button type="button" onclick="katedoriekle();"
                                                                class="btn green">Kaydet
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">FİYAT LİSTESİ</label>
                                            <div class="col-md-6">
                                                <select class="form-control select2me" name="fl_id">
                                                    <option value="0">Hiçbiri</option>
                                                    <?php foreach ($cls->fl_id_ad() as $fl_id_ad) { ?>
                                                        <option value="<?php echo $fl_id_ad->id; ?>"><?php echo $fl_id_ad->ad; ?></option>
                                                    <?php } ?>

                                                </select>

                                            </div>

                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">E-POSTA ADRESİ</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="E-POSTA ADRESİ" class="form-control"
                                                       name="eposta">

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">TELEFON NUMARASI</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="TELEFON NUMARASI" class="form-control"
                                                       name="telefon">

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">FAKS NUMARASI</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="FAKS NUMARASI" class="form-control"
                                                       name="fax">

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">IBAN NUMARASI</label>
                                            <div class="col-md-9">
                                                <input type="hidden" placeholder="medium" value="" name="ibanlar"
                                                       id="ibanlar">
                                                <a style="float: left" class="btn btn-success"><i
                                                            class="fa fa-credit-card"></i></a>
                                                <input type="text" placeholder="IBAN NUMARASI" name="iban_1"
                                                       class="form-control input-medium">
                                                <span>  <hr> </span>
                                                <span id="ibanekle">   </span>
                                                <span class="btn badge-info" onclick="ekleiban()"><i
                                                            class="fa fa-plus"></i> YENİ IBAN EKLE</span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">AÇIK ADRESİ</label>
                                            <div class="col-md-9">
                                                <textarea name="adres"></textarea>
                                                <span class="help-block"><label
                                                            class="container">Adres Yurt dışında <input name="adres_yd"
                                                                                                        value="2"
                                                                                                        onchange="bak()"
                                                                                                        type="checkbox">
                                                                <span class="checkmark"></span>
                                                              </label> </span>
                                            </div>
                                        </div>


                                        <div class="form-group il_ilce">
                                            <label class="control-label col-md-3">İL / İLÇE </label>
                                            <div class="col-md-6">
                                                <label class="control-label col-md-1">İL </label>
                                                <div class="col-md-5">
                                                    <select class="form-control select2me"
                                                            onchange="il_ilce(this.value,'ilce')" name="il">
                                                        <option value="">İl Seçiniz...</option>
                                                        <?php foreach ($cls->illler() as $value) { ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->il_adi; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label class="control-label col-md-1">İLÇE </label>
                                                <div class="col-md-5" id="ilce" name="ilce">
                                                    <select class="form-control select2me" name="ilce">
                                                        <option value="">İl Seçiniz...</option>

                                                    </select>
                                                </div>


                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">TÜRÜ</label>
                                            <div class="col-md-9">
                                                                
                                                                 <span class="help-block"><label class="container">Tüzel Kişi <input
                                                                                 name="turu" value="TK"
                                                                                 onchange="xbak('t')" type="radio"
                                                                                 checked="checked">
                                                                <span class="checkmark"></span>
                                                              </label>  <label class="container">Gerçek Kişi <input
                                                                                 name="turu" onchange="xbak('g')"
                                                                                 value="GK" type="radio">
                                                                <span class="checkmark"></span>
                                                              </label> </span>
                                                <span class="help-block"> Şahıs şirketleri dahil LTD, AŞ, vb. tüm şirketler Tüzel Kişi kapsamındadır.</span>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">VKN / TCKN</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="VKN / TCKN"
                                                       class="form-control input-medium" name="vkn_tckn">
                                                <span class="help-block"> Gerçek Kişi ise TC numarası yazınız </span>
                                            </div>
                                        </div>


                                        <div class="form-group vd">
                                            <label class="control-label col-md-3">VERGİ DAİRESİ</label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="VERGİ DAİRESİ"
                                                       class="form-control  input-medium" name="vergi_dairesi">

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">DÖVİZ KURU</label>
                                            <div class="col-md-9">
                                                <span class="text"> Alış. </span> <input type="radio" name="doviz_a_s" value="a" class="icheck" checked />
                                                <span class="text-left"> Satış. </span><input type="radio" name="doviz_a_s" value="s" class="icheck" />
                                                <span class="help-block"> <i class="fa fa-info-circle"></i>Bakiye hesaplanırken kullanılır. </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="control-label col-md-3">AÇILIŞ BAKİYESİ</label>
                                                <div class="col-md-6">     <span class="help-block"><label
                                                                class="container">Açılış bakiyesi var <input
                                                                    name="acilisbakiyesivarmi" value="1"
                                                                    onchange="abak()" type="checkbox">
                                                                <span class="checkmark"></span>
                                                              </label> </span></div>
                                                <div class="col-md-3"></div>
                                            </div>
                                            <div class="col-md-12 abv" style="display: none">
                                                <label class="control-label col-md-2">Firmanın </label>
                                                <div class="col-md-3">
                                                    <div class="input-group date date-picker"
                                                         data-date-format="dd-mm-yyyy">
                                                        <input type="text" value="<?php echo date('d-m-Y') ?>"
                                                               class="form-control input-small" readonly
                                                               name="acilis_bakiyesi_tarih">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                itibariyle 
                                                            </button>
                                                        </span>
                                                    </div>

                                                </div>

                                                <div class="col-md-3">
                                                    <div class="input-group input-medium">
                                                        <input type="text" data-type='currency' name="acilis_bakiyesi"
                                                               value="" class="form-control" placeholder="1.000">
                                                        <input type="hidden" id="fiyatkur" name="acilis_bakiyesi_kur"
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

                                                <div class="col-md-3">
                                                    <select class="form-control" name="acilis_bakiyesi_durum">
                                                        <option value="Borcu Var">Borcu Var</option>
                                                        <option value="Alacağı var">Alacağı var</option>
                                                        <option value="Verilmiş Avans Var">Verilmiş Avans Var</option>
                                                        <option value="Alınmış Avans Var">Alınmış Avans Var</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                        <div id="yekliler">
                                            <input type="hidden" name="yetkililer_adet" id="yekliler_adet">


                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-3">
                                            <span class="btn badge-info" onclick="ekleyetkili()"><i
                                                        class="fa fa-user-plus"></i> BİR YETKİLİ EKLE</span>
                                        </div>

                                        <div class="col-md-6">
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


                                    location.replace('<?php SELF::go('tedarikci/tedarikci_listesi'); ?>');
                                    return false;
                                }

                            </script>
                        </div>


                </div>
            </div>
        </div>
    </div>

</div>
                