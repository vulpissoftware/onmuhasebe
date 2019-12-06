$('input[name=odeme_durum]').on('change', function() {
    var id=$('input[name=odeme_durum]:checked').val();
    if(id == 1){
        $('#odenecek').css({"display": "none"});
        $('#odendi').css({"display": "block"});
    }
    else{
        $('#odenecek').css({"display": "block"});
        $('#odendi').css({"display": "none"});
    }
});
$('#yenimaas_form').on('submit', function (e) {
    var miktar = $('input[name=miktar]').val();
    if(miktar == " " || miktar == "" || miktar == "0" || miktar == "0,00"){
        $('#hata').css({"display": "block"});
        $('#hata_ic').html("'TOPLAM TUTAR' hatalı lütfen düzeltiniz.");
        return false;
    }
    else{
        return true;
    }
});
    
// Jquery Dependency
$(window).load(function(){
    
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
    } else {
        alert("Silme işleminden vazgeçtiniz");
    }
}
function pb(p){
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
function ac(){
    $('.odeme').show();
    $('.btnnn').hide();
}
function kb(){
    $('.odeme').hide();
    $('.btnnn').show();
}