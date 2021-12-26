/*=========================================================================================
    File Name: documentation.js
    Description: Theme documentation js file
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


//format_number so_tien
$('.format_number').on('input', function(e){        
  $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g,'')));
}).on('keypress',function(e){
  if(!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
}).on('paste', function(e){    
  var cb = e.originalEvent.clipboardData || window.clipboardData;      
  if(!$.isNumeric(cb.getData('text'))) e.preventDefault();
});
function formatCurrency(number){
  var n = number.split('').reverse().join("");
  var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");    
  return  n2.split('').reverse().join('');
}


var datePicker = $(".ngay_gio");
    // datepicker init
    if (datePicker.length) {
      datePicker.flatpickr({
      });
  }
