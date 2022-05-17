<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-body">
                    <form action="{{ route('facebook-ads.select-page') }}" method="POST">
                        @csrf
                        <table class="table table-bordered table-hover table-checkable" id="facebook-pages-table" style="margin-top: 13px !important">
                           {{-- Extends layout --}}
                        </table>
                        <br />
                        @if (!$isDisabledSelectBtn)
                            <button type="submit" class="btn btn-primary" style="float:right">Select page</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script type="text/javascript">
    var pages = JSON.parse('{!! json_encode($pages) !!}');
</script>
<script src="{{ asset('js/facebook.js') }} "></script>
<!-- <script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script> -->
<script>
    // $(document).ready(function(){
    //     $(document).on('click','#facebook-pages-table .form__delete',function(e){
    //         let that = $(this);
    //         e.preventDefault();
    //         swal.fire({
    //             title: "Are you sure?",
    //             text: "This operation will not be unrecoverable",
    //             type: "warning",
    //             showCancelButton: true,
    //             confirmButtonText: "Delete",
    //             cancelButtonText: "Cancel",
    //             reverseButtons: true
    //         }).then(function(result) {
    //             if (result.value) {
    //                 swal.fire(
    //                     "Deleted!",
    //                     "",
    //                     "success"
    //                 )
    //                 window.location.href = that.attr('href');
    //             } else if (result.dismiss === "cancel") {
    //                 swal.fire(
    //                     "Cancelled",
    //                     ":)",
    //                     "error"
    //                 )
    //                 return false;
    //             }
    //         });
    //     })
    // })
</script>
@endsection
