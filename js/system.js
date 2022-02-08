/*=========================================================================================
    File Name: app-chat.js
    Description: Chat app js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';
$(function() {

    // add takecare history
    if ($("#formInfoCompany").length) {
        $("#formInfoCompany").validate({
            errorClass: "error",
          
        });

        $("#formInfoCompany").on("submit", function(e) {
           
            e.preventDefault();
            var isValid = $("#formInfoCompany").valid();
            if (isValid) {
                var formData = new FormData($('#formInfoCompany')[0]); 
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data:formData,
                    url: baseHome + "/system/update",
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success == true) {
                            notyfi_success(data.msg);
                        } else {
                            notify_error(data.msg);
                            return false;
                        }
                    },
                });
             
            
            }
        });
    }

    // init ps if it is not touch device
   
});


