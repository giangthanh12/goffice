var url = "";

$(function () {
  var dtUserTable = $(".user-list-table"),
    modal = $("#updateinfo"),
    form = $("#dg");
  statusObj = {
    0: { title: "Thu", class: "badge-light-success" },
    1: { title: "Chi", class: "badge-light-danger" },
  };

//   (timeStart = $("#time_s")), (timeEnd = $("#time_e"));

//   if (timeStart.length) {
//     timeStart.flatpickr({
//       enableTime: false,
//       dateFormat: "Y-m-d",
//     });
//   }
//   if (timeEnd.length) {
//     timeEnd.flatpickr({
//       enableTime: false,
//       dateFormat: "Y-m-d",
//     });
//   }

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      ordering: false,
      // ajax: assetPath + "data/user-list.json", // JSON file to add data
      ajax: baseHome + "/baocaochiphi/list",
      columns: [
        // columns according to JSON
        { data: "dateTimeNew" },
        { data: "customerName" },
        { data: "classifyName" },
        { data: "contractName" },
        { data: "content" },
        { data: "asset" },
        { data: "note" },
      ],
      columnDefs: [],
      initComplete: function () {
        // Adding plan filter once table initialized
        this.api()
          .columns(2)
          .every(function () {
            var column = this;
            var select = $(
              '<select class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Khoản chi </option></select>'
            )
              .appendTo(".staff_filter")
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? "^" + val + "$" : "", true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                    d +
                    '" class="text-capitalize">' +
                    d +
                    "</option>"
                );
              });
          });

        this.api()
          .columns(1)
          .every(function () {
            var column = this;
            var select = $(
              '<select class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Đối tác/Nhà cung cấp </option></select>'
            )
              .appendTo(".customer_filter")
              .on("change", function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? "^" + val + "$" : "", true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                    d +
                    '" class="text-capitalize">' +
                    d +
                    "</option>"
                );
              });
          });
      },
    });
  }

  // Check Validity
  function checkValidity(el) {
    if (el.validate().checkForm()) {
      submitBtn.attr("disabled", false);
    } else {
      submitBtn.attr("disabled", true);
    }
  }

  // Form Validation
//   if (form.length) {
//     form.validate({
//       errorClass: "error",
//       rules: {
//         "user-fullname": {
//           required: true,
//         },
//         "user-name": {
//           required: true,
//         },
//         "user-email": {
//           required: true,
//         },
//       },
//     });

//     form.on("submit", function (e) {
//       var isValid = form.valid();
//       e.preventDefault();
//       if (isValid) {
//         modal.modal("hide");
//       }
//     });
//   }

  // To initialize tooltip with body container
  $("body").tooltip({
    selector: '[data-toggle="tooltip"]',
    container: "body",
  });

  ///bieu do doanh thu
  var dateObj = new Date();
  var thang = dateObj.getMonth();
  thang = thang > 9 ? thang : "0" + thang;
  var ngay = dateObj.getDate();
  ngay = ngay > 9 ? ngay : "0" + ngay;
  var dateToUse = dateObj.getFullYear() + "-" + thang + "-" + ngay;

//   $("#time_e").val(dateToUse);
//   $("#time_s").val(dateObj.getFullYear() + "-01-01");
  $("#title_thongke").html("Thống kê doanh thu năm  " + dateObj.getFullYear());
//   var $barColor = "#f3f3f3";
//   var $trackBgColor = "#EBEBEB";
//   var $textMutedColor = "#b9b9c3";
//   var $budgetStrokeColor2 = "#dcdae3";
//   var $goalStrokeColor2 = "#51e5a8";
//   var $strokeColor = "#ebe9f1";
//   var $textHeadingColor = "#5e5873";
//   var $earningsStrokeColor2 = "#28c76f66";
//   var $earningsStrokeColor3 = "#28c76f33";
//   var $revenueReportChart = document.querySelector("#revenue-report-chart");
//   var revenueReportChartOptions;
//   var revenueReportChart;

//   //------------ Revenue Report Chart ------------
//   //----------------------------------------------

//   ///END bieu do doanh thu

//   //lay thong tin doanh so nam_nay và add vào Bieu do
//   $.ajax({
//     type: "GET",
//     dataType: "json",
//     async: false,
//     url: baseHome + "/baocaodoanhthu/doanhso_namnay",
//     success: function (json) {
//       var donhang = json.donhang;
//       var sotien = 0;
//       // var sono = 0;
//       for (let i = 0; i < donhang.length; i++) {
//         var donhang_sotien = Number(donhang[i].so_tien);
//         // var donhang_sono = Number(donhang[i].tien_no);
//         sotien = sotien + donhang_sotien;
//         // sono = sono + donhang_sono;
//       }
//       var socai = json.socai;
//       var thucthu = 0;
//       var chi = 0;
//       for (let j = 0; j < socai.length; j++) {
//         var socai_sotien = Number(socai[j].so_tien);
//         var loai = Number(socai[j].loai);
//         if (loai == 0) {
//           thucthu = thucthu + socai_sotien;
//           sotien = sotien + socai_sotien;
//         } else {
//           chi = chi + socai_sotien;
//           sotien = sotien - socai_sotien;
//         }
//       }
//       $("#doanh_so_all").html(
//         formatCurrency(sotien + "".replace(/[,VNĐ]/g, ""))
//       );
//       // $("#doanh_so_all").html(formatCurrency(sotien+''.replace(/[,VNĐ]/g,'')));
//       // $("#so_no_all").html(formatCurrency(sono+''.replace(/[,VNĐ]/g,'')));
//       $("#thuc_thu_all").html(
//         formatCurrency(thucthu + "".replace(/[,VNĐ]/g, ""))
//       );
//       $("#chi_all").html(formatCurrency(chi + "".replace(/[,VNĐ]/g, "")));

//       // var data_bieudo = json.data_bd;
//       // var thu = data_bieudo.thu;
//       // var chi = data_bieudo.chi;
//       //alert(data_chi[3]);
//       // call_bieudo([95, 177, 284, 256, 105, 63, 168, 218, 72,72,72,72],[-145, -80, -60, -180, -100, -60, -85, -75, -100,-100,-100,-100]);
//       // console.log(data_bieudo);

//       //add bieu do
//       revenueReportChartOptions = {
//         chart: {
//           height: 300,
//           stacked: true,
//           type: "bar",
//           toolbar: { show: false },
//         },
//         plotOptions: {
//           bar: {
//             columnWidth: "17%",
//             endingShape: "rounded",
//           },
//           distributed: true,
//         },
//         colors: [window.colors.solid.primary, window.colors.solid.warning],
//         series: [
//           {
//             name: "Thu",
//             data: thu,
//           },
//           {
//             name: "Chi",
//             data: chi,
//           },
//         ],
//         dataLabels: {
//           enabled: false,
//         },
//         legend: {
//           show: false,
//         },
//         grid: {
//           padding: {
//             top: -20,
//             bottom: -10,
//           },
//           yaxis: {
//             lines: { show: false },
//           },
//           xaxis: {
//             lines: { show: false },
//             labels: {
//               template: "X: #: value #",
//             },
//           },
//         },
//         xaxis: {
//           categories: [
//             "Tháng 1",
//             "Tháng 2",
//             "Tháng 3",
//             "Tháng 4",
//             "Tháng 5",
//             "Tháng 6",
//             "Tháng 7",
//             "Tháng 8",
//             "Tháng 9",
//             "Tháng 10",
//             "Tháng 11",
//             "Tháng 12",
//           ],
//           labels: {
//             style: {
//               colors: $textMutedColor,
//               fontSize: "0.86rem",
//             },
//           },
//           axisTicks: {
//             show: false,
//           },
//           axisBorder: {
//             show: false,
//           },
//         },
//         yaxis: {
//           labels: {
//             style: {
//               colors: $textMutedColor,
//               fontSize: "0.86rem",
//             },
//             template: "X",
//           },
//         },
//       };
//       revenueReportChart = new ApexCharts(
//         $revenueReportChart,
//         revenueReportChartOptions
//       );
//       revenueReportChart.render();

//       //end bieu do
//     },
//     error: function () {
//       console.log("Lỗi biểu đồ");
//     },
//   });
});

// function loc() {
//   var info = {};
//   info.time_s = $("#time_s").val();
//   info.time_e = $("#time_e").val();
//   $("#revenue-report-chart").remove();
//   $("#bieudo").remove();
//   $("#title_thongke").html(
//     "Thống kê doanh từ " + info.time_s + " đến " + info.time_e
//   );

//   var table = $(".user-list-table").DataTable();
//   table.ajax
//     .url(
//       baseHome +
//         "/baocaodoanhthu/loc_socai?time_s=" +
//         info.time_s +
//         "&time_e=" +
//         info.time_e
//     )
//     .load();
//   table.draw();

//   $.ajax({
//     type: "POST",
//     dataType: "json",
//     data: info,
//     url: baseHome + "/baocaodoanhthu/loc_socai",
//     success: function (json) {
//       var donhang = json.donhang;
//       var sotien = 0;
//       var sono = 0;

//       for (let i = 0; i < donhang.length; i++) {
//         var donhang_sotien = Number(donhang[i].so_tien);
//         // var donhang_sono = Number(donhang[i].tien_no);
//         sotien = sotien + donhang_sotien;
//         // sono = sono + donhang_sono;
//       }
//       var socai = json.socai;
//       var thucthu = 0;
//       var chi = 0;
//       for (let j = 0; j < socai.length; j++) {
//         var socai_sotien = Number(socai[j].so_tien);
//         var loai = Number(socai[j].loai);
//         if (loai == 0) {
//           thucthu = thucthu + socai_sotien;
//           sotien = sotien + socai_sotien;
//         } else {
//           chi = chi + socai_sotien;
//           sotien = sotien - socai_sotien;
//         }
//       }
//       $("#doanh_so_all").html(
//         formatCurrency(sotien + "".replace(/[,VNĐ]/g, ""))
//       );
//       // $("#doanh_so_all").html(formatCurrency(sotien+''.replace(/[,VNĐ]/g,'')));
//       $("#so_no_all").html(formatCurrency(sono + "".replace(/[,VNĐ]/g, "")));
//       $("#thuc_thu_all").html(
//         formatCurrency(thucthu + "".replace(/[,VNĐ]/g, ""))
//       );
//       $("#chi_all").html(formatCurrency(chi + "".replace(/[,VNĐ]/g, "")));
//     },
//     error: function () {
//       console.log("Lỗi bộ lọc");
//     },
//   });
// }
