{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'QR Code')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @toastr_css
@endsection
{{-- Content --}}
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin:: Information-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-12">
                    <!--begin::Card-->
                    <form enctype="multipart/form-data" action="{{ route('qrcode.update', $qrcode->id ) }}" method="POST">
                        @csrf
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">QR Code</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit QR Code</span>
                                </div>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                                <div class="card-body">
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Link</label>
                                        <div class="col-lg-9 col-xl-6">
                                                <input class="form-control form-control-lg form-control-solid" name="link" type="text" value="{{ $qrcode->link }}" />
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Image</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <img src="/{{ $qrcode->image }}" width="150" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </form>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('scripts')
@jquery
@toastr_js
@toastr_render
@endsection
