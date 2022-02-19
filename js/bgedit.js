/*=========================================================================================
    File Name: app-invoice.js
    Description: app-invoice Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(function () {
    "use strict";
    var applyChangesBtn = $(".btn-apply-changes"),
        sourceItem = $(".source-item"),
        date = new Date(),
        datepicker = $(".date-picker"),
        dueDate = $(".due-date-picker"),
        select2 = $(".invoiceto"),
        btnAddNewItem = $(".btn-add-new "),
        newCusForm = $("#newCus")

    select2.select2({
        placeholder: "Chọn khách hàng",
        ajax: {
            url: 'baogia/khachhang',
            dataType: 'json',
            data: function (params) {
                var queryParameters = {
                  search: params.term
                }
                return queryParameters;
            }
        }
    });

    // Close select2 on modal open
    $(document).on("click", ".add-new-customer", function () {
        select2.select2("close");
    });

    // Select2
    if (select2.length) {
        select2.on("change", function () {
            select2.select2("close");
        });
        select2.on("select2:open", function () {
            if (!$(document).find(".add-new-customer").length) {
                $(document)
                    .find(".select2-results__options")
                    .before(
                        '<div class="add-new-customer btn btn-flat-success cursor-pointer rounded-0 text-left mb-50 p-50 w-100" data-toggle="modal" data-target="#add-new-customer-sidebar">' +
                            feather.icons["plus"].toSvg({ class: "font-medium-1 mr-50" }) +
                            '<span class="align-middle">Thêm khách hàng mới</span></div>'
                    );
            }
        });
    }

    // Repeater init
    if (sourceItem.length) {
        sourceItem.on("submit", function (e) {
            e.preventDefault();
        });
        sourceItem.repeater({
            defaultValues: {
                // "text-input": "foo"
            },
            show: function () {
                $(this).slideDown();
            },
            hide: function (e) {
                var id = $(this).closest("[data-repeater-item]").index();
                $(this).slideUp(e);
                var invoiceTotal = 0;
                var items = sourceItem.repeaterVal();
                items['group-a'].forEach(function(item,index){
                    if(index!=id)
                        invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
                });
                $('#invoiceTotal').text(Comma(invoiceTotal));
                $('#totalAmount').text(Comma(invoiceTotal));
            },
        });
        var id = $('#quoteNum').val();
        $.post("baogia/getSubQuotation", {id:id},
            function (result, status) {
                console.log(result);
                sourceItem.setList(result);
        },"json");
    }

    // Item details select onchange
    $(document).on("change", ".item-details", function () {
        var $this = $(this);
        var id= $this.val();
        $this.closest(".repeater-wrapper").find(".productName").val($this.find('option:selected').text());
        $.post("baogia/getProductDetail", {id:id},
            function (data, status) {
                if (data.success) {
                    $this.closest(".repeater-wrapper").find(".qty").val(1);
                    $this.closest(".repeater-wrapper").find(".discount").val(0);
                    $this.closest(".repeater-wrapper").find(".chietkhau").val(0);
                    $this.closest(".repeater-wrapper").find(".price").val(Comma(data.row['price']));
                    $this.closest(".repeater-wrapper").find(".unit").val(data.row['unit']);
                    $this.closest(".repeater-wrapper").find(".vat").val(0);
                    $this.closest(".repeater-wrapper").find(".thanhtien").val(Comma(data.row['price']));
                    $this.next("textarea").val(data.row['description']);
                    var invoiceTotal = 0;
                    var taxTotal = 0;
                    var items = sourceItem.repeaterVal();
                    items['group-a'].forEach(function(item){
                        invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
                        taxTotal += parseFloat(item.thanhtien.replace(/,/g, ''))*item.vat/100;
                    });
                    $('#invoiceTotal').text(Comma(invoiceTotal));
                    $('#taxTotal').text(Comma(taxTotal));
                    $('#totalAmount').text(Comma(invoiceTotal+taxTotal));
                } else {
                    toastr["error"](data.msg, "💾 Task Action!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                }
        },"json");
    });

    if (btnAddNewItem.length) {
        btnAddNewItem.on("click", function () {
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        });
    }

    $(document).on("change", ".price", function () {
        var price = parseFloat(this.value.replace(/[A-Za-z,!@#$%^&*()]/g, ''));
        if (!price) price=0;
        this.value = Comma(price);
        var qty = $(this).closest('.row').find('.qty').val();
        var temp = $(this).closest('.row').find(".discount").val();
        var discount = parseFloat(temp.replace(/,/g, ''));
        var chietkhau = $(this).closest('.row').find(".chietkhau").val();
        $(this).closest('.row').find(".thanhtien").val(Comma((price-discount)*(1-chietkhau/100)*qty));
        var invoiceTotal = 0;
        var taxTotal = 0;
        var items = sourceItem.repeaterVal();
        items['group-a'].forEach(function(item){
            invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
            taxTotal += parseFloat(item.thanhtien.replace(/,/g, ''))*item.vat/100;
        });
        $('#invoiceTotal').text(Comma(invoiceTotal));
        $('#taxTotal').text(Comma(taxTotal));
        $('#totalAmount').text(Comma(invoiceTotal+taxTotal));
    });

    $(document).on("change", ".qty", function () {
        var temp  = $(this).closest('.row').find('.price').val();
        var price = parseFloat(temp.replace(/,/g, ''));
        var qty = parseFloat(this.value.replace(/[A-Za-z,!@#$%^&*()]/g, ''));
        if (!qty) qty=0;
        this.value = qty
        var temp = $(this).closest('.row').find(".discount").val();
        var discount = parseFloat(temp.replace(/,/g, ''));
        var chietkhau = $(this).closest('.row').find(".chietkhau").val();
        $(this).closest('.row').find(".thanhtien").val(Comma((price-discount)*(1-chietkhau/100)*qty));
        var invoiceTotal = 0;
        var taxTotal = 0;
        var items = sourceItem.repeaterVal();
        items['group-a'].forEach(function(item){
            invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
            taxTotal += parseFloat(item.thanhtien.replace(/,/g, ''))*item.vat/100;
        });
        $('#invoiceTotal').text(Comma(invoiceTotal));
        $('#taxTotal').text(Comma(taxTotal));
        $('#totalAmount').text(Comma(invoiceTotal+taxTotal));
    });

    $(document).on("change", ".discount", function () {
        var temp  = $(this).closest('.row').find('.price').val();
        var price = parseFloat(temp.replace(/,/g, ''));
        var qty = $(this).closest('.row').find('.qty').val();
        var discount = parseFloat(this.value.replace(/[A-Za-z,!@#$%^&*()]/g, ''));
        if (!discount) discount=0;
        this.value = Comma(discount);
        var chietkhau = $(this).closest('.row').find(".chietkhau").val();
        $(this).closest('.row').find(".thanhtien").val(Comma((price-discount)*(1-chietkhau/100)*qty));
        var invoiceTotal = 0;
        var taxTotal = 0;
        var items = sourceItem.repeaterVal();
        items['group-a'].forEach(function(item){
            invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
            taxTotal += parseFloat(item.thanhtien.replace(/,/g, ''))*item.vat/100;
        });
        $('#invoiceTotal').text(Comma(invoiceTotal));
        $('#taxTotal').text(Comma(taxTotal));
        $('#totalAmount').text(Comma(invoiceTotal+taxTotal));
    });

    $(document).on("change", ".chietkhau", function () {
        var temp  = $(this).closest('.row').find('.price').val();
        var price = parseFloat(temp.replace(/,/g, ''));
        var qty = $(this).closest('.row').find('.qty').val();
        var temp = $(this).closest('.row').find('.discount').val();
        var discount = parseFloat(temp.replace(/,/g, ''));
        var chietkhau = parseFloat(this.value.replace(/[A-Za-z,!@#$%^&*()]/g, ''));
        if (!chietkhau) chietkhau=0;
        this.value = chietkhau;
        $(this).closest('.row').find(".thanhtien").val(Comma((price-discount)*(1-chietkhau/100)*qty));
        var invoiceTotal = 0;
        var taxTotal = 0;
        var items = sourceItem.repeaterVal();
        items['group-a'].forEach(function(item){
            invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
            taxTotal += parseFloat(item.thanhtien.replace(/,/g, ''))*item.vat/100;
        });
        $('#invoiceTotal').text(Comma(invoiceTotal));
        $('#taxTotal').text(Comma(taxTotal));
        $('#totalAmount').text(Comma(invoiceTotal+taxTotal));
    });

    $(document).on("change", ".vat", function () {
        var vat = parseFloat(this.value.replace(/[A-Za-z,!@#$%^&*()]/g, ''));
        if (!vat) vat=0;
        this.value = vat;
        var invoiceTotal = 0;
        var taxTotal = 0;
        var items = sourceItem.repeaterVal();
        items['group-a'].forEach(function(item){
            invoiceTotal += parseFloat(item.thanhtien.replace(/,/g, ''));
            taxTotal += parseFloat(item.thanhtien.replace(/,/g, ''))*item.vat/100;
        });
        $('#invoiceTotal').text(Comma(invoiceTotal));
        $('#taxTotal').text(Comma(taxTotal));
        $('#totalAmount').text(Comma(invoiceTotal+taxTotal));
    });

    newCusForm.on("submit", function(e) { // thêm khách hàng
        e.preventDefault();
        var isValid = newCusForm.valid();
        if (isValid) {
            var cusName = $("#customer-name").val();
            var cusAdd= $("#customer-address").val();
            var city = $("#customer-country").val();
            var cusContact = $("#customerContact").val();
            var cusPhone = $("#customerPhone").val();
            var cusEmail = $("#customer-email").val();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {cusName:cusName, cusAdd:cusAdd, city:city, cusContact:cusContact, cusPhone:cusPhone, cusEmail:cusEmail},
                async: false,
                url: "baogia/newCustomer",
                success: function(result) {
                    if (result.success == true) {
                        $('#add-new-customer-sidebar').modal("hide");
                        // $(".invoiceto").select2("destroy");
                        // $(".invoiceto").select2({
                        //     data: result.data,
                        // });
                        // // $("#history").load(window.location.href + "?id=" + id + " #history");
                    } else {
                        notify_error(result.msg);
                        return false;
                    }
                },
            });
        }
    });

    $(document).on("click", "#btnSave", function () {  // ghi nháp
        var items = sourceItem.repeaterVal();
        var customer = select2.val();
        var date = $('#date').val();
        var validdate = $('#validDate').val();
        var note = $('#note').val();
        var total = $('#invoiceTotal').text()
        var tax = $('#taxTotal').text();
        var id = $('#quoteNum').val();
        console.log(items);
        if(customer>0) {
            if (items['group-a'][0]['product']!='') {
                $.post("baogia/save", {id:id,customer:customer,items:items['group-a'],date:date,validdate:validdate,note:note,total:total,tax:tax},
                    function (data, status) {
                        if (data.success) {
                            $('#quoteNum').val(data.id);
                            toastr["success"](data.msg, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                        } else {
                            toastr["error"](data.msg, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                        }
                },"json");
            } else {
                toastr["error"]('Bạn chưa chọn sản phẩm!', "💾 Task Action!", {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl,
                });
            }
        } else {
            toastr["error"]('Bạn chưa chọn khách hàng!', "💾 Task Action!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl,
            });
        }
    });

    $(document).on("click", "#btnNew", function () {
        // $('#quoteNum').val('');
        // sourceItem.setList([{}]);
        // select2.val(8).trigger('change');
        // $('#invoiceTotal').text(0);
        // $('#totalAmount').text(0);
        window.location = 'baogia/add';
    });

    $(document).on("change", "#selectEmail", function () {
        if($("#selectEmail").val()>0) {
            var email = $( "#selectEmail option:selected" ).text();
            var curValue = $('#emails').val();
            var newValue = '';
            if (curValue=='')
               newValue = email;
            else
               newValue = curValue + ';' + email;
            $('#emails').val(newValue);
        }
    });

    $(document).on("click", "#btnSend", function () { //Ghi và send email
        var items = sourceItem.repeaterVal();
        var customer = select2.val();
        var date = $('#date').val();
        var validdate = $('#validDate').val();
        var note = $('#note').val();
        var total = $('#invoiceTotal').text()
        var tax = $('#taxTotal').text();
        var id = $('#quoteNum').val();
        // console.log(items);
        if(customer>0) {
            if (items['group-a'][0]['product']!='') {
                $.post("baogia/save", {id:id,customer:customer,items:items['group-a'],date:date,validdate:validdate,note:note,total:total,tax:tax},
                    function (data, status) {
                        if (data.success) {
                            $('#quoteId').val(data.id);
                            $('#emailList').modal('show');
                            $('#selectEmail').empty();
                            $('#selectEmail').append($('<option>', {value:0, text:'Chọn email'}));
                            $.post("baogia/getEmails", {id:data.id},
                                function (result, status) {
                                    result.forEach(function(item){
                                        $('#selectEmail').append($('<option>', {value:item.id, text:item.email}));
                                    });
                            },"json");
                        } else {
                            toastr["error"](data.msg, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                        }
                },"json");
            } else {
                toastr["error"]('Bạn chưa chọn sản phẩm!', "💾 Task Action!", {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl,
                });
            }
        } else {
            toastr["error"]('Bạn chưa chọn khách hàng!', "💾 Task Action!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl,
            });
        }
    });

    $(document).on("click", "#sendMail", function () { //Gửi email
        var quoteId = $('#quoteId').val();
        var emailList = $('#emails').val();
        $.post("baogia/send", {id:quoteId,emailList:emailList},
            function (result, status) {
                if (result.success == true) {
                    $('#quoteNum').val('');
                    sourceItem.setList([{}]);
                    select2.val(0).trigger('change');
                    $('#invoiceTotal').text(0);
                    $('#totalAmount').text(0);
                    toastr["success"](result.msg, "💾 Task Action!", {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl,
                    });
                    $('#emailList').modal('hide');
                } else {
                    notify_error(result.msg);
                    return false;
                }
        },"json");
    });

    $(document).on("click", "#btnPrint", function () { // Ghi và in ra
        var items = sourceItem.repeaterVal();
        var customer = select2.val();
        var date = $('#date').val();
        var validdate = $('#validDate').val();
        var note = $('#note').val();
        var total = $('#invoiceTotal').text()
        var tax = $('#taxTotal').text();
        var id = $('#quoteNum').val();
        if(customer) {
            if (items['group-a'][0]['product']!='') {
                $.post("baogia/save", {id:id,customer:customer,items:items['group-a'],date:date,validdate:validdate,note:note,total:total,tax:tax},
                    function (data, status) {
                        if (data.success) {
                            window.location = 'baogia/printQuote?id='+data.id;
                            // var data = select2.select2('data')
                            // $('#cusPrint').val(data[0].text);
                            // $('#notePrint').val($('#note').val());
                            // $('#itemsPrint').val(JSON.stringify(items['group-a']));
                            // $('#fmPrint').submit();
                        } else {
                            toastr["error"](data.msg, "💾 Task Action!", {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl,
                            });
                        }
                },"json");
            } else {
                toastr["error"]('Bạn chưa chọn sản phẩm!', "💾 Task Action!", {
                closeButton: true,
                tapToDismiss: false,
                rtl: isRtl,
                });
            }
        } else {
            toastr["error"]('Bạn chưa chọn khách hàng!', "💾 Task Action!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl,
            });
        }
    });

});
