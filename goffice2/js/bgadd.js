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
        discount,
        tax1,
        tax2,
        discountInput,
        tax1Input,
        tax2Input,
        sourceItem = $(".source-item"),
        date = new Date(),
        datepicker = $(".date-picker"),
        dueDate = $(".due-date-picker"),
        select2 = $(".invoiceto"),
        countrySelect = $("#customer-country"),
        btnAddNewItem = $(".btn-add-new "),
        newCusForm = $("#newCus"),
        adminDetails = {
            "App Design": "Designed UI kit & app pages.",
            "App Customization": "Customization & Bug Fixes.",
            "ABC Template": "Bootstrap 4 admin template.",
            "App Development": "Native App Development.",
        },
        customerDetails = {
            shelby: {
                name: "Thomas Shelby",
                company: "Shelby Company Limited",
                address: "Small Heath, Birmingham",
                pincode: "B10 0HF",
                country: "UK",
                tel: "Tel: 718-986-6062",
                email: "peakyFBlinders@gmail.com",
            },
            hunters: {
                name: "Dean Winchester",
                company: "Hunters Corp",
                address: "951  Red Hawk Road Minnesota,",
                pincode: "56222",
                country: "USA",
                tel: "Tel: 763-242-9206",
                email: "waywardSon@gmail.com",
            },
        };

    // init date picker
    if (datepicker.length) {
        datepicker.each(function () {
            $(this).flatpickr({
                defaultDate: date,
            });
        });
    }

    if (dueDate.length) {
        dueDate.flatpickr({
            defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate() + 30),
        });
    }

    // Country Select2
    // if (countrySelect.length) {
    //     countrySelect.select2({
    //         placeholder: "Select country",
    //         dropdownParent: countrySelect.parent(),
    //     });
    // }

    select2.select2({
        placeholder: "Chọn khách hàng",
        // dropdownParent: $(".invoice-customer"),
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
        // select2.select2({
        //     placeholder: "Chọn khách hàng",
        //     dropdownParent: $(".invoice-customer"),
        // });
        select2.on("change", function () {
            select2.select2("close");
            // var $this = $(this),
            //     renderDetails =
            //         '<div class="customer-details mt-1">' +
            //         '<p class="mb-25">' +
            //         customerDetails[$this.val()].name +
            //         "</p>" +
            //         '<p class="mb-25">' +
            //         customerDetails[$this.val()].company +
            //         "</p>" +
            //         '<p class="mb-25">' +
            //         customerDetails[$this.val()].address +
            //         "</p>" +
            //         '<p class="mb-25">' +
            //         customerDetails[$this.val()].country +
            //         "</p>" +
            //         '<p class="mb-0">' +
            //         customerDetails[$this.val()].tel +
            //         "</p>" +
            //         '<p class="mb-0">' +
            //         customerDetails[$this.val()].email +
            //         "</p>" +
            //         "</div>";
            // $(".row-bill-to").find(".customer-details").remove();
            // $(".row-bill-to").find(".col-bill-to").append(renderDetails);
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
                //"text-input": "foo"
            },
            show: function () {
                $(this).find(".qty").val(1);
                $(this).find(".discount").val(0);
                $(this).find(".vat").val(0);
                $(this).find(".chietkhau").val(0);
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
    }

    // Prevent dropdown from closing on tax change
    // $(document).on("click", ".tax-select", function (e) {
    //     e.stopPropagation();
    // });

    // On tax change update it's value value
    // function updateValue(listener, el) {
    //     listener.closest(".repeater-wrapper").find(el).text(listener.val());
    // }

    // Apply item changes btn
    // if (applyChangesBtn.length) {
    //     $(document).on("click", ".btn-apply-changes", function (e) {
    //         var $this = $(this);
    //         tax1Input = $this.closest(".dropdown-menu").find("#tax-1-input");
    //         tax2Input = $this.closest(".dropdown-menu").find("#tax-2-input");
    //         discountInput = $this.closest(".dropdown-menu").find("#discount-input");
    //         tax1 = $this.closest(".repeater-wrapper").find(".tax-1");
    //         tax2 = $this.closest(".repeater-wrapper").find(".tax-2");
    //         discount = $(".discount");
    //
    //         if (tax1Input.val() !== null) {
    //             updateValue(tax1Input, tax1);
    //         }
    //
    //         if (tax2Input.val() !== null) {
    //             updateValue(tax2Input, tax2);
    //         }
    //
    //         if (discountInput.val().length) {
    //             var finalValue = discountInput.val() <= 100 ? discountInput.val() : 100;
    //             $this
    //                 .closest(".repeater-wrapper")
    //                 .find(discount)
    //                 .text(finalValue + "%");
    //         }
    //     });
    // }

    // Item details select onchange
    $(document).on("change", ".item-details", function () {
        var $this = $(this);
            // value = adminDetails[$this.val()];
        var id= $this.val();
        $this.closest(".repeater-wrapper").find(".productName").val($this.find('option:selected').text());
        $.post("baogia/getProductDetail", {id:id},
            function (data, status) {
                if (data.success) {
                    // console.log(data.row['description']);
                    $this.closest(".repeater-wrapper").find(".qty").val(1);
                    $this.closest(".repeater-wrapper").find(".discount").val(0);
                    $this.closest(".repeater-wrapper").find(".chietkhau").val(0);
                    $this.closest(".repeater-wrapper").find(".price").val(Comma(data.row['price']));
                    $this.closest(".repeater-wrapper").find(".unit").text(' /'+data.row['unit']);
                    $this.closest(".repeater-wrapper").find(".unitprice").val(data.row['unit']);
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
        // if ($this.next("textarea").length) {
        //     $this.next("textarea").val(value);
        // } else {
        //     $this.after('<textarea class="form-control mt-2" rows="2">' + value + "</textarea>");
        // }
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
        $('#quoteNum').val('');
        sourceItem.setList([{}]);
        select2.val(0).trigger('change');
        $('#invoiceTotal').text(0);
        $('#totalAmount').text(0);
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
    //     var items = sourceItem.repeaterVal();
    //     var customer = select2.val();
    //     var date = $('#date').val();
    //     var validdate = $('#validDate').val();
    //     var note = $('#note').val();
    //     var total = $('#invoiceTotal').text()
    //     var tax = $('#taxTotal').text();
    //     var id = $('#quoteNum').val();
    //     console.log(items);
    //     if(customer>0) {
    //         if (items['group-a'][0]['product']!='') {
    //             $.post("baogia/save", {id:id,customer:customer,items:items['group-a'],date:date,validdate:validdate,note:note,total:total,tax:tax},
    //                 function (data, status) {
    //                     if (data.success) {
    //                         $('#quoteNum').val('');
    //                         sourceItem.setList([{}]);
    //                         select2.val(0).trigger('change');
    //                         $('#invoiceTotal').text(0);
    //                         $('#totalAmount').text(0);
    //                         toastr["success"](data.msg, "💾 Task Action!", {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl,
    //                         });
    //                         $.post("baogia/send", {id:data.id},
    //                             function (result, status) {
    //                                 if (result.success) {
    //                                     toastr["success"](result.msg, "💾 Task Action!", {
    //                                         closeButton: true,
    //                                         tapToDismiss: false,
    //                                         rtl: isRtl,
    //                                     });
    //                                 } else {
    //                                     toastr["error"](result.msg, "💾 Task Action!", {
    //                                         closeButton: true,
    //                                         tapToDismiss: false,
    //                                         rtl: isRtl,
    //                                     });
    //                                 }
    //                         },"json");
    //                     } else {
    //                         toastr["error"](data.msg, "💾 Task Action!", {
    //                             closeButton: true,
    //                             tapToDismiss: false,
    //                             rtl: isRtl,
    //                         });
    //                     }
    //             },"json");
    //         } else {
    //             toastr["error"]('Bạn chưa chọn sản phẩm!', "💾 Task Action!", {
    //             closeButton: true,
    //             tapToDismiss: false,
    //             rtl: isRtl,
    //             });
    //         }
    //     } else {
    //         toastr["error"]('Bạn chưa chọn khách hàng!', "💾 Task Action!", {
    //         closeButton: true,
    //         tapToDismiss: false,
    //         rtl: isRtl,
    //         });
    //     }
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
