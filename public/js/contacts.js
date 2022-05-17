'use strict';
// Class definition
var KTDatatableChildDataLocalDemo = function() {
    // Private functions

    var subTableInit = function(e) {
        $('<div/>').attr('id', 'child_data_local_' + e.data.RecordID).appendTo(e.detailCell).KTDatatable({
            data: {
                type: 'local',
                source: e.data.contact_form,
            },
            paging: false,
            pagination: false,

            // layout definition
            layout: {
                scroll: true,
                height: 400,
                footer: false,
            },

            sortable: true,

            // columns definition
            columns: [{
                field: 'subject',
                title: 'Subject'
            }, {
                field: 'is_reply',
                title: 'Status',
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        1: { 'title': 'Answered', 'class': ' label-light-success' },
                        0: { 'title': 'Not Answered', 'class': ' label-light-danger' },
                    };
                    return '<span class="label ' + status[row.is_reply].class + ' label-inline font-weight-bold label-lg">' + status[row.is_reply].title + '</span>';
                },
            }, {
                field: 'Actions',
                width: 130,
                title: 'Actions',
                sortable: false,
                overflow: 'visible',
                template: function(row) {
                    return '\
                        		<a href="' + APP_URL + '/contact-form/' + row.id + '/reply" class="btn btn-sm btn-clean btn-icon mr-2">\
									<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Reply.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
										<rect x="0" y="0" width="24" height="24"/>\
										<path d="M21.4451171,17.7910156 C21.4451171,16.9707031 21.6208984,13.7333984 19.0671874,11.1650391 C17.3484374,9.43652344 14.7761718,9.13671875 11.6999999,9 L11.6999999,4.69307548 C11.6999999,4.27886191 11.3642135,3.94307548 10.9499999,3.94307548 C10.7636897,3.94307548 10.584049,4.01242035 10.4460626,4.13760526 L3.30599678,10.6152626 C2.99921905,10.8935795 2.976147,11.3678924 3.2544639,11.6746702 C3.26907199,11.6907721 3.28437331,11.7062312 3.30032452,11.7210037 L10.4403903,18.333467 C10.7442966,18.6149166 11.2188212,18.596712 11.5002708,18.2928057 C11.628669,18.1541628 11.6999999,17.9721616 11.6999999,17.7831961 L11.6999999,13.5 C13.6531249,13.5537109 15.0443703,13.6779456 16.3083984,14.0800781 C18.1284272,14.6590944 19.5349747,16.3018455 20.5280411,19.0083314 L20.5280247,19.0083374 C20.6363903,19.3036749 20.9175496,19.5 21.2321404,19.5 L21.4499999,19.5 C21.4499999,19.0068359 21.4451171,18.2255859 21.4451171,17.7910156 Z" fill="#000000" fill-rule="nonzero"/>\
									</g>\
									</svg><!--end::Svg Icon-->\
									</span>\
	                            </a>\
	                    ';
                },
            }],
        });
    };

    // demo initializer
    var mainTableInit = function() {

        var dataJSONArray = contactData;
        var datatable = $('#kt_contact').KTDatatable({
            // datasource definition
            data: {
                type: 'local',
                source: dataJSONArray,
                pageSize: 10, // display 20 records per page
            },

            // layout definition
            layout: {
                scroll: false,
                height: null,
                footer: false,
            },

            sortable: true,

            filterable: false,

            pagination: true,

            detail: {
                title: 'Load sub table',
                content: subTableInit,
            },

            search: {
                input: $('#kt_contact_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: '',
                sortable: false,
                width: 30,
                textAlign: 'center',
            }, {
                field: 'name',
                title: 'Name',
            }, {
                field: 'email',
                title: 'Email',
            }, {
                field: 'phone_number',
                title: 'Phone Number',
            }, {
                field: '',
                width: 130,
                title: 'Is All Answered?',
                sortable: false,
                overflow: 'visible',
                template: function(row) {
                    var status = {
                        1: { 'title': 'All Answered', 'class': ' label-light-success' },
                        0: { 'title': 'Has Not Answered', 'class': ' label-light-danger' },
                    };
                    let obj = row.contact_form.find(o => o.is_reply === 0);
                    if (obj) {
                        return '<span class="label ' + status[0].class + ' label-inline font-weight-bold label-lg">' + status[0].title + '</span>';
                    } else {
                        return '<span class="label ' + status[1].class + ' label-inline font-weight-bold label-lg">' + status[1].title + '</span>';
                    }
                },
            }, {
                field: 'Actions',
                width: 130,
                title: 'Actions',
                sortable: false,
                overflow: 'visible',
                template: function(row) {
                    return '\
                        <form method="POST" class="form__delete" action="' + APP_URL + '/contacts/' + row.id + '">\
                            <input type="hidden" name="_method" value="DELETE">\
                            <input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">\
                            <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Delete">\
                                <span class="svg-icon svg-icon-md">\
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                            <rect x="0" y="0" width="24" height="24"/>\
                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                        </g>\
                                    </svg>\
                                </span>\
                            </button>\
                        </form>\
	                    ';
                },
            }],
        });
    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            mainTableInit();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableChildDataLocalDemo.init();
});