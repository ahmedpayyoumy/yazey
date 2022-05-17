
var KTDatatablesDataSourceHtml = function () {
    var initTable1 = function initTable1() {
        var table = $('#kt_datatable');
        table.DataTable({
            responsive: true,
            bLengthChange: false,
            bFilter: false,
            columnDefs: [{
                width: '75px',
                targets: 4,
                render: function render(data, type, full, meta) {
                    var status = {
                        1: {
                            'title': 'Active',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Deactive',
                            'class': ' label-light-danger'
                        }
                    };

                    if (typeof status[data] === 'undefined') {
                        return data;
                    }
                    return '<span class="label label-lg font-weight-bold' + status[data]["class"] + ' label-inline">' + status[data].title + '</span>';
                }
            },]
        });
    };

    var initTableMediaCategory = function initTableMediaCategory() {
        var table = $('#kt_mediaCategory'); // begin first table
        table.DataTable({
            responsive: true,
            bLengthChange: false,
            bFilter: false,
            columnDefs: [{
                width: '75px',
                targets: 2,
                render: function render(data, type, full, meta) {
                    var status = {
                        1: {
                            'title': 'Active',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Deactive',
                            'class': ' label-light-danger'
                        }
                    };

                    if (typeof status[data] === 'undefined') {
                        return data;
                    }

                    return '<span class="label label-lg font-weight-bold' + status[data]["class"] + ' label-inline">' + status[data].title + '</span>';
                }
            },]
        });
    };

    var initTableMedia = function initTableMedia() {
        var table = $('#kt_media');
        table.DataTable({
            responsive: true,
            bLengthChange: false,
            bFilter: false,
            columnDefs: []
        });
    };

    var subTableInit = function(e) {
        $('<div/>').attr('id', 'child_data_local_' + e.data.RecordID).appendTo(e.detailCell).DataTable({

        })
    }

    var initTableContact = function initTableContact() {
        var table = $('#kt_contact'); // begin first table

        table.DataTable({
            responsive: true,
            columnDefs:[
                { targets: 6, visible: false}
            ],
            detail: {
                title: 'Load sub table',
                content: subTableInit,
            }
        });
    };

    var initTableContactForm = function initTableContactForm() {
        var table = $('#kt_contactForm'); // begin first table

        table.DataTable({
            responsive: true,
            columnDefs: [{
                width: '75px',
                bLengthChange: false,
                bFilter: false,
                targets: 4,
                render: function render(data, type, full, meta) {
                    var status = {
                        1: {
                            'title': 'Answered',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Not answered',
                            'class': ' label-light-danger'
                        }
                    };

                    if (typeof status[data] === 'undefined') {
                        return data;
                    }

                    return '<span class="label label-lg font-weight-bold' + status[data]["class"] + ' label-inline">' + status[data].title + '</span>';
                }
            },]
        });
    };

    return {
        //main function to initiate the module
        init: function init() {
            initTable1();
            initTableMediaCategory();
            initTableMedia();
            initTableContact();
            initTableContactForm();
        }
    };
}();

jQuery(document).ready(function () {
    KTDatatablesDataSourceHtml.init();
});
