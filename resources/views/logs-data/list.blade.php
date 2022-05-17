{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Logs Data')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" charset="UTF-8" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" />
@endsection

{{-- Content --}}
@section('content')
<div class="page-header">
    <ul>
        <li>Logs Data</li>
    </ul>
</div>

<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                <thead>
                    <tr class="text-left">
                        <!-- <th class="pl-0" style="width: 20px">
                            <label class="checkbox checkbox-lg checkbox-single">
                                <input type="checkbox" value="1" />
                                <span></span>
                            </label>
                        </th> -->
                        <th class="pr-0" style="width: 50px">ID</th>
                        <th style="min-width: 150px">Note</th>
                        <th style="min-width: 150px">Download</th>
                        <!-- <th style="min-width: 150px">Status</th> -->
                        <th class="pr-0 " style="min-width: 150px">Resolved</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs_data as $item)
                    <tr class="{{($item->id) % 2 == 0 ? 'even' : 'odd'}}">
                        <td class="pl-0">
                                <a href="#" id="company_name" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$item->id}}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#" id="team_name"
                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$item->note}}</a>
                        </td>
                        <td>
                            <div class="download-json" data-id="{{$item->id}}" style="cursor: pointer;">
                                <a href="/superadmin/logs/export-json/{{$item->id}}">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Download.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="1" width="2" height="14" rx="1"/>
                                            <path d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999) "/>
                                        </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>

                        </td>
                        <td class="pl-0 py-7">
                            <label class="checkbox checkbox-lg checkbox-single">
                                <input class="resolved-checkbox" type="checkbox" value="{{$item->id}}" {{$item->resolved ? 'checked' : ''}} />
                                <span></span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalPage != 1)
                <!--begin::Pagination-->
                <div class="d-flex justify-content-between align-items-center flex-wrap" style="float:right">
                    <div class="d-flex flex-wrap py-2 mr-3">
                        <a href="{{$currUrl}}?page=1" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                            <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                        </a>
                        @if ($currPage > 1)
                            <a href="{{$currUrl}}?page={{$previousPage}}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                                <i class="ki ki-bold-arrow-back icon-xs"></i>
                            </a>
                        @endif
                        @foreach ($listPages as $page)
                            <a href="{{$currUrl}}?page={{$page}}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1 {{$page == $currPage ? 'btn-hover-primary active' : ''}}">{{$page}}</a>
                        @endforeach
                        @if ($currPage < $totalPage)
                            <a href="{{$currUrl}}?page={{$nextPage}}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                                <i class="ki ki-bold-arrow-next icon-xs"></i>
                            </a>
                        @endif
                        <a href="{{$currUrl}}?page={{$totalPage}}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
                            <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                        </a>
                    </div>

                </div>
                <!--end:: Pagination-->
            @endif

        </div>
        <!--end::Table-->
    </div>
</div>

@endsection
{{-- Styles Section --}}
@section('styles')
@endsection
{{-- Scripts Section --}}
@section('scripts')
{{-- page scripts --}}
<script src="{{asset('js/pages/custom/user/edit-user.js')}}"></script>
<script src="{{asset('js/pages/widgets.js')}}"></script>
<script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function() {
        $(".resolved-checkbox").click(function(e) {
            console.log($(this));
            var _this = this
            var log_id = $(this).val();
            if(this.checked) {
                checkResolved(log_id);
            }else{
                e.preventDefault();
                swal.fire({
                    title: "Are you sure?",
                    text: "Lỗi này đã sửa xong rồi mà :< ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Uncheck",
                    cancelButtonText: "Cancel",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        swal.fire(
                            "Unchecked!",
                            "",
                            "success"
                        )
                        checkResolved(log_id, () => {
                            _this.checked = false
                        })
                    } else if (result.dismiss === "cancel") {
                        swal.fire(
                            "Đã huỷ",
                            ":)",
                            "error"
                        )
                    }
                });
            }

        });
        function checkResolved(log_id, onSuccess, onError){
            $response = $.post(
                '/superadmin/logs/update-resolved-status',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    data: log_id
                }
            );
            $response.done(function (res) {
                if (onSuccess) onSuccess(res)
                console.log(res);
            })
            $response.fail(function (res) {
                if (onError) onError(res)
                console.log('fail', res);
            })
        }
    })
</script>
@endsection
