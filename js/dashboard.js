/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
function take_decimal_number(num, n) {
  //num : số cần xử lý
  //n: số chữ số sau dấu phẩy cần lấy
  let base = 10 ** n;
  let result = Math.round(num * base) / base;
  return result;
}
$(window).on('load', function () {
  'use strict';

  var $barColor = '#f3f3f3';
  var $trackBgColor = '#EBEBEB';
  var $textMutedColor = '#b9b9c3';
  var $budgetStrokeColor2 = '#dcdae3';
  var $goalStrokeColor2 = '#51e5a8';
  var $strokeColor = '#ebe9f1';
  var $textHeadingColor = '#5e5873';
  var $earningsStrokeColor2 = '#28c76f66';
  var $earningsStrokeColor3 = '#28c76f33';

  // var $statisticsOrderChart = document.querySelector('#statistics-order-chart');
  var $statisticsProfitChart = document.querySelector('#statistics-profit-chart');
  var $earningsChart = document.querySelector('#earnings-chart');
  var $revenueReportChart = document.querySelector('#revenue-report-chart');
  var $cashflowReportChart = document.querySelector('#cash-flow-report-chart');
  var $budgetChart = document.querySelector('#budget-chart');
  var $browserStateChartPrimary = document.querySelector('#browser-state-chart-primary');
  var $browserStateChartWarning = document.querySelector('#browser-state-chart-warning');
  var $browserStateChartSecondary = document.querySelector('#browser-state-chart-secondary');
  var $browserStateChartInfo = document.querySelector('#browser-state-chart-info');
  var $browserStateChartDanger = document.querySelector('#browser-state-chart-danger');
  var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');

  // var statisticsOrderChartOptions;
  var statisticsProfitChartOptions;
  var earningsChartOptions;
  var revenueReportChartOptions;
  var cashflowReportChartOptions;
  var budgetChartOptions;
  var browserStatePrimaryChartOptions;
  var browserStateWarningChartOptions;
  var browserStateSecondaryChartOptions;
  var browserStateInfoChartOptions;
  var browserStateDangerChartOptions;
  var goalOverviewChartOptions;

  // var statisticsOrderChart;
  var statisticsProfitChart;
  var earningsChart;
  var revenueReportChart;
  var cashflowReportChart;
  var budgetChart;
  var browserStatePrimaryChart;
  var browserStateDangerChart;
  var browserStateInfoChart;
  var browserStateSecondaryChart;
  var browserStateWarningChart;
  var goalOverviewChart;
  var arrNewCustomer = [];
  var arrData = [];
  var arrMonth = [];
  var arrMonth2 = [];
  var arrProfit = [];
  var arrLoss = [];
  var arrProfit2 = [];
  var arrLoss2 = [];
  var arrExpectedProfit = [];
  var arrExpectedLoss = [];
  var isRtl = $('html').attr('data-textdirection') === 'rtl';

  // // On load Toast
  // setTimeout(function () {
  //   toastr['success'](
  //     'You have successfully logged in to Vuexy. Now you can start to explore!',
  //     '👋 Welcome John Doe!',
  //     {
  //       closeButton: true,
  //       tapToDismiss: false,
  //       rtl: isRtl
  //     }
  //   );
  // }, 2000);

  $.ajax({ // tải thông báo
    type: "GET",
    dataType: "json",
    async: false,
    url: baseHome + "/dashboard/getdata",
    success: function (data) {
      $('#nguoigui').html('🎉 ' + data['thongbao']['nguoigui']);
      $('#noidung').html(data['thongbao']['tieu_de']);
      $('#tinmoi').html(data['tinmoi']);
    },
  });

  $.ajax({ // Report Customer
    type: "GET",
    dataType: "json",
    async: false,
    url: baseHome + "/dashboard/reportCustomer",
    success: function (data) {
      $('#new-customer').html(data.newCustomer)
      arrNewCustomer = data.arrNewCustomer;
      arrMonth = data.arrMonth;
    },
  });

  $.ajax({ // Report Data
    type: "GET",
    dataType: "json",
    async: false,
    url: baseHome + "/dashboard/reportData",
    success: function (data) {
      $('#change-data').html(data.changeData)
      arrData = data.arrData;
    },
  });

  $.ajax({ // Report Profit/Loss
    type: "GET",
    dataType: "json",
    async: false,
    url: baseHome + "/dashboard/reportProfitLoss",
    success: function (data) {
      arrProfit = data.arrProfit;
      arrLoss = data.arrLoss;
      arrMonth2 = data.arrMonth;
    },
  });

  $.ajax({ // Report Cash flow
    type: "GET",
    dataType: "json",
    async: false,
    url: baseHome + "/dashboard/reportCashFlow",
    success: function (data) {
      arrExpectedProfit = data.arrExpectedProfit;
      arrExpectedLoss = data.arrExpectedLoss;
      arrProfit2 = data.arrProfit;
      arrLoss2 = data.arrLoss;
    },
  });

  //------------ Statistics Bar Chart ------------
  //----------------------------------------------
  // statisticsOrderChartOptions = {
  //   chart: {
  //     height: 70,
  //     type: 'bar',
  //     stacked: true,
  //     toolbar: {
  //       show: false
  //     }
  //   },
  //   grid: {
  //     show: false,
  //     padding: {
  //       left: 0,
  //       right: 0,
  //       top: -15,
  //       bottom: -15
  //     }
  //   },
  //   plotOptions: {
  //     bar: {
  //       horizontal: false,
  //       columnWidth: '20%',
  //       startingShape: 'rounded',
  //       colors: {
  //         backgroundBarColors: [$barColor, $barColor, $barColor, $barColor, $barColor],
  //         backgroundBarRadius: 5
  //       }
  //     }
  //   },
  //   legend: {
  //     show: false
  //   },
  //   dataLabels: {
  //     enabled: false
  //   },
  //   colors: [window.colors.solid.warning],
  //   series: [
  //     {
  //       name: '2020',
  //       data: [45, 85, 65, 45, 65]
  //     }
  //   ],
  //   xaxis: {
  //     labels: {
  //       show: false
  //     },
  //     axisBorder: {
  //       show: false
  //     },
  //     axisTicks: {
  //       show: false
  //     }
  //   },
  //   yaxis: {
  //     show: false
  //   },
  //   tooltip: {s
  //     x: {
  //       show: false
  //     }
  //   }
  // };
  // statisticsOrderChart = new ApexCharts($statisticsOrderChart, statisticsOrderChartOptions);
  // statisticsOrderChart.render();

  //------------ Statistics Line Chart ------------
  //-----------------------------------------------
  statisticsProfitChartOptions = {
    chart: {
      height: 90,
      type: 'line',
      toolbar: {
        show: false
      },
      zoom: {
        enabled: false
      }
    },
    grid: {
      borderColor: $trackBgColor,
      strokeDashArray: 5,
      xaxis: {
        lines: {
          show: true
        }
      },
      yaxis: {
        lines: {
          show: false
        }
      },
      padding: {
        top: -10,
        bottom: -5
      }
    },
    stroke: {
      width: 3
    },
    colors: [window.colors.solid.info],
    series: [
      {
        name: "Số khách hàng mới",
        data: arrNewCustomer,
      }
    ],
    markers: {
      size: 2,
      colors: window.colors.solid.info,
      strokeColors: window.colors.solid.info,
      strokeWidth: 2,
      strokeOpacity: 1,
      strokeDashArray: 0,
      fillOpacity: 1,
      discrete: [
        {
          seriesIndex: 0,
          dataPointIndex: 5,
          fillColor: '#ffffff',
          strokeColor: window.colors.solid.info,
          size: 5
        }
      ],
      shape: 'circle',
      radius: 2,
      hover: {
        size: 3
      }
    },
    xaxis: {
      categories: arrMonth,
      labels: {
        show: true,
        style: {
          fontSize: '0px'
        }
      },
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      }
    },
    yaxis: {
      show: false
    },
    tooltip: {
      x: {
        show: false
      }
    }
  };
  statisticsProfitChart = new ApexCharts($statisticsProfitChart, statisticsProfitChartOptions);
  statisticsProfitChart.render();

  //--------------- Earnings Chart ---------------
  //----------------------------------------------
  earningsChartOptions = {
    chart: {
      type: 'donut',
      height: 120,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    series: arrData,
    legend: { show: false },
    comparedResult: [2, -3, 8],
    labels: ['Đã chuyển đổi', 'Chưa chuyển đổi'],
    stroke: { width: 0 },
    colors: [$earningsStrokeColor2, $earningsStrokeColor3, window.colors.solid.success],
    grid: {
      padding: {
        right: -20,
        bottom: -8,
        left: -20
      }
    },
    plotOptions: {
      pie: {
        startAngle: -10,
        donut: {
          labels: {
            show: true,
            name: {
              offsetY: 15
            },
            value: {
              offsetY: -15,
              formatter: function (val) {
                return take_decimal_number(val, 2) + "%";
              }
            },
            total: {
              show: true,
              offsetY: 15,
              label: 'Đã chuyển đổi',
              formatter: function (w) {
                return take_decimal_number(arrData[0],2) + '%';
                
              }
            }
          }
        }
      }
    },
    responsive: [
      {
        breakpoint: 1325,
        options: {
          chart: {
            height: 100
          }
        }
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 120
          }
        }
      },
      {
        breakpoint: 1045,
        options: {
          chart: {
            height: 100
          }
        }
      },
      {
        breakpoint: 992,
        options: {
          chart: {
            height: 120
          }
        }
      }
    ]
  };
  earningsChart = new ApexCharts($earningsChart, earningsChartOptions);
  earningsChart.render();

  //------------ Revenue Report Chart ------------
  //----------------------------------------------
  revenueReportChartOptions = {
    chart: {
      height: 230,
      width: "100%",
      stacked: false,
      type: "bar",
      toolbar: { show: false },
    },
    plotOptions: {
      bar: {
        columnWidth: "80%",
        endingShape: "rounded",
      },
      distributed: true,
    },
    colors: [window.colors.solid.success, window.colors.solid.danger],
    series: [
      {
        name: "Doanh thu",
        data: arrProfit,
      },
      {
        name: "Chi phí",
        data: arrLoss,
      },
    ],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 1,
      colors: ["#fff"],
    },
    legend: {
      show: false,
    },
    grid: {
      padding: {
        top: -20,
        bottom: -10,
      },
      yaxis: {
        lines: { show: false },
      },
    },
    xaxis: {
      width: "100%",
      categories: arrMonth2,
      labels: {
        style: {
          colors: $textMutedColor,
          fontSize: "0.86rem",
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        style: {
          colors: $textMutedColor,
          fontSize: "0.86rem",
        },
      },
    },
  };
  revenueReportChart = new ApexCharts(
    $revenueReportChart,
    revenueReportChartOptions
  );
  revenueReportChart.render();

   //------------ Cash flow Report Chart ------------
  //----------------------------------------------
  cashflowReportChartOptions = {
    chart: {
      height: 230,
      width: '100%',
      stacked: false,
      type: 'bar',
      toolbar: { show: false }
    },
    plotOptions: {
      bar: {
        columnWidth: '80%',
        endingShape: 'rounded'
      },
      distributed: true
    },
    colors: [window.colors.solid.primary, window.colors.solid.success, window.colors.solid.warning, window.colors.solid.danger],
    series: [
      {
        name: 'Dự thu',
        data: arrExpectedProfit
      },
      {
        name: 'Thực thu',
        data: arrProfit2
      },
      {
        name: 'Dự chi',
        data: arrExpectedLoss
      },
      {
        name: 'Thực chi',
        data: arrLoss2
      }
    ],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 1,
      colors: ['#fff']
    },
    legend: {
      show: false
    },
    grid: {
      padding: {
        top: -20,
        bottom: -10
      },
      yaxis: {
        lines: { show: false }
      }
    },
    xaxis: {
      width: '100%',
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      labels: {
        style: {
          colors: $textMutedColor,
          fontSize: '0.86rem',
        }
      },
      axisTicks: {
        show: false
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: $textMutedColor,
          fontSize: '0.86rem'
        }
      }
    }
  };
  cashflowReportChart = new ApexCharts($cashflowReportChart, cashflowReportChartOptions);
  cashflowReportChart.render();

  //---------------- Budget Chart ----------------
  //----------------------------------------------
  budgetChartOptions = {
    chart: {
      height: 80,
      toolbar: { show: false },
      zoom: { enabled: false },
      type: 'line',
      sparkline: { enabled: true }
    },
    stroke: {
      curve: 'smooth',
      dashArray: [0, 5],
      width: [2]
    },
    colors: [window.colors.solid.primary, $budgetStrokeColor2],
    series: [
      {
        data: [61, 48, 69, 52, 60, 40, 79, 60, 59, 43, 62]
      },
      {
        data: [20, 10, 30, 15, 23, 0, 25, 15, 20, 5, 27]
      }
    ],
    tooltip: {
      enabled: false
    }
  };
  budgetChart = new ApexCharts($budgetChart, budgetChartOptions);
  budgetChart.render();

  //------------ Browser State Charts ------------
  //----------------------------------------------

  // State Primary Chart
  browserStatePrimaryChartOptions = {
    chart: {
      height: 30,
      width: 30,
      type: 'radialBar'
    },
    grid: {
      show: false,
      padding: {
        left: -15,
        right: -15,
        top: -12,
        bottom: -15
      }
    },
    colors: [window.colors.solid.primary],
    series: [54.4],
    plotOptions: {
      radialBar: {
        hollow: {
          size: '22%'
        },
        track: {
          background: $trackBgColor
        },
        dataLabels: {
          showOn: 'always',
          name: {
            show: false
          },
          value: {
            show: false
          }
        }
      }
    },
    stroke: {
      lineCap: 'round'
    }
  };
  browserStatePrimaryChart = new ApexCharts($browserStateChartPrimary, browserStatePrimaryChartOptions);
  browserStatePrimaryChart.render();

  // State Warning Chart
  browserStateWarningChartOptions = {
    chart: {
      height: 30,
      width: 30,
      type: 'radialBar'
    },
    grid: {
      show: false,
      padding: {
        left: -15,
        right: -15,
        top: -12,
        bottom: -15
      }
    },
    colors: [window.colors.solid.warning],
    series: [6.1],
    plotOptions: {
      radialBar: {
        hollow: {
          size: '22%'
        },
        track: {
          background: $trackBgColor
        },
        dataLabels: {
          showOn: 'always',
          name: {
            show: false
          },
          value: {
            show: false
          }
        }
      }
    },
    stroke: {
      lineCap: 'round'
    }
  };
  browserStateWarningChart = new ApexCharts($browserStateChartWarning, browserStateWarningChartOptions);
  browserStateWarningChart.render();

  // State Secondary Chart 1
  browserStateSecondaryChartOptions = {
    chart: {
      height: 30,
      width: 30,
      type: 'radialBar'
    },
    grid: {
      show: false,
      padding: {
        left: -15,
        right: -15,
        top: -12,
        bottom: -15
      }
    },
    colors: [window.colors.solid.secondary],
    series: [14.6],
    plotOptions: {
      radialBar: {
        hollow: {
          size: '22%'
        },
        track: {
          background: $trackBgColor
        },
        dataLabels: {
          showOn: 'always',
          name: {
            show: false
          },
          value: {
            show: false
          }
        }
      }
    },
    stroke: {
      lineCap: 'round'
    }
  };
  browserStateSecondaryChart = new ApexCharts($browserStateChartSecondary, browserStateSecondaryChartOptions);
  browserStateSecondaryChart.render();

  // State Info Chart
  browserStateInfoChartOptions = {
    chart: {
      height: 30,
      width: 30,
      type: 'radialBar'
    },
    grid: {
      show: false,
      padding: {
        left: -15,
        right: -15,
        top: -12,
        bottom: -15
      }
    },
    colors: [window.colors.solid.info],
    series: [4.2],
    plotOptions: {
      radialBar: {
        hollow: {
          size: '22%'
        },
        track: {
          background: $trackBgColor
        },
        dataLabels: {
          showOn: 'always',
          name: {
            show: false
          },
          value: {
            show: false
          }
        }
      }
    },
    stroke: {
      lineCap: 'round'
    }
  };
  browserStateInfoChart = new ApexCharts($browserStateChartInfo, browserStateInfoChartOptions);
  browserStateInfoChart.render();

  // State Danger Chart
  browserStateDangerChartOptions = {
    chart: {
      height: 30,
      width: 30,
      type: 'radialBar'
    },
    grid: {
      show: false,
      padding: {
        left: -15,
        right: -15,
        top: -12,
        bottom: -15
      }
    },
    colors: [window.colors.solid.danger],
    series: [8.4],
    plotOptions: {
      radialBar: {
        hollow: {
          size: '22%'
        },
        track: {
          background: $trackBgColor
        },
        dataLabels: {
          showOn: 'always',
          name: {
            show: false
          },
          value: {
            show: false
          }
        }
      }
    },
    stroke: {
      lineCap: 'round'
    }
  };
  browserStateDangerChart = new ApexCharts($browserStateChartDanger, browserStateDangerChartOptions);
  browserStateDangerChart.render();

  //------------ Goal Overview Chart ------------
  //---------------------------------------------
  goalOverviewChartOptions = {
    chart: {
      height: 245,
      type: 'radialBar',
      sparkline: {
        enabled: true
      },
      dropShadow: {
        enabled: true,
        blur: 3,
        left: 1,
        top: 1,
        opacity: 0.1
      }
    },
    colors: [$goalStrokeColor2],
    plotOptions: {
      radialBar: {
        offsetY: -10,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '77%'
        },
        track: {
          background: $strokeColor,
          strokeWidth: '50%'
        },
        dataLabels: {
          name: {
            show: false
          },
          value: {
            color: $textHeadingColor,
            fontSize: '2.86rem',
            fontWeight: '600'
          }
        }
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        type: 'horizontal',
        shadeIntensity: 0.5,
        gradientToColors: [window.colors.solid.success],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    series: [83],
    stroke: {
      lineCap: 'round'
    },
    grid: {
      padding: {
        bottom: 30
      }
    }
  };
  goalOverviewChart = new ApexCharts($goalOverviewChart, goalOverviewChartOptions);
  goalOverviewChart.render();
});


/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
// $(function () {
//     "use strict";
//     var dtUserTable = $(".user-list-table"),
//         newUserSidebar = $(".new-user-modal"),
//         newUserForm = $(".add-new-user"),
//         quequan = $('#quequan'),
//         noicap = $('#noicap'),
//         statusObj = {
//             1: { title: "Thực tập sinh", class: "badge-light-warning" },
//             2: { title: "Thử việc", class: "badge-light-success" },
//             3: { title: "Chính thức", class: "badge-light-secondary" },
//         };
//

//
//     // var assetPath = "styles/app-assets/",
//         // userView = "nhansu/view",
//         // userEdit = "nhansu/edit";
//     // if ($("body").attr("data-framework") === "laravel") {
//     //     assetPath = $("body").attr("data-asset-path");
//     //     userView = assetPath + "app/user/view";
//     //     userEdit = assetPath + "app/user/edit";
//     // }
//
//     // Users List datatable
//     if (dtUserTable.length) {
//         dtUserTable.DataTable({
//             // ajax: assetPath + "data/user-list.json", // JSON file to add data
//             ajax: baseHome + "/nhansu",
//             columns: [
//                 // columns according to JSON
//                 { data: "id" },
//                 { data: "name" },
//                 { data: "email" },
//                 { data: "dien_thoai" },
//                 { data: "phongban" },
//                 { data: "tinh_trang" },
//                 { data: "" },
//             ],
//             columnDefs: [
//                 {
//                     // For Responsive
//                     className: "control",
//                     orderable: false,
//                     responsivePriority: 2,
//                     targets: 0,
//                 },
//                 {
//                     // User full name and username
//                     targets: 1,
//                     responsivePriority: 4,
//                     render: function (data, type, full, meta) {
//                         var $name = full["name"],
//                             $uname = full["chinhanh"],
//                             $image = full["hinh_anh"];
//                         if ($image) {
//                             // For Avatar image
//                             var $output = '<img src="' + $image + '" alt="Avatar" height="32" width="32">';
//                             // var $output = '<img src="' + assetPath + "images/avatars/" + $image + '" alt="Avatar" height="32" width="32">';
//                         } else {
//                             // For Avatar badge
//                             var stateNum = Math.floor(Math.random() * 6) + 1;
//                             var states = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
//                             var $state = states[stateNum],
//                                 $name = full["name"],
//                                 $initials = $name.match(/\b\w/g) || [];
//                             $initials = (($initials.shift() || "") + ($initials.pop() || "")).toUpperCase();
//                             $output = '<span class="avatar-content">' + $initials + "</span>";
//                         }
//                         var colorClass = $image === "" ? " bg-light-" + $state + " " : "";
//                         // Creates full output for row
//                         var $row_output =
//                             '<div class="d-flex justify-content-left align-items-center">' +
//                             '<div class="avatar-wrapper">' +
//                             '<div class="avatar ' +
//                             colorClass +
//                             ' mr-1">' +
//                             $output +
//                             "</div>" +
//                             "</div>" +
//                             '<div class="d-flex flex-column">' +
//                             '<a href="javascript:void(0)" onclick="loaddata('+full["id"]+')" data-toggle="modal" data-target="#updateinfo" class="user_name text-truncate"><span class="font-weight-bold">' +
//                             $name +
//                             "</span></a>" +
//                             '<small class="emp_post text-muted">@' +
//                             $uname +
//                             "</small>" +
//                             "</div>" +
//                             "</div>";
//                         return $row_output;
//                     },
//                 },
//                 {
//                     // User Role
//                     targets: 3,
//                     render: function (data, type, full, meta) {
//                         var $role = full["dien_thoai"];
//                         var roleBadgeObj = {
//                             Subscriber: feather.icons["user"].toSvg({ class: "font-medium-3 text-primary mr-50" }),
//                             Author: feather.icons["settings"].toSvg({ class: "font-medium-3 text-warning mr-50" }),
//                             Maintainer: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
//                             Editor: feather.icons["edit-2"].toSvg({ class: "font-medium-3 text-info mr-50" }),
//                             Admin: feather.icons["slack"].toSvg({ class: "font-medium-3 text-danger mr-50" }),
//                         };
//                         return "<span class='text-truncate align-middle'>" + roleBadgeObj['Subscriber'] + $role + "</span>";
//                     },
//                 },
//                 {
//                     // User Status
//                     targets: 5,
//                     render: function (data, type, full, meta) {
//                         var $status = full["tinh_trang"];
//
//                         return '<span class="badge badge-pill ' + statusObj[$status].class + '" text-capitalized>' + statusObj[$status].title + "</span>";
//                     },
//                 },
//                 {
//                     // Actions
//                     targets: -1,
//                     title: feather.icons["database"].toSvg({ class: "font-medium-3 text-success mr-50" }),
//                     orderable: false,
//                     render: function (data, type, full, meta) {
//                         return (
//                             '<div class="btn-group">' +
//                             '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
//                             feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
//                             "</a>" +
//                             '<div class="dropdown-menu dropdown-menu-right">' +
//                             '<a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#updateinfo" onclick="loaddata('+full["id"]+')">' +
//                             feather.icons["file-text"].toSvg({ class: "font-small-4 mr-50" }) +
//                             "Xem/sửa</a>" +
//                             '<a href="javascript:void(0)" class="dropdown-item" onclick="thoiviec('+full["id"]+')" >' +
//                             feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
//                             "Thôi việc</a>" +
//                             '<a href="javascript:void(0)" class="dropdown-item delete-record" onclick="xoa('+full["id"]+')">' +
//                             feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
//                             "Xóa</a></div>" +
//                             "</div>" +
//                             "</div>"
//                         );
//                         // '<a href="' +
//                         // userEdit +
//                         // '?id=' + full["id"] +
//                         // '" class="dropdown-item">' +
//                         // feather.icons["archive"].toSvg({ class: "font-small-4 mr-50" }) +
//                         // "Cập nhật</a>" +
//                     },
//                 },
//             ],
//             // order: [[2, "desc"]],
//             dom:
//                 '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
//                 '<"col-lg-12 col-xl-6" l>' +
//                 '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
//                 ">t" +
//                 '<"d-flex justify-content-between mx-2 row mb-1"' +
//                 '<"col-sm-12 col-md-6"i>' +
//                 '<"col-sm-12 col-md-6"p>' +
//                 ">",
//             language: {
//                 sLengthMenu: "Show _MENU_",
//                 search: "Search",
//                 searchPlaceholder: "Search..",
//             },
//             // Buttons with Dropdown
//             buttons: [
//                 {
//                     text: "Thêm mới",
//                     className: "add-new btn btn-primary mt-50",
//                     attr: {
//                         "data-toggle": "modal",
//                         "data-target": "#modals-slide-in",
//                     },
//                     init: function (api, node, config) {
//                         $(node).removeClass("btn-secondary");
//                     },
//                 },
//             ],
//             // For responsive popup
//             responsive: {
//                 details: {
//                     display: $.fn.dataTable.Responsive.display.modal({
//                         header: function (row) {
//                             var data = row.data();
//                             return "Details of " + data["name"];
//                         },
//                     }),
//                     type: "column",
//                     renderer: $.fn.dataTable.Responsive.renderer.tableAll({
//                         tableClass: "table",
//                         columnDefs: [
//                             {
//                                 targets: 2,
//                                 visible: false,
//                             },
//                             {
//                                 targets: 3,
//                                 visible: false,
//                             },
//                         ],
//                     }),
//                 },
//             },
//             language: {
//                 paginate: {
//                     // remove previous & next text from pagination
//                     previous: "&nbsp;",
//                     next: "&nbsp;",
//                 },
//             },
//             initComplete: function () {
//                 // Adding role filter once table initialized
//                 this.api()
//                     .columns(3)
//                     .every(function () {
//                         var column = this;
//                         var select = $('<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Chi nhánh </option></select>')
//                             .appendTo(".user_role")
//                             .on("change", function () {
//                                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
//                                 column.search(val ? "^" + val + "$" : "", true, false).draw();
//                             });
//
//                         column
//                             .data()
//                             .unique()
//                             .sort()
//                             .each(function (d, j) {
//                                 select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
//                             });
//                     });
//                 // Adding plan filter once table initialized
//                 this.api()
//                     .columns(4)
//                     .every(function () {
//                         var column = this;
//                         var select = $('<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Phòng ban </option></select>')
//                             .appendTo(".user_plan")
//                             .on("change", function () {
//                                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
//                                 column.search(val ? "^" + val + "$" : "", true, false).draw();
//                             });
//
//                         column
//                             .data()
//                             .unique()
//                             .sort()
//                             .each(function (d, j) {
//                                 select.append('<option value="' + d + '" class="text-capitalize">' + d + "</option>");
//                             });
//                     });
//                 // Adding status filter once table initialized
//                 this.api()
//                     .columns(5)
//                     .every(function () {
//                         var column = this;
//                         var select = $('<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value=""> Hợp đồng lao động </option></select>')
//                             .appendTo(".user_status")
//                             .on("change", function () {
//                                 var val = $.fn.dataTable.util.escapeRegex($(this).val());
//                                 column.search(val ? "^" + val + "$" : "", true, false).draw();
//                             });
//
//                         column
//                             .data()
//                             .unique()
//                             .sort()
//                             .each(function (d, j) {
//                                 select.append('<option value="' + statusObj[d].title + '" class="text-capitalize">' + statusObj[d].title + "</option>");
//                             });
//                     });
//             },
//         });
//     }
//
//     // Check Validity
//     function checkValidity(el) {
//         if (el.validate().checkForm()) {
//             submitBtn.attr("disabled", false);
//         } else {
//             submitBtn.attr("disabled", true);
//         }
//     }
//
//     // Form Validation
//     if (newUserForm.length) {
//         newUserForm.validate({
//             errorClass: "error",
//             rules: {
//                 "user-fullname": {
//                     required: true,
//                 },
//                 "user-name": {
//                     required: true,
//                 },
//                 "user-email": {
//                     required: true,
//                 },
//             },
//         });
//
//         newUserForm.on("submit", function (e) {
//             var isValid = newUserForm.valid();
//             e.preventDefault();
//             if (isValid) {
//                 newUserSidebar.modal("hide");
//             }
//         });
//     }
//
//     // To initialize tooltip with body container
//     $("body").tooltip({
//         selector: '[data-toggle="tooltip"]',
//         container: "body",
//     });
// });
//
// function loaddata(id) {
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: { id: id },
//         url: baseHome + "/nhansu/loaddata",
//         success: function (data) {
//             $('#nhanvien').html(data.name);
//             $('#avatar').attr('src', data.hinh_anh);
//             if (data.gioi_tinh==1)
//                $("#male").prop("checked", true).trigger("click");
//             else
//                $("#female").prop("checked", true).trigger("click");
//             if (data.tinh_trang==1)
//                $("#hopdong1").prop("checked", true).trigger("click");
//             else if (data.tinh_trang==2)
//                $("#hopdong2").prop("checked", true).trigger("click");
//             else if (data.tinh_trang==3)
//                $("#hopdong3").prop("checked", true).trigger("click");
//             else if (data.tinh_trang==4)
//                $("#hopdong4").prop("checked", true).trigger("click");
//             $('#hoten').val(data.name);
//             $('#ngaysinh').flatpickr({
//                 monthSelectorType: "static",
//                 altInput: true,
//                 defaultDate: data.ngay_sinh,
//                 altFormat: "j F, Y",
//                 dateFormat: "Y-m-d",
//             });
//             $('#dienthoai').val(data.dien_thoai);
//             $('#email').val(data.email);
//             $('#diachi').val(data.dia_chi);
//             $('#quequan option[value='+data.que_quan+']').attr('selected','selected');
//             $("#quequan").val(data.que_quan).change();
//             $('#cmnd').val(data.cmnd);
//             $('#ngaycap').flatpickr({
//                 monthSelectorType: "static",
//                 altInput: true,
//                 defaultDate: data.ngay_cap,
//                 altFormat: "j F, Y",
//                 dateFormat: "Y-m-d",
//             });
//             $('#noicap option[value='+data.noi_cap+']').attr('selected','selected');
//             $("#noicap").val(data.noi_cap).change();
//             $('#masothue').val(data.ma_so_thue);
//             $('#bhxh').val(data.bhxh);
//             $('#thuongtru').val(data.thuong_tru);
//             $("#id").val(id);
//         },
//         error: function(){
//             notify_error('Lỗi truy xuất database');
//         }
//     });
// }
//
// function updateinfo() {
//     var id = $("#id").val();
//     var info = {};
//     info.gioi_tinh = $("input[type='radio'][name='gender']:checked").val();
//     info.tinh_trang = $("input[type='radio'][name='hopdong']:checked").val();
//     info.name = $("#hoten").val();
//     info.ngay_sinh = $("#ngaysinh").val();
//     info.dien_thoai = $("#dienthoai").val();
//     info.email = $("#email").val();
//     info.dia_chi = $("#diachi").val();
//     info.que_quan = $("#quequan").val();
//     info.cmnd = $("#cmnd").val();
//     info.ngay_cap = $("#ngaycap").val();
//     info.noi_cap = $("#noicap").val();
//     info.ma_so_thue = $("#masothue").val();
//     info.thuong_tru = $("#thuongtru").val();
//     info.bhxh = $("#bhxh").val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: {data:info, id:id},
//         url: baseHome + "/nhansu/updateinfo",
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 $('#updateinfo').modal('hide');
//                 $(".user-list-table").DataTable().ajax.reload( null, false );
//             }
//             else
//                 notify_error(data.msg);
//         },
//         error: function(){
//             notify_error('Cập nhật không thành công');
//         }
//     });
// }
//
// function thayanh(){
//     var id = $("#id").val();
//     var myform = new FormData($('#thongtin')[0]);
//     myform.append('myid', id);
//     $.ajax({
//         url: baseHome + "/nhansu/thayanh",
//         type: 'post',
//         data: myform,
//         contentType: false,
//         processData: false,
//         success: function(data){
//             if (data.success) {
//                notyfi_success(data.msg);
//                $('#avatar').attr('src', data.filename);
//             }
//             else
//                 notify_error(data.msg);
//         },
//     });
// }
//
// function them() {
//     var info = {};
//     info.tinh_trang = $("#tinh_trang").val();
//     info.name = $("#fullname").val();
//     info.dien_thoai = $("#dien_thoai").val();
//     info.email = $("#user-email").val();
//     $.ajax({
//         type: "POST",
//         dataType: "json",
//         data: {data:info},
//         url: baseHome + "/nhansu/them",
//         success: function (data) {
//             if (data.success) {
//                 notyfi_success(data.msg);
//                 $('#modals-slide-in').modal('hide');
//                 $(".user-list-table").DataTable().ajax.reload( null, false );
//             }
//             else
//                 notify_error(data.msg);
//         },
//         error: function(){
//             notify_error('Cập nhật không thành công');
//         }
//     });
// }
//
// function xoa(id){
//     $.ajax({
//         url: baseHome + "/nhansu/xoa",
//         type: 'post',
//         dataType: "json",
//         data: {id: id},
//         success: function(data){
//             if (data.success) {
//                notyfi_success(data.msg);
//                $(".user-list-table").DataTable().ajax.reload( null, false );
//             }
//             else
//                 notify_error(data.msg);
//         },
//     });
// }
//
// function thoiviec(id){
//     $.ajax({
//         url: baseHome + "/nhansu/thoiviec",
//         type: 'post',
//         dataType: "json",
//         data: {id: id},
//         success: function(data){
//             if (data.success) {
//                notyfi_success(data.msg);
//                $(".user-list-table").DataTable().ajax.reload( null, false );
//             }
//             else
//                 notify_error(data.msg);
//         },
//     });
// }
