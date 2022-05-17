'use strict';
// Class definition
var KTDatatableChildGA = function() {
    // demo initializer
    var mainTableInit = function() {

        var dataJSONArray = ggAnalyticsData;
        // console.log("🚀 ~ file: google-analytics.js ~ line 8 ~ mainTableInit ~ dataJSONArray", dataJSONArray)

        var datatable = $('#google_analytics_accounts').KTDatatable({
            // datasource definition
            data: {
                type: 'local',
                source: dataJSONArray,
                pageSize: 25, // display 20 records per page
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
            search: {
                input: $('#kt_contact_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                    field: 'id',
                    title: 'id',
                    sortable: false,
                    width: 30,
                    overflow: 'visible',
                    textAlign: 'center',
                },
                {
                    field: '',
                    width: '500',
                    title: 'Google analytics',
                    sortable: false,
                    overflow: 'visible',
                    template: function(row) {
                        return `<div class="flex__avt">
                                    <div class="text__avt">
                                        ${row.name}
                                    </div>
                                </div>`;
                    },
                },
                // {
                //     field: 'Actions',
                //     width: 130,
                //     title: 'Actions',
                //     sortable: false,
                //     overflow: 'visible',
                //     template: function(row) {
                //         return '\
                //         <a href="/google-analytics/accounts/detail/'+ row.id +'">\
                //             <button type="button" class="btn btn-sm btn-success btn-icon" title="Edit">\
                //                 <span class="svg-icon svg-icon-md">\
                //                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                //                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                //                             <rect x="0" y="0" width="24" height="24"/>\
                //                             <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                //                             <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                //                         </g>\
                //                     </svg>\
                //                 </span>\
                //             </button>\
                //         </a>\
                //         <a href="/google-analytics/accounts/delete/'+ row.id +'">\
                //             <button type="button" class="btn btn-sm btn-danger btn-icon" title="Delete">\
                //                 <span class="svg-icon svg-icon-md">\
                //                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                //                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                //                             <rect x="0" y="0" width="24" height="24"/>\
                //                             <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                //                             <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                //                         </g>\
                //                     </svg>\
                //                 </span>\
                //             </button>\
                //         </a>\
	            //         ';
                //     },
                // }
            ],
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

var KTDatatableChildWebsite = function() {
    // demo initializer
    var mainTableInit = function() {

        var dataJSONArray = websiteData;
        // console.log("🚀 ~ file: google-analytics.js ~ line 8 ~ mainTableInit ~ dataJSONArray", dataJSONArray)

        var datatable = $('#website_url').KTDatatable({
            // datasource definition
            data: {
                type: 'local',
                source: dataJSONArray,
                pageSize: 25, // display 20 records per page
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
            search: {
                input: $('#kt_contact_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                    field: '',
                    width: 10,
                    title: '',
                    sortable: false,
                    overflow: 'visible',
                    textAlign: 'center',
                    template: function(row) {
                        return `<label class="radio" style="left: 50%;margin-bottom: 14px; padding-left: 0">
    								<input type="radio" name="select_website_url" value="${row.view_id}" ${row.is_selected ? "checked" : ""}>
    								<span></span></label>`;
                    },
                },{
                    field: 'id',
                    title: 'id',
                    sortable: false,
                    width: 30,
                    overflow: 'visible',
                    textAlign: 'center',
                },
                {
                    field: 'website_url',
                    width: '500',
                    title: 'Website Url',
                    sortable: false,
                    overflow: 'visible',
                    template: function(row) {
                        return `<div class="flex__avt">
                                    <div class="text__avt">
                                        ${row.website_url}
                                    </div>
                                </div>`;
                    },
                }
            ],
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

    KTDatatableChildGA.init();
    KTDatatableChildWebsite.init();
});
