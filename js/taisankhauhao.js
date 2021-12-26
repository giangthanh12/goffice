var url = '';

$(function () {


    var dtUserTable = $(".user-list-table"),
        modal = $("#updateinfo"),
        nhom_ts = $("#nhom_ts"),
        don_vi = $("#don_vi"),
        don_vi_add = $("#don_vi_add"),
        nhom_ts_add = $("#nhom_ts_add"),
        datePicker = $(".ngay_gio"),
        form = $("#dg");
        statusObj = {
            0: { title: "Xoá", class: "badge-light-warning" },
            1: { title: "Hoạt động", class: "badge-light-success" },
            2: { title: "Tạm ngưng", class: "badge-light-warning" },
        };
        
 // datepicker init
 if (datePicker.length) {
    datePicker.flatpickr({
    });
} 
    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            // ajax: assetPath + "data/user-list.json", // JSON file to add data
            ajax: baseHome + "/taisankhauhao/list",
            columns: [
                { data: "name" },
                { data: "ngay_gio" },
                { data: "so_luong" },
                { data: "so_tien" },
                { data: "khau_hao" },
                { data: "khau_hao" },
                { data: "khau_hao" },
                { data: "khau_hao" },
            ],
            columnDefs: [
                {
                    // User full name and username
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var sotien = full["so_tien"];
                        var number = (sotien + '').replace(/[^0-9+\-Ee.]/g, '');
                        return  formatNumber(number);
                      
                    },
                },

                {
                    // User full name and username
                    targets: -1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var ngaynhap = full["ngay_gio"];
                        var sl = full["so_luong"];
                        var so_tien = full["so_tien"];
                        var khau_hao = full["khau_hao"];
                        var datenow = new Date();
                        var datets = new Date(ngaynhap);
                        var year_l = (datenow.getFullYear() - datets.getFullYear())*12;
                        var thang_chenh = datenow.getMonth() - datets.getMonth() + year_l ;
                        // Creates full output for row
                        var tienconlai_1 =  (so_tien*sl) - ((so_tien*thang_chenh*sl)/khau_hao);
                        var tienconlai =  Math.ceil(tienconlai_1);
                        if(tienconlai <= 0){
                            return  'Đã khâu hao hết';
                        }else{
                            var number = (tienconlai + '').replace(/[^0-9+\-Ee.]/g, '');
                            return  formatNumber(number);
                        }
                    },
                },

                {
                    // Tong tien
                    targets: 4,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var sl = full["so_luong"];
                        var so_tien = full["so_tien"];
                        // Creates full output for row
                        var number = sl * so_tien;
                         number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                        return  formatNumber(number);
                        
                    },
                },
                {
                    // Tong tien
                    targets: 6,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var ngaynhap = full["ngay_gio"];
                        var sl = full["so_luong"];
                        var so_tien = full["so_tien"];
                        var khau_hao = full["khau_hao"];
                        var datenow = new Date();
                        var datets = new Date(ngaynhap);
                        var year_l = (datenow.getFullYear() - datets.getFullYear())*12;
                        var thang_chenh = datenow.getMonth() - datets.getMonth() + year_l ;
                        var tienkh =  (so_tien*thang_chenh*sl)/khau_hao;
                        
                        var tongtien = sl * so_tien;
                        var tienkh_1 =  (so_tien*thang_chenh*sl)/khau_hao;
                        var tienkh =  Math.ceil(tienkh_1);
                        
                        if(tienkh >= tongtien){
                            var number = (tongtien + '').replace(/[^0-9+\-Ee.]/g, '');
                            return  formatNumber(number);
                        }else{
                            var number = (tienkh + '').replace(/[^0-9+\-Ee.]/g, '');
                            return  formatNumber(number);
                           
                        }
                       
                        
                    },
                },

               


               
               
            ],
            // order: [[2, "desc"]],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                ">t" +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "11111111112..",
            },
            // Buttons with Dropdown
            buttons: [
                
            ],

            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(0)
                    .every(function () {
                        var column = this;
                        var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Tài sản </option></select>')
                            .appendTo(".taisan_filter")
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
                            });
                    });

            },
        });

    }
});


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
