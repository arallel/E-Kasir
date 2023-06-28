"use strict";
!function (NioApp, $) {
  "use strict";

  function penjualanbulanan() {
  $.ajax({
    url: "api/chart/penjualan",
    method: "GET",
    success: function(data) {
      //data bulanan
      const labels = [];
      const datas = [];
      for (let i = 1; i < data.databulanan.length + 1; i++) {
        labels.push(i);
        datas.push({
          data: parseInt(data.databulanan[i - 1].total)
        });
      }
      const databulan = {
        labels,
        dataUnit: "Rp",
        lineTension: 0.1,
        datasets: [
          {
            label: "Sales Overview",
            color: "#9d72ff",
            background: NioApp.hexRGB("#9d72ff", 0.3),
            data: datas.map(function(data) {
              return data.data;
            })
          }
        ]
      };
      databulanan(".sales-overview-chart", databulan);
      const formattedNumber = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
      }).format(data.total_bulanan);
      document.getElementById("jumlahbulanan").innerHTML = formattedNumber;

      //data mingguan
      const datamingguan = [];
      for (let c = 1; c < data.datamingguan.length + 1; c++) {
        datamingguan.push({
          data: parseInt(data.datamingguan[c - 1].total)
        });
      }
      const dataminggu = {
       labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu"],
       dataUnit: 'USD',
       stacked: true,
       datasets: [{
         label: "Sales Revenue",
         color: [
            NioApp.hexRGB("#854fff", .2),
            "#854fff",
            NioApp.hexRGB("#854fff", .2),
            NioApp.hexRGB("#854fff", .2),
            NioApp.hexRGB("#854fff", .2),
            NioApp.hexRGB("#854fff", .2),
            NioApp.hexRGB("#854fff", .2)],
         
         data: datamingguan.map(function(data) {
              return data.data;
            })
       }]
      };
      salesBarChart('.sales-bar-chart',dataminggu);
    },
    error: function(error) {
    }
  });
}
  penjualanbulanan();
  //penjualan bulanan
  function databulanan(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-overview-chart');
    $selector.each(function () {
      var $self = $(this),
      _self_id = $self.attr('id'),
      _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          tension: _get_data.lineTension,
          backgroundColor: _get_data.datasets[i].background,
          borderWidth: 2,
          borderColor: _get_data.datasets[i].color,
          pointBorderColor: "transparent",
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: _get_data.datasets[i].color,
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBorderWidth: 2,
          pointRadius: 3,
          pointHitRadius: 3,
          data: _get_data.datasets[i].data
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'line',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            rtl: NioApp.State.isRTL,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
              },
              label: function label(tooltipItem, data) {
                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
              }
            },
            backgroundColor: '#1c2b46',
            titleFontSize: 13,
            titleFontColor: '#fff',
            titleMarginBottom: 6,
            bodyFontColor: '#fff',
            bodyFontSize: 12,
            bodySpacing: 4,
            yPadding: 10,
            xPadding: 10,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              position: NioApp.State.isRTL ? "right" : "left",
              ticks: {
                beginAtZero: true,
                fontSize: 11,
                fontColor: '#9eaecf',
                padding: 10,
                callback: function callback(value, index, values) {
                  return 'Rp.' + value;
                },
                min: 100,
                stepSize: 3000
              },
              gridLines: {
                color: NioApp.hexRGB("#526484", .2),
                tickMarkLength: 0,
                zeroLineColor: NioApp.hexRGB("#526484", .2)
              }
            }],
            xAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                fontSize: 9,
                fontColor: '#9eaecf',
                source: 'auto',
                padding: 10,
                reverse: NioApp.State.isRTL
              },
              gridLines: {
                color: "transparent",
                tickMarkLength: 0,
                zeroLineColor: 'transparent'
              }
            }]
          }
        }
      });
    });
  }

 //penjualan mingguan
  function salesBarChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-bar-chart');
    $selector.each(function () {
      var $self = $(this),
      _self_id = $self.attr('id'),
      _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
      _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          data: _get_data.datasets[i].data,
          // Styles
          backgroundColor: _get_data.datasets[i].color,
          borderWidth: 2,
          borderColor: 'transparent',
          hoverBorderColor: 'transparent',
          borderSkipped: 'bottom',
          barPercentage: .7,
          categoryPercentage: .7
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'bar',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            rtl: NioApp.State.isRTL,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return false;
              },
              label: function label(tooltipItem, data) {
                return data['labels'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
              }
            },
            backgroundColor: '#1c2b46',
            titleFontSize: 11,
            titleFontColor: '#fff',
            titleMarginBottom: 4,
            bodyFontColor: '#fff',
            bodyFontSize: 10,
            bodySpacing: 3,
            yPadding: 8,
            xPadding: 8,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                beginAtZero: true
              }
            }],
            xAxes: [{
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                reverse: NioApp.State.isRTL
              }
            }]
          }
        }
      });
    });
  }
 // init chart
}(NioApp, jQuery);
