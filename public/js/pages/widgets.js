/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 860);
/******/ })
/************************************************************************/
/******/ ({

/***/ 860:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(861);


/***/ }),

/***/ 861:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTWidgets = function () {
  // Private properties
  // Private functions
  // General Controls
  var _initDaterangepicker = function _initDaterangepicker() {
    if ($('#kt_dashboard_daterangepicker').length == 0) {
      return;
    }

    var picker = $('#kt_dashboard_daterangepicker');
    var start = moment();
    var end = moment();

    function cb(start, end, label) {
      var title = '';
      var range = '';

      if (end - start < 100 || label == 'Today') {
        title = 'Today:';
        range = start.format('MMM D');
      } else if (label == 'Yesterday') {
        title = 'Yesterday:';
        range = start.format('MMM D');
      } else {
        range = start.format('MMM D') + ' - ' + end.format('MMM D');
      }

      $('#kt_dashboard_daterangepicker_date').html(range);
      $('#kt_dashboard_daterangepicker_title').html(title);
    }

    picker.daterangepicker({
      direction: KTUtil.isRTL(),
      startDate: start,
      endDate: end,
      opens: 'left',
      applyClass: 'btn-primary',
      cancelClass: 'btn-light-primary',
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);
    cb(start, end, '');
  }; // Stats widgets


  var _initStatsWidget7 = function _initStatsWidget7() {
    var element = document.getElementById("kt_stats_widget_7_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 45, 32, 70, 40]
      }],
      chart: {
        type: 'area',
        height: 150,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['success']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['success']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initStatsWidget8 = function _initStatsWidget8() {
    var element = document.getElementById("kt_stats_widget_8_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 45, 32, 70, 40]
      }],
      chart: {
        type: 'area',
        height: 150,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['danger']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['danger']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initStatsWidget9 = function _initStatsWidget9() {
    var element = document.getElementById("kt_stats_widget_9_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 45, 32, 70, 40]
      }],
      chart: {
        type: 'area',
        height: 150,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['primary']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['primary']],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['primary']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['primary']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initStatsWidget10 = function _initStatsWidget10() {
    var element = document.getElementById("kt_stats_widget_10_chart");
    var height = parseInt(KTUtil.css(element, 'height'));
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'info';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [40, 40, 30, 30, 35, 35, 50]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 55,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initStatsWidget11 = function _initStatsWidget11() {
    var element = document.getElementById("kt_stats_widget_11_chart");
    var height = parseInt(KTUtil.css(element, 'height'));
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'success';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [40, 40, 30, 30, 35, 35, 50]
      }],
      chart: {
        type: 'area',
        height: 150,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Aug', 'Sep'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 55,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initStatsWidget12 = function _initStatsWidget12() {
    var element = document.getElementById("kt_stats_widget_12_chart");
    var height = parseInt(KTUtil.css(element, 'height'));
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'primary';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [40, 40, 30, 30, 35, 35, 50]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Aug', 'Sep'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 55,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  }; // Charts widgets


  var _initChartsWidget1 = function _initChartsWidget1() {
    var element = document.getElementById("kt_charts_widget_1_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58]
      }, {
        name: 'Revenue',
        data: [76, 85, 101, 98, 87, 105]
      }],
      chart: {
        type: 'bar',
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['30%'],
          endingShape: 'rounded'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        opacity: 1
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget2 = function _initChartsWidget2() {
    var element = document.getElementById("kt_charts_widget_2_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58]
      }, {
        name: 'Revenue',
        data: [76, 85, 101, 98, 87, 105]
      }],
      chart: {
        type: 'bar',
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['30%'],
          endingShape: 'rounded'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        opacity: 1
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['warning'], KTApp.getSettings()['colors']['gray']['gray-300']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget3 = function _initChartsWidget3() {
    var element = document.getElementById("kt_charts_widget_3_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 40, 40, 90, 90, 70, 70]
      }],
      chart: {
        type: 'area',
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['info']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['theme']['base']['info'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      },
      markers: {
        //size: 5,
        //colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
        strokeColor: KTApp.getSettings()['colors']['theme']['base']['info'],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget4 = function _initChartsWidget4() {
    var element = document.getElementById("kt_charts_widget_4_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [60, 50, 80, 40, 100, 60]
      }, {
        name: 'Revenue',
        data: [70, 60, 110, 40, 50, 70]
      }],
      chart: {
        type: 'area',
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['theme']['light']['success'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['theme']['base']['warning']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      },
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['success'], KTApp.getSettings()['colors']['theme']['light']['warning']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['light']['success'], KTApp.getSettings()['colors']['theme']['light']['warning']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget5 = function _initChartsWidget5() {
    var element = document.getElementById("kt_charts_widget_5_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [40, 50, 65, 70, 50, 30]
      }, {
        name: 'Revenue',
        data: [-30, -40, -55, -60, -40, -20]
      }],
      chart: {
        type: 'bar',
        stacked: true,
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['12%'],
          endingShape: 'rounded'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: -80,
        max: 80,
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        opacity: 1
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['info'], KTApp.getSettings()['colors']['theme']['base']['primary']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget6 = function _initChartsWidget6() {
    var element = document.getElementById("kt_charts_widget_6_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        type: 'bar',
        stacked: true,
        data: [40, 50, 65, 70, 50, 30]
      }, {
        name: 'Revenue',
        type: 'bar',
        stacked: true,
        data: [20, 20, 25, 30, 30, 20]
      }, {
        name: 'Expenses',
        type: 'area',
        data: [50, 80, 60, 90, 50, 70]
      }],
      chart: {
        stacked: true,
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          stacked: true,
          horizontal: false,
          endingShape: 'rounded',
          columnWidth: ['12%']
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        max: 120,
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        opacity: 1
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['info'], KTApp.getSettings()['colors']['theme']['base']['primary'], KTApp.getSettings()['colors']['theme']['light']['primary']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        },
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget7 = function _initChartsWidget7() {
    var element = document.getElementById("kt_charts_widget_7_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 30, 50, 50, 35, 35]
      }, {
        name: 'Revenue',
        data: [55, 20, 20, 20, 70, 70]
      }, {
        name: 'Expenses',
        data: [60, 60, 40, 40, 30, 30]
      }],
      chart: {
        type: 'area',
        height: 300,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 2,
        colors: [KTApp.getSettings()['colors']['theme']['base']['warning'], 'transparent', 'transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['warning'], KTApp.getSettings()['colors']['theme']['light']['info'], KTApp.getSettings()['colors']['gray']['gray-100']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      },
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['warning'], KTApp.getSettings()['colors']['theme']['light']['info'], KTApp.getSettings()['colors']['gray']['gray-100']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['warning'], KTApp.getSettings()['colors']['theme']['base']['info'], KTApp.getSettings()['colors']['gray']['gray-500']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initChartsWidget8 = function _initChartsWidget8() {
    var element = document.getElementById("kt_charts_widget_8_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 30, 50, 50, 35, 35]
      }, {
        name: 'Revenue',
        data: [55, 20, 20, 20, 70, 70]
      }, {
        name: 'Expenses',
        data: [60, 60, 40, 40, 30, 30]
      }],
      chart: {
        type: 'area',
        height: 300,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 2,
        colors: ['transparent', 'transparent', 'transparent']
      },
      xaxis: {
        x: 0,
        offsetX: 0,
        offsetY: 0,
        padding: {
          left: 0,
          right: 0,
          top: 0
        },
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: {
          left: 0,
          right: 0
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['success'], KTApp.getSettings()['colors']['theme']['light']['danger'], KTApp.getSettings()['colors']['theme']['light']['info']],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        padding: {
          top: 0,
          bottom: 0,
          left: 0,
          right: 0
        }
      },
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['success'], KTApp.getSettings()['colors']['theme']['light']['danger'], KTApp.getSettings()['colors']['theme']['light']['info']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['theme']['base']['danger'], KTApp.getSettings()['colors']['theme']['base']['info']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  }; // Mixed widgets


  var _initMixedWidget1 = function _initMixedWidget1() {
    var element = document.getElementById("kt_mixed_widget_1_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var strokeColor = '#D13647';
    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 45, 32, 70, 40, 40, 40]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        },
        dropShadow: {
          enabled: true,
          enabledOnSeries: undefined,
          top: 5,
          left: 0,
          blur: 3,
          color: strokeColor,
          opacity: 0.5
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 0
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [strokeColor]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        }
      },
      yaxis: {
        min: 0,
        max: 80,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['transparent'],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
        strokeColor: [strokeColor],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget2 = function _initMixedWidget2() {
    var element = document.getElementById("kt_mixed_widget_2_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var strokeColor = '#287ED7';
    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 45, 32, 70, 40, 40, 40]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        },
        dropShadow: {
          enabled: true,
          enabledOnSeries: undefined,
          top: 5,
          left: 0,
          blur: 3,
          color: strokeColor,
          opacity: 0.5
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 0
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [strokeColor]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 80,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['transparent'],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
        strokeColor: [strokeColor],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget3 = function _initMixedWidget3() {
    var element = document.getElementById("kt_mixed_widget_3_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var strokeColor = KTApp.getSettings()['colors']['theme']['base']['white'];
    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 45, 32, 70, 40, 40, 40]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        },
        dropShadow: {
          enabled: true,
          enabledOnSeries: undefined,
          top: 5,
          left: 0,
          blur: 3,
          color: strokeColor,
          opacity: 0.3
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 0
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [strokeColor]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 80,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['transparent'],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['dark']],
        strokeColor: [strokeColor],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget4 = function _initMixedWidget4() {
    var element = document.getElementById("kt_mixed_widget_4_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [35, 65, 75, 55, 45, 60, 55]
      }, {
        name: 'Revenue',
        data: [40, 70, 80, 60, 50, 65, 60]
      }],
      chart: {
        type: 'bar',
        height: height,
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['30%'],
          endingShape: 'rounded'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 1,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 100,
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        type: ['solid', 'solid'],
        opacity: [0.25, 1]
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['#ffffff', '#ffffff'],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        },
        padding: {
          left: 20,
          right: 20
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget5 = function _initMixedWidget5() {
    var element = document.getElementById("kt_mixed_widget_5_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [35, 65, 75, 55, 45, 60, 55]
      }, {
        name: 'Revenue',
        data: [40, 70, 80, 60, 50, 65, 60]
      }],
      chart: {
        type: 'bar',
        height: height,
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['30%'],
          endingShape: 'rounded'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 1,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 100,
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        type: ['solid', 'solid'],
        opacity: [0.25, 1]
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['#ffffff', '#ffffff'],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        },
        padding: {
          left: 20,
          right: 20
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget6 = function _initMixedWidget6() {
    var element = document.getElementById("kt_mixed_widget_6_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [35, 65, 75, 55, 45, 60, 55]
      }, {
        name: 'Revenue',
        data: [40, 70, 80, 60, 50, 65, 60]
      }],
      chart: {
        type: 'bar',
        height: height,
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['30%'],
          endingShape: 'rounded'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 1,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 100,
        labels: {
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      fill: {
        type: ['solid', 'solid'],
        opacity: [0.25, 1]
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['#ffffff', '#ffffff'],
      grid: {
        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        },
        padding: {
          left: 20,
          right: 20
        }
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget13 = function _initMixedWidget13() {
    var element = document.getElementById("kt_mixed_widget_13_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 25, 45, 30, 55, 55]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['info']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 60,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['info']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget14 = function _initMixedWidget14() {
    var element = document.getElementById("kt_mixed_widget_14_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [74],
      chart: {
        height: height,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          hollow: {
            margin: 0,
            size: "65%"
          },
          dataLabels: {
            showOn: "always",
            name: {
              show: false,
              fontWeight: '700'
            },
            value: {
              color: KTApp.getSettings()['colors']['gray']['gray-700'],
              fontSize: "30px",
              fontWeight: '700',
              offsetY: 12,
              show: true
            }
          },
          track: {
            background: KTApp.getSettings()['colors']['theme']['light']['success'],
            strokeWidth: '100%'
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['success']],
      stroke: {
        lineCap: "round"
      },
      labels: ["Progress"]
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget15 = function _initMixedWidget15() {
    var element = document.getElementById("kt_mixed_widget_15_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 30, 60, 25, 25, 40]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'gradient',
        opacity: 1,
        gradient: {
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.375,
          stops: [25, 50, 100],
          colorStops: []
        }
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['danger']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 65,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['danger']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget16 = function _initMixedWidget16() {
    var element = document.getElementById("kt_mixed_widget_16_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [60, 50, 75, 80],
      chart: {
        height: height,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          hollow: {
            margin: 0,
            size: "30%"
          },
          dataLabels: {
            showOn: "always",
            name: {
              show: false,
              fontWeight: "700"
            },
            value: {
              color: KTApp.getSettings()['colors']['gray']['gray-700'],
              fontSize: "18px",
              fontWeight: "700",
              offsetY: 10,
              show: true
            },
            total: {
              show: true,
              label: 'Total',
              fontWeight: "bold",
              formatter: function formatter(w) {
                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                return '60%';
              }
            }
          },
          track: {
            background: KTApp.getSettings()['colors']['gray']['gray-100'],
            strokeWidth: '100%'
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['info'], KTApp.getSettings()['colors']['theme']['base']['danger'], KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['theme']['base']['primary']],
      stroke: {
        lineCap: "round"
      },
      labels: ["Progress"]
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget17 = function _initMixedWidget17() {
    var element = document.getElementById("kt_mixed_widget_17_chart");
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'warning';
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [30, 25, 45, 30, 55, 55]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 60,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget18 = function _initMixedWidget18() {
    var element = document.getElementById("kt_mixed_widget_18_chart");
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [74],
      chart: {
        height: height,
        type: 'radialBar',
        offsetY: 0
      },
      plotOptions: {
        radialBar: {
          startAngle: -90,
          endAngle: 90,
          hollow: {
            margin: 0,
            size: "70%"
          },
          dataLabels: {
            showOn: "always",
            name: {
              show: true,
              fontSize: "13px",
              fontWeight: "700",
              offsetY: -5,
              color: KTApp.getSettings()['colors']['gray']['gray-500']
            },
            value: {
              color: KTApp.getSettings()['colors']['gray']['gray-700'],
              fontSize: "30px",
              fontWeight: "700",
              offsetY: -40,
              show: true
            }
          },
          track: {
            background: KTApp.getSettings()['colors']['theme']['light']['primary'],
            strokeWidth: '100%'
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['base']['primary']],
      stroke: {
        lineCap: "round"
      },
      labels: ["Progress"]
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  }; // Tiles


  var _initTilesWidget1 = function _initTilesWidget1() {
    var element = document.getElementById("kt_tiles_widget_1_chart");
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'primary';
    var height = parseInt(KTUtil.css(element, 'height'));

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [20, 22, 30, 28, 25, 26, 30, 28, 22, 24, 25, 35]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'gradient',
        opacity: 1,
        gradient: {
          type: "vertical",
          shadeIntensity: 0.55,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.2,
          stops: [25, 50, 100],
          colorStops: []
        }
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 37,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      },
      padding: {
        top: 0,
        bottom: 0
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initTilesWidget2 = function _initTilesWidget2() {
    var element = document.getElementById("kt_tiles_widget_2_chart");

    if (!element) {
      return;
    }

    var strokeColor = KTUtil.colorDarken(KTApp.getSettings()['colors']['theme']['base']['danger'], 20);
    var fillColor = KTUtil.colorDarken(KTApp.getSettings()['colors']['theme']['base']['danger'], 10);
    var options = {
      series: [{
        name: 'Net Profit',
        data: [10, 10, 20, 20, 12, 12]
      }],
      chart: {
        type: 'area',
        height: 75,
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        },
        padding: {
          top: 0,
          bottom: 0
        }
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [strokeColor]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        }
      },
      yaxis: {
        min: 0,
        max: 22,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function formatter(val) {
              return val + "";
            }
          }
        }
      },
      colors: [fillColor],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
        strokeColor: [strokeColor],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initTilesWidget5 = function _initTilesWidget5() {
    var element = document.getElementById("kt_tiles_widget_5_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [10, 15, 18, 14]
      }, {
        name: 'Revenue',
        data: [8, 13, 16, 12]
      }],
      chart: {
        type: 'bar',
        height: 75,
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        },
        padding: {
          left: 20,
          right: 20
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ['25%'],
          endingShape: 'rounded'
        }
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: ['solid', 'gradient'],
        opacity: 0.25
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May']
      },
      yaxis: {
        min: 0,
        max: 20
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function formatter(val) {
              return val + "";
            }
          }
        },
        marker: {
          show: false
        }
      },
      colors: ['#ffffff', '#ffffff']
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initTilesWidget8 = function _initTilesWidget8() {
    var element = document.getElementById("kt_tiles_widget_8_chart");
    var height = parseInt(KTUtil.css(element, 'height'));
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'danger';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [20, 20, 30, 15, 40, 30]
      }],
      chart: {
        type: 'area',
        height: 150,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid'
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 45,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      },
      padding: {
        top: 0,
        bottom: 0
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initTilesWidget17 = function _initTilesWidget17() {
    var element = document.getElementById("kt_tiles_widget_17_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [10, 20, 20, 8]
      }],
      chart: {
        type: 'area',
        height: 150,
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        },
        padding: {
          top: 0,
          bottom: 0
        }
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base']['success']]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        }
      },
      yaxis: {
        min: 0,
        max: 22,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function formatter(val) {
              return val + "";
            }
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base']['success']],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initTilesWidget20 = function _initTilesWidget20() {
    var element = document.getElementById("kt_tiles_widget_20_chart");

    if (!element) {
      return;
    }

    var options = {
      series: [74],
      chart: {
        height: 250,
        type: 'radialBar',
        offsetY: 0
      },
      plotOptions: {
        radialBar: {
          startAngle: -90,
          endAngle: 90,
          hollow: {
            margin: 0,
            size: "70%"
          },
          dataLabels: {
            showOn: "always",
            name: {
              show: true,
              fontSize: "13px",
              fontWeight: "400",
              offsetY: -5,
              color: KTApp.getSettings()['colors']['gray']['gray-300']
            },
            value: {
              color: KTApp.getSettings()['colors']['theme']['inverse']['primary'],
              fontSize: "22px",
              fontWeight: "bold",
              offsetY: -40,
              show: true
            }
          },
          track: {
            background: KTUtil.colorLighten(KTApp.getSettings()['colors']['theme']['base']['primary'], 7),
            strokeWidth: '100%'
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['inverse']['primary']],
      stroke: {
        lineCap: "round"
      },
      labels: ["Progress"]
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget21 = function _initMixedWidget21() {
    var element = document.getElementById("kt_tiles_widget_21_chart");
    var height = parseInt(KTUtil.css(element, 'height'));
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'info';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [20, 20, 30, 15, 30, 30]
      }],
      chart: {
        type: 'area',
        height: height,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 32,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initMixedWidget23 = function _initMixedWidget23() {
    var element = document.getElementById("kt_tiles_widget_23_chart");
    var height = parseInt(KTUtil.css(element, 'height'));
    var color = KTUtil.hasAttr(element, 'data-color') ? KTUtil.attr(element, 'data-color') : 'primary';

    if (!element) {
      return;
    }

    var options = {
      series: [{
        name: 'Net Profit',
        data: [15, 25, 15, 40, 20, 50]
      }],
      chart: {
        type: 'area',
        height: 125,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: 'solid',
        opacity: 1
      },
      stroke: {
        curve: 'smooth',
        show: true,
        width: 3,
        colors: [KTApp.getSettings()['colors']['theme']['base'][color]]
      },
      xaxis: {
        categories: ['Jan, 2020', 'Feb, 2020', 'Mar, 2020', 'Apr, 2020', 'May, 2020', 'Jun, 2020'],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        },
        crosshairs: {
          show: false,
          position: 'front',
          stroke: {
            color: KTApp.getSettings()['colors']['gray']['gray-300'],
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: true,
          formatter: undefined,
          offsetY: 0,
          style: {
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      yaxis: {
        min: 0,
        max: 55,
        labels: {
          show: false,
          style: {
            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
            fontSize: '12px',
            fontFamily: KTApp.getSettings()['font-family']
          }
        }
      },
      states: {
        normal: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        hover: {
          filter: {
            type: 'none',
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: 'none',
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: '12px',
          fontFamily: KTApp.getSettings()['font-family']
        },
        y: {
          formatter: function formatter(val) {
            return "$" + val + " thousands";
          }
        }
      },
      colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
      markers: {
        colors: [KTApp.getSettings()['colors']['theme']['light'][color]],
        strokeColor: [KTApp.getSettings()['colors']['theme']['base'][color]],
        strokeWidth: 3
      }
    };
    var chart = new ApexCharts(element, options);
    chart.render();
  };

  var _initAdvancedTableGroupSelection = function _initAdvancedTableGroupSelection(element) {
    var table = KTUtil.getById(element);
    KTUtil.on(table, 'thead th .checkbox > input', 'change', function (e) {
      var checkboxes = KTUtil.findAll(table, 'tbody td .checkbox > input');

      for (var i = 0, len = checkboxes.length; i < len; i++) {
        checkboxes[i].checked = this.checked;
      }
    });
  }; // Public methods


  return {
    init: function init() {
      // General Controls
      _initDaterangepicker(); // Stats Widgets


      _initStatsWidget7();

      _initStatsWidget8();

      _initStatsWidget9();

      _initStatsWidget10();

      _initStatsWidget11();

      _initStatsWidget12(); // Charts Widgets


      _initChartsWidget1();

      _initChartsWidget2();

      _initChartsWidget3();

      _initChartsWidget4();

      _initChartsWidget5();

      _initChartsWidget6();

      _initChartsWidget7();

      _initChartsWidget8(); // Mixed Widgets


      _initMixedWidget1();

      _initMixedWidget2();

      _initMixedWidget3();

      _initMixedWidget4();

      _initMixedWidget5();

      _initMixedWidget6();

      _initMixedWidget13();

      _initMixedWidget14();

      _initMixedWidget15();

      _initMixedWidget16();

      _initMixedWidget17();

      _initMixedWidget18(); // Tiles Widgets


      _initTilesWidget1();

      _initTilesWidget2();

      _initTilesWidget5();

      _initTilesWidget8();

      _initTilesWidget17();

      _initTilesWidget20();

      _initMixedWidget21();

      _initMixedWidget23(); // Table Widgets


      _initAdvancedTableGroupSelection('kt_advance_table_widget_1');

      _initAdvancedTableGroupSelection('kt_advance_table_widget_2');

      _initAdvancedTableGroupSelection('kt_advance_table_widget_3');

      _initAdvancedTableGroupSelection('kt_advance_table_widget_4');
    }
  };
}(); // Webpack support


if (true) {
  module.exports = KTWidgets;
}

jQuery(document).ready(function () {
  KTWidgets.init();
});

/***/ })

/******/ });