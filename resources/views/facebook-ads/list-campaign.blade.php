@extends('layout.default')

@section('styles')
@section('title', 'List Campaign')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<style>
.warehouse__action {
    margin-right: 7px;
}
.fanpage_logo {
    border-radius: 4px;
    box-shadow: 0 0.5px 1.5px 0.5px rgb(0 0 0 / 10%);
    margin-right: 5px;
}
</style>
@endsection

@section('content')

<div class="page-body"  >
    
    <div id="cdp__custom__table" style="margin-bottom: 50px">
        <div class="panel">
            <div class="card card-custom list-panel">
                <table class="table table-bordered table-hover" id="kt_datatable">
                    <thead>
                        <tr>
                            <th style="width: 20%;">#</th>
                            <th>Name</th>
                            <th>Objective</th>
                            <th>Status</th>
                            <th>Created time</th>
                            <!-- <th>Start time</th> -->
                            <!-- <th>Stop time</th> -->
                            <th width="180px">thao tác</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

<script>
    var table = $('#kt_datatable');
    // begin first table
    table.DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        searching: false,
        dom: `<'row'<'col-sm-12'tr>>
        <'dataTables_pager'lp>`,
        lengthChange: false,
        info: false,
        pageLength: 20,
        ordering: false,
        order: [0, 'desc'],
        pagingType: "full_numbers",
        ajax: {
            'url': "{{ route('facebook-ads.getDataCampaigns', ['id' => $accountId]) }}",
        },
        columns: [
            { data: 'campaign_id', name: 'campaign_id' },
            { data: 'name', name: 'name' },
            { data: 'objective', name: 'objective' },
            { data: 'status', name: 'status' },
            { data: 'created_time', name: 'created_time' },
            // { data: 'start_time', name: 'start_time' },
            // { data: 'stop_time', name: 'stop_time' },
            { data: 'actions', name: 'actions' },
        ],
        oLanguage: {
            'sEmptyTable':`<div class="block-empty">
                                <div>
                                    <div class="image" style="margin-bottom: 24px;">
                                        <img src="{{ asset('/images/settings/empty1.png') }}" width="347px" alt="">
                                    </div>
                                    <div class="text__opacity mt__24">
                                        No Campaign
                                    </div>
                                </div>
                            </div>`,
        },

    });
</script>

<script>
    $(document).ready(function() {
        $(document).on("click", ".btn-delete", function(e) {
            e.preventDefault();
            let href = $(this).attr('href')
            swal.fire({
                title: "Are you sure?",
                text: "This operation will not be unrecoverable ",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    swal.fire(
                        "Deleted!",
                        "",
                        "success"
                    )
                    window.location.href = href
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Cancelled",
                        ":)",
                        "error"
                    )
                }
            });
        });
    })
</script>
@endsection
