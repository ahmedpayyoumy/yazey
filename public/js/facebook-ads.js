'use strict';
// Class definition
var KTDatatableChildDataFacebookAds = function() {
    // demo initializer
    var mainTableInit = function() {

        var dataJSONArray = accounts;

        var datatable = $('#facebook-ads-table').KTDatatable({
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
            search: {
                input: $('#kt_contact_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                    field: 'social_id',
                    title: 'Ads Account ID',
                    sortable: false,
                    // width: 100,
                    overflow: 'visible',
                    textAlign: 'center',
                },
                {
                    field: '',
                    // width: 30,
                    title: 'Name',
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
                {
                    field: 'Actions',
                    // width: 130,
                    title: 'Actions',
                    sortable: false,
                    overflow: 'visible',
                    template: function(row) {
                        return '\
                                    <span class="text__edit warehouse__action"><a href="/facebook-ads/accounts/'+ row.id +'/campaigns" class="">\
                                        Detail\
                                    </a></span>\
                                    <span class="text__delete warehouse__action"><a href="/facebook-ads/accounts/delete/'+ row.id +'" class="btn-delete">\
                                        Delete\
                                    </a></span>\
	                    ';
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

    KTDatatableChildDataFacebookAds.init();
});
