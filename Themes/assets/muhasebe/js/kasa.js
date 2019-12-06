
var ibannumber = [2,3,4,5,6];
var ekliler = [];
var d_a , e_a ,  g_a;



function ekleiban(deger=""){
    if(deger != ""){
        deger = "value='"+deger+"' ";

    }
    var id  = ibannumber.splice(0,1);

    if(id > 1){
        ekliler.push(id);
        ekliler.sort(function(a,b){return a - b});
        ibannumber.sort(function(a,b){return a - b});
        $("#ibanlar").val(ekliler);
        var ekle = '<p id="sil_'+id+'"><a style="float: left" class="btn btn-danger" onclick="siliban(\''+id+'\')"><i class="fa fa-trash"></i></a><input type="text" '+deger+' placeholder="IBAN NUMARASI" id="idiban_'+id+'" name="iban_'+id+'" class="form-control input-medium"><p>';
        $("#ibanekle").append(ekle);
    }
}
function bankaekle(){
    var bankayeni = $("#bankayeni").val();
    $.post( ANASAYFA+"/ajaxislemler/bankaekle", { name: bankayeni })
        .done(function( data ) {
            $('#modalbnk').modal('toggle');
            $("#bankalar").html(data);
            $("#bankayeni").val("");
        });
}

function dhty(a="") {
    $(".dhty").toggle();
    if(a=="b"){
        $("#butonlar").hide();
    }else{$("#butonlar").show();}
}
function pge(a="") {
    $(".pge").toggle();
    if(a=="b"){
        $("#butonlar").hide();
    }else{$("#butonlar").show();}
}
function pce(a="") {
    $(".pce").toggle();
    if(a=="b"){
        $("#butonlar").hide();
    }else{$("#butonlar").show();}
}
function siliban(id){
    ibannumber.push(id);
    $("#sil_"+id).remove();
    ekliler.sort(function(a,b){return a - b});
    ibannumber.sort(function(a,b){return a - b});
    ekliler = ekliler.filter(function(ele){ return ele != id;});
    $("#ibanlar").val(ekliler);
}


function il_ilce_secili(id,ilce,div){
    if(id){
        $.post( ANASAYFA+"/ajaxislemler/secili_ilce_getir", { il_id: id,ilce_id:ilce })
            .done(function( data ) {

                $("#"+div).html(data);
                $("#"+div+"_select").select2();
            });
    }
    else{
        $("#"+div).html("");
    }

}

function il_ilce(id,div){
    if(id){
        $.post( ANASAYFA+"/ajaxislemler/ilcegetir", { il_id: id })
            .done(function( data ) {

                $("#"+div).html(data);
                $("#"+div+"_select").select2();
            });
    }
    else{
        $("#"+div).html("");
    }

}
function katedoriekle(){
    var ktgname = $("#ktgyeni").val();
    $.post( ANASAYFA+"/ajaxislemler/kategoriekle", { name: ktgname })
        .done(function( data ) {
            $('#modalfk').modal('toggle');
            $("#frmktgr").html(data);
            $("#ktgyeni").val("");
        });
}

function bak(){
    if($('[name="adres_yd"]').is(':checked')){

        $(".il_ilce").hide();

    }
    else {$(".il_ilce").show();}
}

function xbak(tg){

    if(tg=="t"){
        $(".vd").show();
    }
    else if(tg=="g"){
        $(".vd").hide();
    }
}
function abak(){
    if($('[name="acilisbakiyesivarmi"]').is(':checked')){

        $(".abv").show();

    }
    else {$(".abv").hide();}
}

function pb(p){
    // para birimi

    if(p=='TL'){
        $("#kurbtn").html('<i class="fa fa-try"></i>');
        $("#fiyatkur").val('TL');
    }
    else if(p=='USD'){
        $("#kurbtn").html('<i class="fa fa-usd"></i>');
        $("#fiyatkur").val('USD');
    }
    else if(p=='EUR'){
        $("#kurbtn").html('<i class="fa fa-eur"></i>');
        $("#fiyatkur").val('EUR');
    }
    else if(p=='GBP'){
        $("#kurbtn").html('<i class="fa fa-gbp"></i>');
        $("#fiyatkur").val('GBP');
    }
}
var yetkilinumber = [1,2,3,4,5,6];
var yekliler = [];
function faceekleyetkili(){
    var id  = yetkilinumber.splice(0,1);

    if(id >= 1){
        yekliler.push(id);
        yekliler.sort(function(a,b){return a - b});
        yetkilinumber.sort(function(a,b){return a - b});
        $("#yekliler_adet").val(yekliler);

    }

}
function ekleyetkili(){

    var id  = yetkilinumber.splice(0,1);

    if(id >= 1){
        yekliler.push(id);
        yekliler.sort(function(a,b){return a - b});
        yetkilinumber.sort(function(a,b){return a - b});
        $("#yekliler_adet").val(yekliler);
        var ekle = '<div class="form-group y'+id+'"><div class="col-md-3">\n\
<input type="text" name="yad_'+id+'" placeholder="YETKİLİ KİŞİNİN ADI" class="form-control input-medium"></div>\n\
<div class="col-md-3"><input type="text" name="yposta_'+id+'"  placeholder="E-POSTA" class="form-control input-medium"></div>\n\
<div class="col-md-2"><input type="text" name="ytel_'+id+'"  placeholder="TELEFON" class="form-control input-small"></div>\n\
<div class="col-md-3"><input type="text" name="ynot_'+id+'"  placeholder="NOTLAR" class="form-control input-medium"></div>\n\
<div class="col-md-1"><a style="float: none" class="btn btn-danger" onclick="silyetkili(\''+id+'\')"><i class="fa fa-trash"></i></a></div>';
        $("#yekliler").append(ekle);
    }
}

function silyetkili(id){
    yetkilinumber.push(id);
    $(".y"+id).remove();
    yekliler.sort(function(a,b){return a - b});
    yetkilinumber.sort(function(a,b){return a - b});
    yekliler = yekliler.filter(function(ele){ return ele != id;});
    $("#yekliler_adet").val(yekliler);
}

// Jquery Dependency
$(window).load(function(){




    $("#t_meblag").on({
        keyup: function() {

            hesapla();
        }
    });


    $("input[data-type='currency']").on({
        keyup: function() {

            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });
});



function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(",") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(",");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "," + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ",00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function kurcek(){
    $.post( ANASAYFA+"/ajaxislemler/kurcek/kur/"+sayfakur)
        .done(function( data ) {
            var kur = JSON.parse(data);
            d_a = kur.dolar_alis;
            e_a = kur.euro_alis;
            g_a = kur.gbp_alis;
        });
}

var hkur = 1;
var yazacakyer  ;

var ydeger ;

var digerhesapid ;
function diger_hesap(id) {
    digerhesapid = id;
    if(sayfakur=="TL"){
        ydeger  = 1;
    }
    else if (sayfakur=="USD"){
        ydeger = d_a;
    }
    else if (sayfakur=="EUR"){
        ydeger = e_a;
    }
    else if (sayfakur=="GBP"){
        ydeger = g_a;
    }
    else return false;



    $.post( ANASAYFA+"/ajaxislemler/diger_hesap", { id: id })
        .done(function( data ) {


            if(data=="USD" && sayfakur != "USD"){

                var valdeger = valdegerhesap(sayfakur,data)  ;



                $(".th").hide();
                $(".gh").hide();
                $(".eh").hide();
                $(".dh").show();
                $("#dolar_kur").val(valdeger);
                hkur = valdeger;
                yazacakyer = $("#dolar_meblag");
                hesapla();


            }
            else if(data=="EUR" && sayfakur != "EUR"){
                var valdeger = valdegerhesap(sayfakur,data)  ;
                $(".th").hide();
                $(".gh").hide();
                $(".eh").show();
                $(".dh").hide();
                $("#eur_kur").val(valdeger);
                hkur = valdeger;
                yazacakyer = $("#eur_meblag");
                hesapla();
            }
            else if(data=="GBP" && sayfakur != "GBP"){
                var valdeger = valdegerhesap(sayfakur,data)  ;
                $(".th").hide();
                $(".gh").show();
                $(".eh").hide();
                $(".dh").hide();
                $("#gbp_kur").val(valdeger);
                hkur = valdeger;
                yazacakyer = $("#gbp_meblag");
                hesapla();
            }

            else if(data=="TL" && sayfakur != "TL"){
                var valdeger = valdegerhesap(sayfakur,data)  ;
                $(".th").show();
                $(".gh").hide();
                $(".eh").hide();
                $(".dh").hide();
                $("#tl_kur").val(valdeger);
                hkur = valdeger;
                yazacakyer = $("#tl_meblag");
                hesapla();
            }
            else {
                yazacakyer = "";
                $(".th").hide();
                $(".gh").hide();
                $(".eh").hide();
                $(".dh").hide();

            }

        });



}
var cikiskur , giriskur;
function valdegerhesap(thy,troh){
    cikiskur = thy;
    giriskur = troh;


    if(thy=="USD" && troh=="TL"){  return  d_a ;}
    if(thy=="USD" && troh=="EUR"){var t = d_a / e_a; return  parseFloat(t).toFixed(4);}
    if(thy=="USD" && troh=="GBP"){var t = d_a / g_a; return  parseFloat(t).toFixed(4);}
    if(thy=="EUR" && troh=="TL"){  return  e_a;}
    if(thy=="EUR" && troh=="USD"){var t = e_a / d_a; return  parseFloat(t).toFixed(4);}
    if(thy=="EUR" && troh=="GBP"){var t = e_a / g_a; return  parseFloat(t).toFixed(4);}
    if(thy=="GBP" && troh=="TL"){  return  g_a;}
    if(thy=="GBP" && troh=="USD"){var t = g_a / d_a; return  parseFloat(t).toFixed(4);}
    if(thy=="GBP" && troh=="EUR"){var t = g_a / e_a; return  parseFloat(t).toFixed(4);}

    if(thy=="TL" && troh=="GBP"){  var t =   1 / g_a; return parseFloat(t).toFixed(4);}
    if(thy=="TL" && troh=="USD"){   var t = 1 / d_a; return parseFloat(t).toFixed(4);}
    if(thy=="TL" && troh=="EUR"){  var t =   1 / e_a; return parseFloat(t).toFixed(4);}

}



$( document ).ready(function() {
    $("#gbp_kur").on({
        keyup: function() {
            var x = $("#gbp_kur").val();
            hesapla(x);
        }
    });
    $("#eur_kur").on({
        keyup: function() {

            var x = $("#eur_kur").val();
            hesapla(x);
        }
    });


    $("#dolar_kur").on({
        keyup: function() {

            var x = $("#dolar_kur").val();
            hesapla(x);
        }
    });
    $("#tl_kur").on({
        keyup: function() {

            var x = $("#tl_kur").val();
            hesapla(x);
        }
    });

});






    var mebla;

    function hesapla(x=0) {
            if(yazacakyer) {

                mebla = $("#t_meblag").val();

                mebla = mebla.replace(/\./g, '');
                mebla = mebla.replace(',', '.');


                if(x==0) mebla = (mebla * hkur);
                else mebla = (mebla * x);
                mebla = parseFloat(mebla).toFixed(2);
                mebla = mebla.replace('.', ',');
                yazacakyer.val(mebla);
                formatCurrency(yazacakyer, "blur");
            }
        }

    function dghsbtryap(){
        var cikanmiktar  = $("#t_meblag").val();
        var cikis_b_k =  $("#cikan_kasa_id").val();
        var aciklama = $("#trfaciklama").val();
        var transfer_trh = $("#transfer_trh").val();

        if(yazacakyer){
            var g_miktar = yazacakyer.val();
        }
        else{
            var g_miktar = cikanmiktar;
        }


        $.post( ANASAYFA+"/nakit/transefer",{cikis_b_k : cikis_b_k,giris_b_k : digerhesapid, cikan_miktar : cikanmiktar,cikis_doviz : cikiskur ,giris_miktar : g_miktar, giris_doviz : giriskur, transfer_trh : transfer_trh,aciklama :aciklama })
            .done(function( data ) {
location.replace(ANASAYFA +"/nakit/bk_detay/id/"+cikis_b_k);


            });



    }
    function paragirisiekle(){
        var cikis_b_k =  $("#cikan_kasa_id").val();
        var giris_miktar = $("[name='pge_meblag']").val();
        var aciklama = $("[name='pge_aciklama']").val();
        var pge_tarih = $("[name='pge_tarih']").val();


        $.post( ANASAYFA+"/nakit/paragirisi",{b_k_id : cikis_b_k,giris_miktar : giris_miktar,aciklama :aciklama ,transfer_trh : pge_tarih,giris_doviz : sayfakur})
            .done(function( data ) {
               location.replace(ANASAYFA +"/nakit/bk_detay/id/"+cikis_b_k);


            });

    }

    function paracikisiekle(){
        var cikis_b_k =  $("#cikan_kasa_id").val();
        var miktar = $("[name='pce_meblag']").val();
        var aciklama = $("[name='pce_aciklama']").val();
        var tarih = $("[name='pce_tarih']").val();


        $.post( ANASAYFA+"/nakit/paracikisi",{b_k_id : cikis_b_k, miktar : miktar,aciklama :aciklama ,tarih : tarih, doviz : sayfakur})
            .done(function( data ) {
                 location.replace(ANASAYFA +"/nakit/bk_detay/id/"+cikis_b_k);


            });

    }

    function arsiveal(id) {

        $.post( ANASAYFA+"/nakit/arsiveal",{id : id})
            .done(function( data ) {
                if(data==id){
                    alert("BANKA/KASA ARŞİV İŞLEMİ BAŞARILI.");
                    location.replace(ANASAYFA +"/nakit/kasa_banka");
                }
                else{
                    alert("BANKA/KASA ARŞİV İŞLEMİ BAŞARISIZ. ! ");
                }

            });

    }


function BakiyeSabitle(id) {
    var aciklama = $("#bakiye_sabitle_aciklama").val();
    var tarih =  $("#bakiye_sabitle_tarih").val();
    var mebla = $("#bakiye_sabitle_meblag").val();
    $.post( ANASAYFA+"/nakit/bakiyesabitle",{id : id,aciklama : aciklama, tarih:tarih,bakiye:mebla, doviz : sayfakur}).done(function( data ) {
        if(1 <= data){
            alert("BANKA/KASA BAKİYE SABİTLEME İŞLEMİ BAŞARILI.");
            location.replace(ANASAYFA +"/nakit/kasa_banka");
        }
        else{
            alert("İŞLEM BAŞARISIZ ! ");
        }

    });

}
function sil(id) {

    $.post( ANASAYFA+"/nakit/bksil",{id : id}).done(function( data ) {
        if(data == id){
            alert("BANKA/KASA SİLME İŞLEMİ BAŞARILI.");
            location.replace(ANASAYFA +"/nakit/kasa_banka");
        }
        else{
            alert("İŞLEM BAŞARISIZ ! ");
        }

    });

}


